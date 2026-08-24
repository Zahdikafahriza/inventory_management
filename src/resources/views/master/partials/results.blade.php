@if($items->isEmpty())
<div class="empty-state">
    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-brand-50 text-brand-600">
        <svg data-lucide="{{ $config['icon'] }}" class="h-8 w-8"></svg>
    </div>
    @if($search !== '')
    <h3 class="mt-5 text-lg font-semibold text-slate-900">Tidak ada data yang cocok</h3>
    <p class="mt-2 max-w-md text-sm leading-6 text-slate-500">Coba kata kunci lain atau reset pencarian.</p>
    <a href="{{ route('master.index', $config['type']) }}" class="btn-primary mt-6">
        <svg data-lucide="rotate-ccw"></svg> Reset Pencarian
    </a>
    @else
    <h3 class="mt-5 text-lg font-semibold text-slate-900">Belum ada data {{ strtolower($config['label']) }}</h3>
    <p class="mt-2 max-w-md text-sm leading-6 text-slate-500">Tambahkan pilihan pertama agar muncul di form barang.</p>
    @if(auth()->user()->can('create master_reference'))
    <a href="{{ route('master.create', $config['type']) }}" class="btn-primary mt-6">
        <svg data-lucide="plus"></svg> Tambah {{ $config['label'] }}
    </a>
    @endif
    @endif
</div>
@else

{{-- Desktop tabel --}}
<div class="hidden table-wrap sm:block">
    <div class="table-scroll">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="w-16">No</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $items->firstItem() + $loop->index }}</td>
                    <td class="font-medium text-slate-800">{{ $item->nama }}</td>
                    <td>
                        @if($item->is_active)
                        <span class="badge badge-success">Aktif</span>
                        @else
                        <span class="badge badge-neutral">Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-right whitespace-nowrap">
                        @if(auth()->user()->can('create master_reference'))
                        <div class="inline-flex items-center gap-1.5">
                            <a href="{{ route('master.edit', [$config['type'], $item->id]) }}" class="btn-ghost btn-sm text-brand-600 hover:bg-brand-50" title="Edit">
                                <svg data-lucide="pencil"></svg>
                            </a>
                            <form action="{{ route('master.destroy', [$config['type'], $item->id]) }}" method="POST"
                                onsubmit="return confirmDelete(this, {{ Js::from($item->nama) }})">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-ghost btn-sm text-red-600 hover:bg-red-50" title="Hapus">
                                    <svg data-lucide="trash-2"></svg>
                                </button>
                            </form>
                        </div>
                        @else
                        <span class="text-xs text-slate-400">—</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Mobile kartu --}}
<div class="mobile-card-list sm:hidden">
    @foreach($items as $item)
    <div class="mobile-card">
        <div class="mobile-card-top">
            <span class="text-base font-semibold text-slate-800">{{ $item->nama }}</span>
            @if($item->is_active)
            <span class="badge badge-success">Aktif</span>
            @else
            <span class="badge badge-neutral">Nonaktif</span>
            @endif
        </div>
        @if(auth()->user()->can('create master_reference'))
        <div class="mobile-card-actions">
            <a href="{{ route('master.edit', [$config['type'], $item->id]) }}" class="mobile-card-btn mobile-card-btn-primary">Edit</a>
            <form action="{{ route('master.destroy', [$config['type'], $item->id]) }}" method="POST"
                onsubmit="return confirmDelete(this, {{ Js::from($item->nama) }})">
                @csrf
                @method('DELETE')
                <button class="mobile-card-btn mobile-card-btn-danger">Hapus</button>
            </form>
        </div>
        @endif
    </div>
    @endforeach
</div>

<div class="mt-6 border-t border-slate-100 pt-6">
    {{ $items->links() }}
</div>
@endif
