<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">Master Barang</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium text-brand-600">Inventaris</p>
                <h2 class="section-heading">Master Barang</h2>
                <p class="section-subtitle">Kelola semua data barang dalam satu tampilan yang lebih rapi dan mudah dibaca.</p>
            </div>

            @can('create', \App\Models\Barang::class)
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('barangs.export', ['q' => $search, 'stok' => $stokFilter]) }}" class="btn-secondary">
                    <svg data-lucide="file-down"></svg>
                    Export Excel
                </a>
                <a href="{{ route('barangs.create') }}" class="btn-primary">
                    <svg data-lucide="plus"></svg>
                    Tambah Barang
                </a>
            </div>
            @else
            <a href="{{ route('barangs.export', ['q' => $search, 'stok' => $stokFilter]) }}" class="btn-secondary">
                <svg data-lucide="file-down"></svg>
                Export Excel
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container space-y-6">
            <div class="page-card">
                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Daftar Barang</h3>
                            <p class="mt-1 text-sm text-slate-500">Pantau data barang dan lakukan aksi edit atau hapus dengan cepat.</p>
                        </div>
                        <span class="badge">
                            <svg data-lucide="database"></svg>
                            {{ number_format($totalBarang) }} data tersimpan
                        </span>
                    </div>

                    {{-- Pencarian --}}
                    <form method="GET" class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-center">
                        <label class="topbar-search sm:max-w-md">
                            <svg data-lucide="search" class="h-4 w-4 shrink-0 text-slate-400"></svg>
                            <input
                                type="text"
                                name="q"
                                value="{{ $search }}"
                                placeholder="Cari kode aset, nama, kategori, lokasi, atau PIC..."
                                class="w-full bg-transparent text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none"
                            >
                        </label>
                        <input type="hidden" name="per_page" value="{{ $perPage }}">
                        <input type="hidden" name="stok" value="{{ $stokFilter }}">
                        <div class="flex gap-2">
                            <button type="submit" class="btn-primary">
                                <svg data-lucide="search"></svg>
                                Cari
                            </button>
                            @if($search !== '')
                            <a href="{{ route('barangs.index') }}" class="btn-secondary">
                                <svg data-lucide="x"></svg>
                                Reset
                            </a>
                            @endif
                        </div>
                    </form>

                    {{-- Filter status stok --}}
                    @php
                        $chips = [
                            ''        => ['Semua', $stokCounts['semua'], 'badge-neutral'],
                            'aman'    => ['Stok Aman', $stokCounts['aman'], 'badge-success'],
                            'menipis' => ['Stok Menipis', $stokCounts['menipis'], 'badge-system'],
                            'habis'   => ['Stok Habis', $stokCounts['habis'], 'badge-danger'],
                        ];
                    @endphp
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach($chips as $val => [$label, $count, $badgeClass])
                        @php($active = (string) $stokFilter === (string) $val)
                        <a href="{{ route('barangs.index', array_filter(['q' => $search, 'per_page' => $perPage, 'stok' => $val])) }}"
                            class="inline-flex items-center gap-1 rounded-full border px-3.5 py-1.5 text-sm font-medium transition
                                {{ $active
                                    ? 'border-brand-500 bg-brand-50 text-brand-700 shadow-sm'
                                    : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50' }}">
                            @if($val === 'habis')<span class="h-2 w-2 rounded-full bg-red-500"></span>
                            @elseif($val === 'menipis')<span class="h-2 w-2 rounded-full bg-amber-500"></span>
                            @elseif($val === 'aman')<span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                            @endif
                            {{ $label }}
                            <span class="rounded-full bg-slate-100 px-1.5 text-xs font-semibold text-slate-500">{{ number_format($count) }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    @if($barangs->isEmpty())
                    <div class="empty-state">
                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-brand-50 text-brand-600">
                            <svg data-lucide="package-search" class="h-8 w-8"></svg>
                        </div>
                        @if($search !== '' || $stokFilter)
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Tidak ada barang yang cocok</h3>
                        <p class="mt-2 max-w-md text-sm leading-6 text-slate-500">Coba ubah kata kunci atau filter status stok, atau reset untuk melihat semua barang.</p>
                        <a href="{{ route('barangs.index') }}" class="btn-primary mt-6">
                            <svg data-lucide="rotate-ccw"></svg>
                            Reset Filter
                        </a>
                        @else
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Belum ada data barang</h3>
                        <p class="mt-2 max-w-md text-sm leading-6 text-slate-500">Tambahkan barang pertama Anda agar data inventaris mulai tercatat dengan rapi.</p>
                        @can('create', \App\Models\Barang::class)
                        <a href="{{ route('barangs.create') }}" class="btn-primary mt-6">
                            <svg data-lucide="plus"></svg>
                            Tambah Barang
                        </a>
                        @endcan
                        @endif
                    </div>
                    @else

                    {{-- Desktop / tablet: tabel --}}
                    <div class="hidden table-wrap lg:block">
                        <div class="table-scroll max-h-[32rem]">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Aset</th>
                                        <th>Kategori</th>
                                        <th>Sub Kategori</th>
                                        <th>Merk</th>
                                        <th>Type/Spek</th>
                                        <th>Satuan</th>
                                        <th>Kondisi</th>
                                        <th>Lokasi</th>
                                        <th>Stok</th>
                                        <th>Status</th>
                                        <th>PIC</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($barangs as $barang)
                                    <tr>
                                        <td>
                                            @if($barangs instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                                {{ $barangs->firstItem() + $loop->index }}
                                            @else
                                                {{ $loop->iteration }}
                                            @endif
                                        </td>
                                        <td class="font-medium text-slate-700">{{ $barang->kode_aset }}</td>
                                        <td>
                                            <a href="{{ route('barangs.show', $barang) }}" class="font-medium text-brand-700 hover:text-brand-800 hover:underline">
                                                {{ $barang->nama_aset }}
                                            </a>
                                        </td>
                                        <td>{{ $barang->kategori }}</td>
                                        <td>{{ $barang->sub_kategori ?? '-' }}</td>
                                        <td>{{ $barang->merk ?? '-' }}</td>
                                        <td>{{ $barang->tipe_spek ?? '-' }}</td>
                                        <td>{{ $barang->satuan ?? '-' }}</td>
                                        <td><span class="badge-neutral badge">{{ $barang->kondisi }}</span></td>
                                        <td>{{ $barang->lokasi ?? '-' }}</td>
                                        <td class="whitespace-nowrap">
                                            <span class="font-semibold text-slate-800">{{ number_format($barang->stok) }}</span>
                                            @php($ss = $barang->stokStatusValue())
                                            @if($ss === 'habis')
                                            <span class="badge badge-danger ml-1">Habis</span>
                                            @elseif($ss === 'menipis')
                                            <span class="badge badge-system ml-1">Menipis</span>
                                            @endif
                                        </td>
                                        <td><span class="badge badge-success">{{ $barang->status }}</span></td>
                                        <td>{{ $barang->pic ?? '-' }}</td>
                                        <td class="text-right whitespace-nowrap">
                                            <div class="inline-flex items-center gap-1.5">
                                                <a href="{{ route('barangs.show', $barang) }}" class="btn-ghost btn-sm" title="Detail">
                                                    <svg data-lucide="eye"></svg>
                                                </a>
                                                @can('update', $barang)
                                                <a href="{{ route('barangs.edit', $barang) }}" class="btn-ghost btn-sm text-brand-600 hover:bg-brand-50" title="Edit">
                                                    <svg data-lucide="pencil"></svg>
                                                </a>
                                                @endcan
                                                @can('delete', $barang)
                                                <form action="{{ route('barangs.destroy', $barang) }}" method="POST"
                                                    onsubmit="return confirmDelete(this, {{ Js::from($barang->nama_aset) }})">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-ghost btn-sm text-red-600 hover:bg-red-50" title="Hapus">
                                                        <svg data-lucide="trash-2"></svg>
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Mobile / tablet kecil: kartu --}}
                    <div class="mobile-card-list lg:hidden">
                        @foreach($barangs as $barang)
                        <div class="mobile-card">
                            <div class="mobile-card-top">
                                <a href="{{ route('barangs.show', $barang) }}" class="text-base font-semibold text-brand-700 hover:underline">
                                    {{ $barang->nama_aset }}
                                </a>
                                <span class="badge badge-success">{{ $barang->status }}</span>
                            </div>
                            <div class="mobile-card-row"><span>Kode</span><span>{{ $barang->kode_aset }}</span></div>
                            <div class="mobile-card-row"><span>Kategori</span><span>{{ $barang->kategori }}{{ $barang->sub_kategori ? ' / '.$barang->sub_kategori : '' }}</span></div>
                            <div class="mobile-card-row"><span>Merk / Tipe</span><span>{{ $barang->merk ?? '-' }} {{ $barang->tipe_spek ? '('.$barang->tipe_spek.')' : '' }}</span></div>
                            <div class="mobile-card-row"><span>Serial / Mac</span><span>{{ $barang->serial_number ?? '-' }} / {{ $barang->mac_address ?? '-' }}</span></div>
                            <div class="mobile-card-row"><span>Kondisi</span><span>{{ $barang->kondisi }}</span></div>
                            <div class="mobile-card-row"><span>Lokasi</span><span>{{ $barang->lokasi ?? '-' }}</span></div>
                            <div class="mobile-card-row"><span>Stok</span><span class="font-semibold">{{ number_format($barang->stok) }} {{ $barang->satuan }}
                                @php($ss = $barang->stokStatusValue())
                                @if($ss === 'habis')<span class="badge badge-danger ml-1">Habis</span>
                                @elseif($ss === 'menipis')<span class="badge badge-system ml-1">Menipis</span>@endif
                            </span></div>
                            <div class="mobile-card-row"><span>PIC</span><span>{{ $barang->pic ?? '-' }}</span></div>

                            <div class="mobile-card-actions">
                                <a href="{{ route('barangs.show', $barang) }}" class="mobile-card-btn mobile-card-btn-neutral">Detail</a>
                                @can('update', $barang)
                                <a href="{{ route('barangs.edit', $barang) }}" class="mobile-card-btn mobile-card-btn-primary">Edit</a>
                                @endcan
                                @can('delete', $barang)
                                <form action="{{ route('barangs.destroy', $barang) }}" method="POST"
                                    onsubmit="return confirmDelete(this, {{ Js::from($barang->nama_aset) }})">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mobile-card-btn mobile-card-btn-danger">Hapus</button>
                                </form>
                                @endcan
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Kontrol jumlah baris & pagination --}}
                    <div class="mt-6 flex flex-col items-center gap-4 border-t border-slate-100 pt-6 sm:flex-row sm:justify-between">
                        <form method="GET" class="flex items-center gap-3">
                            <input type="hidden" name="q" value="{{ $search }}">
                            <input type="hidden" name="stok" value="{{ $stokFilter }}">
                            <span class="text-sm text-slate-500">Tampilkan</span>
                            <select
                                name="per_page"
                                onchange="this.form.submit()"
                                class="select-input w-auto py-2">
                                <option value="20" @selected($perPage == 20)>20</option>
                                <option value="50" @selected($perPage == 50)>50</option>
                                <option value="all" @selected($perPage == 'all')>Semua</option>
                            </select>
                        </form>

                        @if($barangs instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div>
                            {{ $barangs->links() }}
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
