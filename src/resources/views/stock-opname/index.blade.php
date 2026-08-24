<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">Stock Opname</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium text-brand-600">Inventaris</p>
                <h2 class="section-heading">Stock Opname</h2>
                <p class="section-subtitle">Hitung ulang stok fisik dan sinkronkan dengan data sistem.</p>
            </div>

            @if(auth()->user()->can('create stock_opname'))
            <form method="POST" action="{{ route('stock-opname.create') }}"
                onsubmit="return confirmStart(this)">
                @csrf
                <button type="submit" class="btn-primary">
                    <svg data-lucide="clipboard-check"></svg>
                    Mulai Opname Baru
                </button>
            </form>
            @endif
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container">
            <div class="page-card">
                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <h3 class="text-lg font-semibold text-slate-900">Riwayat Sesi Opname</h3>
                    <p class="mt-1 text-sm text-slate-500">Sesi draft bisa dilanjutkan; sesi final tersimpan permanen untuk audit.</p>
                </div>

                <div class="p-6 sm:p-8">
                    @if($sessions->isEmpty())
                    <div class="empty-state">
                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-brand-50 text-brand-600">
                            <svg data-lucide="clipboard-list" class="h-8 w-8"></svg>
                        </div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Belum ada sesi Stock Opname</h3>
                        <p class="mt-2 max-w-md text-sm leading-6 text-slate-500">Mulai opname pertama untuk mencatat stok fisik seluruh barang.</p>
                        @if(auth()->user()->can('create stock_opname'))
                        <form method="POST" action="{{ route('stock-opname.create') }}" class="mt-6" onsubmit="return confirmStart(this)">
                            @csrf
                            <button type="submit" class="btn-primary">
                                <svg data-lucide="clipboard-check"></svg> Mulai Opname Baru
                            </button>
                        </form>
                        @endif
                    </div>
                    @else
                    <div class="hidden table-wrap lg:block">
                        <div class="table-scroll">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Kode SO</th>
                                        <th>Status</th>
                                        <th>Jumlah Barang</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Tanggal</th>
                                        <th>Difinalisasi</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sessions as $s)
                                    <tr>
                                        <td class="font-semibold text-slate-800">{{ $s->kode_so }}</td>
                                        <td>
                                            @if($s->isFinalized())
                                            <span class="badge badge-success">Final</span>
                                            @else
                                            <span class="badge badge-system">Draft</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($s->items_count) }}</td>
                                        <td>{{ $s->created_by_name ?? '-' }}</td>
                                        <td>{{ $s->created_at->format('d M Y H:i') }}</td>
                                        <td>{{ $s->finalized_at ? $s->finalized_at->format('d M Y H:i') : '-' }}</td>
                                        <td class="text-right whitespace-nowrap">
                                            <a href="{{ route('stock-opname.show', $s) }}" class="btn-ghost btn-sm text-brand-600 hover:bg-brand-50" title="Buka">
                                                <svg data-lucide="{{ $s->isDraft() ? 'pencil' : 'eye' }}"></svg>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mobile-card-list lg:hidden">
                        @foreach($sessions as $s)
                        <a href="{{ route('stock-opname.show', $s) }}" class="mobile-card block">
                            <div class="mobile-card-top">
                                <span class="text-base font-semibold text-slate-800">{{ $s->kode_so }}</span>
                                @if($s->isFinalized())
                                <span class="badge badge-success">Final</span>
                                @else
                                <span class="badge badge-system">Draft</span>
                                @endif
                            </div>
                            <div class="mobile-card-row"><span>Barang</span><span>{{ number_format($s->items_count) }}</span></div>
                            <div class="mobile-card-row"><span>Dibuat</span><span>{{ $s->created_by_name ?? '-' }}</span></div>
                            <div class="mobile-card-row"><span>Tanggal</span><span>{{ $s->created_at->format('d M Y H:i') }}</span></div>
                        </a>
                        @endforeach
                    </div>

                    <div class="mt-6 border-t border-slate-100 pt-6">
                        {{ $sessions->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmStart(form) {
        // Fix tombol transparan: sebelumnya hanya .swal2-cancel yang dipaksa
        // tampil lewat didOpen. Ada aturan CSS global di project ini yang
        // kemungkinan menimpa .swal2-styled (confirm & cancel sekaligus),
        // jadi confirm button pun ikut transparan tanpa background. Sekarang
        // KEDUA tombol dipaksa tampil DAN diberi warna background eksplisit,
        // tidak bergantung pada Tailwind class yang bisa ter-purge saat build.
        //
        // Solusi permanen: cari & hapus aturan CSS aslinya
        // (grep -rn "swal2" resources/css resources/sass), ini jaring pengaman.
        Swal.fire({
            title: 'Mulai Stock Opname baru?',
            html: `
                Sistem akan mengambil <strong>snapshot stok seluruh barang</strong>
                saat ini sebagai dasar proses stock opname.
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, mulai',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#64748b',
            reverseButtons: true,
            focusCancel: true,
            customClass: {
                popup: 'rounded-2xl',
            },
            didOpen: () => {
                const confirmBtn = Swal.getConfirmButton();
                const cancelBtn = Swal.getCancelButton();
                [[confirmBtn, '#4f46e5'], [cancelBtn, '#64748b']].forEach(([btn, color]) => {
                    if (!btn) return;
                    btn.style.setProperty('background-color', color, 'important');
                    btn.style.setProperty('color', '#ffffff', 'important');
                    btn.style.setProperty('display', 'inline-block', 'important');
                    btn.style.setProperty('visibility', 'visible', 'important');
                    btn.style.setProperty('opacity', '1', 'important');
                });
            },
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

        // WAJIB: hentikan submit bawaan browser
        return false;
    }
    </script>
</x-app-layout>