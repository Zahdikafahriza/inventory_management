<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <span class="is-current">Dashboard</span>
        </nav>
    </x-slot>

    <div class="page-section">
        <div class="app-container space-y-6">

            {{-- Hero --}}
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-brand-600 via-brand-700 to-indigo-800 p-6 text-white shadow-premium sm:p-8">
                <div class="absolute -right-10 -top-10 h-48 w-48 rounded-full bg-white/10 blur-2xl"></div>
                <div class="absolute -bottom-16 right-24 h-56 w-56 rounded-full bg-indigo-400/20 blur-3xl"></div>
                <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-sm font-medium text-brand-100">{{ now()->translatedFormat('l, d F Y') }}</p>
                        <h2 class="mt-1 text-2xl font-semibold tracking-tight sm:text-3xl">Halo, {{ Auth::user()->name }} 👋</h2>
                        <p class="mt-2 max-w-lg text-sm text-brand-100/90">Berikut ringkasan kondisi inventaris kamu hari ini. Semua data diperbarui secara real-time.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @can('create barang')
                        <a href="{{ route('barangs.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-brand-700 shadow-sm transition hover:bg-brand-50">
                            <svg data-lucide="plus" class="h-4 w-4"></svg> Tambah Barang
                        </a>
                        @endcan
                        @can('view stock_opname')
                        <a href="{{ route('stock-opname.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-white/15 px-4 py-2.5 text-sm font-semibold text-white ring-1 ring-inset ring-white/25 transition hover:bg-white/25">
                            <svg data-lucide="clipboard-check" class="h-4 w-4"></svg> Stock Opname
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            {{-- Stat cards --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Total Barang</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-50 text-brand-600"><svg data-lucide="package" class="h-5 w-5"></svg></span>
                    </div>
                    <p class="mt-4 text-3xl font-semibold tracking-tight text-slate-900">{{ number_format($totalBarang) }}</p>
                    <p class="mt-1 text-xs text-slate-400">Total stok: {{ number_format($totalStok) }} unit</p>
                </div>

                <a href="{{ route('barangs.index', ['stok' => 'menipis']) }}" class="stat-card block">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Stok Menipis</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600"><svg data-lucide="alert-triangle" class="h-5 w-5"></svg></span>
                    </div>
                    <p class="mt-4 text-3xl font-semibold tracking-tight text-slate-900">{{ number_format($stokMenipis) }}</p>
                    <p class="mt-1 text-xs text-amber-500">Perlu restock →</p>
                </a>

                <a href="{{ route('barangs.index', ['stok' => 'habis']) }}" class="stat-card block">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Stok Habis</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-red-600"><svg data-lucide="ban" class="h-5 w-5"></svg></span>
                    </div>
                    <p class="mt-4 text-3xl font-semibold tracking-tight text-slate-900">{{ number_format($stokHabis) }}</p>
                    <p class="mt-1 text-xs text-red-500">Butuh perhatian →</p>
                </a>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Aktivitas Hari Ini</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600"><svg data-lucide="activity" class="h-5 w-5"></svg></span>
                    </div>
                    <p class="mt-4 text-3xl font-semibold tracking-tight text-slate-900">{{ number_format($logHariIni) }}</p>
                    <p class="mt-1 text-xs text-slate-400">Perubahan tercatat (web &amp; n8n)</p>
                </div>
            </div>

            {{-- Charts row --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <div class="page-card p-6 lg:col-span-2">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-semibold text-slate-900">Tren Aktivitas</h3>
                            <p class="text-sm text-slate-400">14 hari terakhir</p>
                        </div>
                        <span class="badge badge-neutral"><svg data-lucide="trending-up"></svg> Harian</span>
                    </div>
                    <div class="mt-4 h-64"><canvas id="trendChart"></canvas></div>
                </div>

                <div class="page-card p-6">
                    <h3 class="text-base font-semibold text-slate-900">Komposisi Stok</h3>
                    <p class="text-sm text-slate-400">Status seluruh barang</p>
                    <div class="mt-4 flex h-64 items-center justify-center"><canvas id="stokChart"></canvas></div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                {{-- Kategori bar --}}
                <div class="page-card p-6 lg:col-span-2">
                    <h3 class="text-base font-semibold text-slate-900">Barang per Kategori</h3>
                    <p class="text-sm text-slate-400">6 kategori teratas</p>
                    <div class="mt-4 h-64"><canvas id="kategoriChart"></canvas></div>
                </div>

                {{-- Perlu perhatian --}}
                <div class="page-card p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-semibold text-slate-900">Perlu Perhatian</h3>
                        <a href="{{ route('barangs.index', ['stok' => 'habis']) }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">Semua →</a>
                    </div>
                    @if($perluPerhatian->isEmpty())
                    <div class="empty-state mt-4 !py-8">
                        <svg data-lucide="check-circle" class="h-6 w-6 text-emerald-400"></svg>
                        <p class="mt-2 text-sm text-slate-500">Semua stok dalam kondisi aman.</p>
                    </div>
                    @else
                    <ul class="mt-4 space-y-2">
                        @foreach($perluPerhatian as $b)
                        <li>
                            <a href="{{ route('barangs.show', $b) }}" class="flex items-center justify-between rounded-xl border border-slate-100 p-3 transition hover:border-brand-200 hover:bg-brand-50/40">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-medium text-slate-800">{{ $b->nama_aset }}</p>
                                    <p class="text-xs text-slate-400">{{ $b->kode_aset }}</p>
                                </div>
                                <span class="badge {{ $b->stokStatusValue() === 'habis' ? 'badge-danger' : 'badge-system' }}">
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>

            {{-- Activity feed --}}
            <div class="page-card p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-slate-900">Aktivitas Terbaru</h3>
                    @can('view activity_log')<a href="{{ route('activity-logs.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">Lihat semua →</a>@endcan
                </div>
                @if($aktivitasTerbaru->isEmpty())
                <div class="empty-state mt-4"><svg data-lucide="inbox" class="h-6 w-6 text-slate-300"></svg><p class="mt-2 text-sm text-slate-500">Belum ada aktivitas.</p></div>
                @else
                <ul class="mt-4 divide-y divide-slate-100">
                    @foreach($aktivitasTerbaru as $log)
                    <li class="flex items-center gap-3 py-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full {{ $log->source === 'n8n' ? 'bg-violet-50 text-violet-600' : 'bg-slate-100 text-slate-600' }}">
                            <svg data-lucide="{{ $log->source === 'n8n' ? 'bot' : 'user' }}" class="h-4 w-4"></svg>
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium text-slate-800">{{ $log->displayLabel() }}</p>
                            <p class="text-xs text-slate-400">{{ ucfirst(str_replace('_', ' ', $log->action)) }} · {{ $log->actorLabel() }}</p>
                        </div>
                        <span class="shrink-0 text-xs text-slate-400">{{ $log->created_at->diffForHumans(short: true) }}</span>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        (function () {
            const brand = '#4f46e5', amber = '#f59e0b', red = '#ef4444', emerald = '#10b981', slate = '#94a3b8';
            const gridColor = 'rgba(148,163,184,0.15)';
            Chart.defaults.font.family = 'Figtree, ui-sans-serif, system-ui';
            Chart.defaults.color = '#64748b';

            // Tren aktivitas (line)
            new Chart(document.getElementById('trendChart'), {
                type: 'line',
                data: {
                    labels: @json($trendChart['labels']),
                    datasets: [{
                        data: @json($trendChart['data']),
                        borderColor: brand, backgroundColor: 'rgba(79,70,229,0.12)',
                        fill: true, tension: 0.4, borderWidth: 2,
                        pointRadius: 0, pointHoverRadius: 5, pointHoverBackgroundColor: brand,
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: gridColor }, ticks: { precision: 0 } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // Komposisi stok (donut)
            new Chart(document.getElementById('stokChart'), {
                type: 'doughnut',
                data: {
                    labels: @json($stokChart['labels']),
                    datasets: [{ data: @json($stokChart['data']), backgroundColor: [emerald, amber, red], borderWidth: 0, hoverOffset: 6 }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '68%',
                    plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 16 } } }
                }
            });

            // Per kategori (bar)
            new Chart(document.getElementById('kategoriChart'), {
                type: 'bar',
                data: {
                    labels: @json($kategoriChart['labels']),
                    datasets: [{ data: @json($kategoriChart['data']), backgroundColor: brand, borderRadius: 8, maxBarThickness: 42 }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: gridColor }, ticks: { precision: 0 } },
                        x: { grid: { display: false } }
                    }
                }
            });
        })();
    </script>
</x-app-layout>
