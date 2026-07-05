<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 20);
        $search  = trim((string) $request->get('q', ''));

        $query = Barang::query()->orderBy('kode_aset');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('kode_aset', 'like', "%{$search}%")
                    ->orWhere('nama_aset', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhere('serial_number', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('pic', 'like', "%{$search}%");
            });
        }

        $totalBarang = (clone $query)->count();

        if ($perPage === 'all') {
            $barangs = $query->get();
        } else {
            $perPage = (int) $perPage;

            if (!in_array($perPage, [20, 50], true)) {
                $perPage = 20;
            }

            $barangs = $query->paginate($perPage)->withQueryString();
        }

        return view('barangs.index', compact('barangs', 'perPage', 'search', 'totalBarang'));
    }

    public function create()
    {
        Gate::authorize('create', Barang::class);

        return view('barangs.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Barang::class);

        $validated = $request->validate([
            'nama_aset'     => 'required|max:255',
            'kategori'      => 'required|max:50',
            'sub_kategori'  => 'nullable|max:100',
            'merk'          => 'nullable|max:100',
            'tipe_spek'     => 'nullable|max:255',
            'serial_number' => 'nullable|max:150',
            'mac_address'   => 'nullable|max:100',
            'satuan'        => 'nullable|max:50',
            'stok'          => 'required|integer|min:0',
            'kondisi'       => 'required',
            'status'        => 'required',
            'lokasi'        => 'nullable|max:150',
            'pic'           => 'nullable|max:100',
            'keterangan'    => 'nullable',
        ]);

        // Kode aset di-generate otomatis di server berdasarkan kategori.
        // Field di form bersifat read-only, jadi input user (kalau ada) diabaikan.
        // Dibungkus transaksi + retry kecil untuk menghindari tabrakan nomor
        // bila dua barang dibuat hampir bersamaan.
        $barang = DB::transaction(function () use ($validated) {
            $attempt = 0;

            do {
                $kode = Barang::nextKodeAset($validated['kategori']);
                $exists = Barang::where('kode_aset', $kode)->exists();
                $attempt++;
            } while ($exists && $attempt < 5);

            return Barang::create($validated + [
                'kode_aset'       => $kode,
                'updated_by_type' => 'user',
                'updated_by_id'   => (string) request()->user()->id,
            ]);
        });

        ActivityLogger::log(
            loggableType: Barang::class,
            loggableId: $barang->id,
            action: 'created',
            metadata: ['kode_aset' => $barang->kode_aset, 'nama_aset' => $barang->nama_aset],
        );

        return redirect()->route('barangs.index')
            ->with('success', "Barang berhasil ditambahkan dengan kode {$barang->kode_aset}.");
    }

    /**
     * Endpoint AJAX: preview kode aset berikutnya untuk kategori tertentu.
     * Dipakai form tambah barang agar kode langsung tampil saat kategori dipilih.
     */
    public function previewKode(Request $request)
    {
        Gate::authorize('create', Barang::class);

        $kategori = $request->get('kategori');

        return response()->json([
            'kode_aset' => $kategori ? Barang::nextKodeAset($kategori) : '',
        ]);
    }

    public function show(Barang $barang)
    {
        return view('barangs.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        Gate::authorize('update', $barang);

        return view('barangs.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        Gate::authorize('update', $barang);

        $validated = $request->validate([
            'nama_aset'     => 'required|max:255',
            'kategori'      => 'required|max:50',
            'sub_kategori'  => 'nullable|max:100',
            'merk'          => 'nullable|max:100',
            'tipe_spek'     => 'nullable|max:255',
            'serial_number' => 'nullable|max:150',
            'mac_address'   => 'nullable|max:100',
            'satuan'        => 'nullable|max:50',
            'stok'          => 'required|integer|min:0',
            'kondisi'       => 'required',
            'status'        => 'required',
            'lokasi'        => 'nullable|max:150',
            'pic'           => 'nullable|max:100',
            'keterangan'    => 'nullable',
        ]);

        // Catatan: kode_aset sengaja TIDAK diubah saat edit. Kode bersifat permanen
        // setelah dibuat karena direferensikan oleh log aktivitas & workflow n8n,
        // sehingga mengubahnya akan memutus keterkaitan histori.

        $stokLama = $barang->stok;

        $barang->update($validated + [
            'updated_by_type' => 'user',
            'updated_by_id'   => (string) $request->user()->id,
        ]);

        if ($stokLama != $validated['stok']) {
            ActivityLogger::log(
                loggableType: Barang::class,
                loggableId: $barang->id,
                action: 'updated',
                fieldChanged: 'stok',
                oldValue: $stokLama,
                newValue: $validated['stok'],
            );
        }

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy(Barang $barang)
    {
        Gate::authorize('delete', $barang);

        ActivityLogger::log(
            loggableType: Barang::class,
            loggableId: $barang->id,
            action: 'deleted',
            metadata: ['kode_aset' => $barang->kode_aset, 'nama_aset' => $barang->nama_aset],
        );

        $barang->delete();

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}
