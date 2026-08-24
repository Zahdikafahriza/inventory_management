<?php

namespace App\Http\Controllers;

use App\Http\Requests\MasterReferenceRequest;
use App\Models\Barang;
use App\Models\MasterReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

/**
 * Satu controller untuk SEMUA jenis Master Referensi.
 * Jenis aktif ditentukan oleh segmen {type} pada URL (mis. /master/kategori),
 * lalu dipetakan ke konfigurasi di config/master-references.php.
 */
class MasterReferenceController extends Controller
{
    /**
     * Ambil konfigurasi untuk {type} atau 404 bila tidak dikenal.
     */
    protected function config(string $type): array
    {
        $config = config("master-references.$type");

        abort_if(!$config, Response::HTTP_NOT_FOUND);

        // Simpan key type agar mudah dipakai di view untuk generate route.
        $config['type'] = $type;

        return $config;
    }

    protected function authorizeAdmin(Request $request): void
    {
        abort_unless($request->user()?->can('create master_reference') || $request->user()?->can('update master_reference') || $request->user()?->can('delete master_reference'), Response::HTTP_FORBIDDEN);
    }

    public function index(Request $request, string $type)
    {
        $config = $this->config($type);
        $search = trim((string) $request->get('q', ''));

        $query = MasterReference::query_for($config['table'])->orderBy('nama');

        if ($search !== '') {
            $query->where('nama', 'like', "%{$search}%");
        }

        $items = $query->paginate(15)->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html'  => view('master.partials.results', compact('config', 'items', 'search'))->render(),
                'total' => $items->total(),
            ]);
        }

        return view('master.index', compact('config', 'items', 'search'));
    }

    public function create(Request $request, string $type)
    {
        $this->authorizeAdmin($request);
        $config = $this->config($type);

        return view('master.create', compact('config'));
    }

    public function store(MasterReferenceRequest $request, string $type)
    {
        $this->authorizeAdmin($request);
        $config = $this->config($type);

        MasterReference::forTable($config['table'])->create([
            'nama'      => $request->input('nama'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('master.index', $type)
            ->with('success', "{$config['label']} berhasil ditambahkan.");
    }

    public function edit(Request $request, string $type, int $id)
    {
        $this->authorizeAdmin($request);
        $config = $this->config($type);

        $item = MasterReference::query_for($config['table'])->findOrFail($id);

        return view('master.edit', compact('config', 'item'));
    }

    public function update(MasterReferenceRequest $request, string $type, int $id)
    {
        $this->authorizeAdmin($request);
        $config = $this->config($type);

        $item = MasterReference::query_for($config['table'])->findOrFail($id);

        $item->update([
            'nama'      => $request->input('nama'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('master.index', $type)
            ->with('success', "{$config['label']} berhasil diperbarui.");
    }

    public function destroy(Request $request, string $type, int $id)
    {
        $this->authorizeAdmin($request);
        $config = $this->config($type);

        $item = MasterReference::query_for($config['table'])->findOrFail($id);

        // Validasi: jangan hapus bila nilai masih dipakai oleh data barang.
        $column = $config['barang_column'] ?? null;
        if ($column && Schema::hasColumn('barangs', $column)) {
            $used = Barang::where($column, $item->nama)->count();

            if ($used > 0) {
                return redirect()
                    ->route('master.index', $type)
                    ->with('error', "{$config['label']} \"{$item->nama}\" tidak dapat dihapus karena masih digunakan oleh {$used} data barang.");
            }
        }

        $item->delete();

        return redirect()
            ->route('master.index', $type)
            ->with('success', "{$config['label']} berhasil dihapus.");
    }
}
