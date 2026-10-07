<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockOpnameUpdateRequest;
use App\Models\Barang;
use App\Models\StockOpnameItem;
use App\Models\StockOpnameSession;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class StockOpnameController extends Controller
{
    protected function authorizeAdmin(Request $request): void
    {
        abort_unless($request->user()?->can('create stock_opname') || $request->user()?->can('finalize stock_opname'), Response::HTTP_FORBIDDEN);
    }

    /**
     * Daftar sesi Stock Opname.
     */
    public function index()
    {
        $sessions = StockOpnameSession::withCount('items')
            ->latest()
            ->paginate(15);

        return view('stock-opname.index', compact('sessions'));
    }

    /**
     * Buat sesi SO baru untuk SEMUA barang, lalu tampilkan form input.
     * "Stok bulan lalu" diambil dari sesi SO terakhir yang sudah difinalisasi.
     */
    public function create(Request $request)
    {
        $this->authorizeAdmin($request);

        $barangs = Barang::orderBy('kode_aset')->get();

        abort_if($barangs->isEmpty(), Response::HTTP_BAD_REQUEST, 'Belum ada data barang untuk di-opname.');

        \Log::info('jumlah barang', ['count' => $barangs->count(), 'ids' => $barangs->pluck('id')]);
        // Ambil stok hasil SO terakhir yang final, dipetakan per barang_id.
        $lastFinal = StockOpnameSession::where('status', 'finalized')
            ->latest('finalized_at')
            ->first();

        $stokBulanLalu = [];
        if ($lastFinal) {
            $stokBulanLalu = StockOpnameItem::where('session_id', $lastFinal->id)
                ->pluck('stok_so', 'barang_id')
                ->all();
        }

        $session = DB::transaction(function () use ($barangs, $stokBulanLalu, $request) {
            $session = StockOpnameSession::create([
                'kode_so'         => StockOpnameSession::generateKode(),
                'status'          => 'draft',
                'created_by'      => $request->user()->id,
                'created_by_name' => $request->user()->name,
            ]);

            $rows = [];
            $now = now();
            foreach ($barangs as $barang) {
                $rows[] = [
                    'session_id'      => $session->id,
                    'barang_id'       => $barang->id,
                    'kode_aset'       => $barang->kode_aset,
                    'nama_aset'       => $barang->nama_aset,
                    'stok_bulan_lalu' => $stokBulanLalu[$barang->id] ?? null,
                    'stok_sistem'     => (int) $barang->stok,
                    'stok_so'         => null,
                    'keterangan'      => null,
                    'created_at'      => $now,
                    'updated_at'      => $now,
                ];
            }
            StockOpnameItem::insert($rows);

            return $session;
        });

        return redirect()->route('stock-opname.show', $session)
            ->with('success', "Sesi {$session->kode_so} dibuat. Silakan input hasil opname.");
    }

    /**
     * Tampilkan detail sesi (form input bila draft, read-only bila final).
     */
    public function show(StockOpnameSession $stockOpname)
    {
        $items = $stockOpname->items()->orderBy('kode_aset')->get();

        return view('stock-opname.show', [
            'session' => $stockOpname,
            'items'   => $items,
        ]);
    }

    /**
     * Simpan hasil input SO sebagai draft (belum mengubah master).
     */
    public function update(StockOpnameUpdateRequest $request, StockOpnameSession $stockOpname)
    {
        abort_unless($stockOpname->isDraft(), Response::HTTP_FORBIDDEN, 'Sesi SO sudah difinalisasi.');

        $inputs      = $request->validated()['items'] ?? [];
        $keterangans = $request->validated()['keterangan'] ?? [];

        DB::transaction(function () use ($stockOpname, $inputs, $keterangans, $request) {
            foreach ($stockOpname->items as $item) {
                $update = [];

                if (array_key_exists($item->id, $inputs)) {
                    $update['stok_so'] = $inputs[$item->id];
                }

                if (array_key_exists($item->id, $keterangans)) {
                    $update['keterangan'] = $keterangans[$item->id] !== '' ? $keterangans[$item->id] : null;
                }

                if (!empty($update)) {
                    $item->update($update);
                }
            }
            $stockOpname->update(['catatan' => $request->validated()['catatan'] ?? null]);
        });

        return redirect()->route('stock-opname.show', $stockOpname)
            ->with('success', 'Hasil opname disimpan sebagai draft.');
    }

    /**
     * Finalisasi: update stok master dengan hasil SO + catat log aktivitas.
     * Ini mengubah data utama, jadi hanya bisa dari status draft.
     */
    public function finalize(Request $request, StockOpnameSession $stockOpname)
    {
        $this->authorizeAdmin($request);

        abort_unless($stockOpname->isDraft(), Response::HTTP_FORBIDDEN, 'Sesi SO sudah difinalisasi.');

        // Terima input hasil SO (+ catatan) yang mungkin dikirim bersama aksi
        // finalisasi (agar nilai yang baru diketik ikut tersimpan walau belum
        // "Simpan Draft").
        $data = $request->validate([
            'items'        => ['nullable', 'array'],
            'items.*'      => ['nullable', 'integer', 'min:0'],
            'keterangan'   => ['nullable', 'array'],
            'keterangan.*' => ['nullable', 'string', 'max:255'],
            'catatan'      => ['nullable', 'string', 'max:255'],
        ]);
        $submitted           = $data['items'] ?? [];
        $submittedKeterangan = $data['keterangan'] ?? [];

        DB::transaction(function () use ($stockOpname, $request, $submitted, $submittedKeterangan, $data) {
            // 1) Persist input terbaru ke item bila ada.
            if (!empty($submitted) || !empty($submittedKeterangan)) {
                foreach ($stockOpname->items as $item) {
                    $update = [];

                    if (array_key_exists($item->id, $submitted)) {
                        $update['stok_so'] = $submitted[$item->id];
                    }

                    if (array_key_exists($item->id, $submittedKeterangan)) {
                        $update['keterangan'] = $submittedKeterangan[$item->id] !== '' ? $submittedKeterangan[$item->id] : null;
                    }

                    if (!empty($update)) {
                        $item->update($update);
                    }
                }
                $stockOpname->refresh();
            }

            // 2) Terapkan ke master. Perubahan tiap barang DIKUMPULKAN dulu ke
            //    $perubahan, BUKAN langsung ditulis satu-satu ke activity log
            //    seperti sebelumnya (dulu: 1 sesi SO isi 8 barang -> 8 baris
            //    log "update", padahal ini 1 aktivitas: finalisasi SO).
            $perubahan = [];

            foreach ($stockOpname->items as $item) {
                if ($item->stok_so === null) {
                    continue;
                }

                $barang = Barang::find($item->barang_id);
                if (!$barang) {
                    continue;
                }

                $stokLama = (int) $barang->stok;
                $stokBaru = (int) $item->stok_so;

                if ($stokLama === $stokBaru) {
                    continue;
                }

                $barang->update([
                    'stok'            => $stokBaru,
                    'updated_by_type' => 'user',
                    'updated_by_id'   => (string) $request->user()->id,
                ]);

                $perubahan[] = [
                    'barang_id'  => $barang->id,
                    'kode_aset'  => $barang->kode_aset,
                    'nama_aset'  => $barang->nama_aset,
                    'stok_lama'  => $stokLama,
                    'stok_baru'  => $stokBaru,
                    'selisih'    => $stokBaru - $stokLama,
                    'keterangan' => $item->keterangan,
                ];
            }

            // 3) Catat SATU baris log untuk keseluruhan sesi finalisasi ini,
            //    loggable-nya sesi SO itu sendiri (bukan per-Barang).
            //
            //    PENTING: oldValue/newValue SENGAJA TIDAK diisi array —
            //    ActivityLogger::log() men-cast old/new value ke (string)
            //    kalau tidak null, jadi mengirim array ke situ akan memicu
            //    error "Array to string conversion". Rincian per-barang
            //    ditaruh di metadata['perubahan'] saja, yang sudah dirender
            //    rapi oleh ActivityLog::metadataList().
            ActivityLogger::log(
                loggableType: StockOpnameSession::class,
                loggableId: (int) $stockOpname->id,
                action: 'stock_opname',
                fieldChanged: 'stok (multi barang)',
                metadata: [
                    'kode_so'        => $stockOpname->kode_so,
                    'jumlah_barang'  => count($stockOpname->items),
                    'jumlah_berubah' => count($perubahan),
                    'perubahan'      => $perubahan,
                    'oleh'           => $request->user()->name,
                ],
            );

            $stockOpname->update([
                'status'       => 'finalized',
                'finalized_at' => now(),
                'catatan'      => $data['catatan'] ?? $stockOpname->catatan,
            ]);
        });

        return redirect()->route('stock-opname.show', $stockOpname)
            ->with('success', "Stock Opname {$stockOpname->kode_so} difinalisasi. Stok master telah diperbarui.");
    }

    /**
     * Batalkan/hapus sesi DRAFT (tidak boleh menghapus yang sudah final, demi audit).
     */
    public function destroy(Request $request, StockOpnameSession $stockOpname)
    {
        $this->authorizeAdmin($request);

        abort_unless($stockOpname->isDraft(), Response::HTTP_FORBIDDEN, 'Sesi SO yang sudah final tidak dapat dihapus.');

        $stockOpname->delete();

        return redirect()->route('stock-opname.index')
            ->with('success', 'Draft Stock Opname dibatalkan.');
    }
}