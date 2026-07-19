<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span>Master Referensi</span>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">{{ $config['label'] }}</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium text-brand-600">Master Referensi</p>
                <h2 class="section-heading">{{ $config['label'] }}</h2>
                <p class="section-subtitle">Kelola pilihan {{ strtolower($config['label']) }} yang tampil di form barang.</p>
            </div>

            @if(auth()->user()->can('create master_reference'))
            <a href="{{ route('master.create', $config['type']) }}" class="btn-primary">
                <svg data-lucide="plus"></svg>
                Tambah {{ $config['label'] }}
            </a>
            @endif
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container space-y-6">
            <div class="page-card">
                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Daftar {{ $config['label_plural'] }}</h3>
                            <p class="mt-1 text-sm text-slate-500">Total {{ number_format($items->total()) }} data tersimpan.</p>
                        </div>
                        <span class="badge">
                            <svg data-lucide="{{ $config['icon'] }}"></svg>
                            {{ $config['label'] }}
                        </span>
                    </div>

                    <form method="GET" class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-center">
                        <label class="topbar-search sm:max-w-md">
                            <svg data-lucide="search" class="h-4 w-4 shrink-0 text-slate-400"></svg>
                            <input type="text" name="q" value="{{ $search }}"
                                placeholder="Cari {{ strtolower($config['label']) }}..."
                                class="w-full bg-transparent text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none">
                        </label>
                        <div class="flex gap-2">
                            <button type="submit" class="btn-primary">
                                <svg data-lucide="search"></svg>
                                Cari
                            </button>
                            @if($search !== '')
                            <a href="{{ route('master.index', $config['type']) }}" class="btn-secondary">
                                <svg data-lucide="x"></svg>
                                Reset
                            </a>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="p-6 sm:p-8">
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
                                    <button type="submit" class="mobile-card-btn mobile-card-btn-danger">Hapus</button>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
