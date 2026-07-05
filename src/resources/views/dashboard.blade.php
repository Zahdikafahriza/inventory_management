<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <span class="is-current">Dashboard</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-medium text-brand-600">Overview</p>
            <h2 class="section-heading">Selamat datang, {{ Auth::user()->name }} 👋</h2>
            <p class="section-subtitle">Ringkasan cepat kondisi inventaris hari ini.</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container space-y-6">

            {{-- Stat cards --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Total Barang</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-50 text-brand-600">
                            <svg data-lucide="package" class="h-5 w-5"></svg>
                        </span>
                    </div>
                    <p class="mt-4 text-3xl font-semibold tracking-tight text-slate-900">{{ number_format($totalBarang) }}</p>
                    <p class="mt-1 text-xs text-slate-400">Jenis aset terdaftar</p>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Stok Menipis</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg data-lucide="alert-triangle" class="h-5 w-5"></svg>
                        </span>
                    </div>
                    <p class="mt-4 text-3xl font-semibold tracking-tight text-slate-900">{{ number_format($stokMenipis) }}</p>
                    <p class="mt-1 text-xs text-slate-400">Stok 1–5 unit, perlu restock</p>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Stok Habis</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-red-600">
                            <svg data-lucide="ban" class="h-5 w-5"></svg>
                        </span>
                    </div>
                    <p class="mt-4 text-3xl font-semibold tracking-tight text-slate-900">{{ number_format($stokHabis) }}</p>
                    <p class="mt-1 text-xs text-slate-400">Butuh perhatian segera</p>
                </div>

                <div class="stat-card">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Aktivitas Hari Ini</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg data-lucide="activity" class="h-5 w-5"></svg>
                        </span>
                    </div>
                    <p class="mt-4 text-3xl font-semibold tracking-tight text-slate-900">{{ number_format($logHariIni) }}</p>
                    <p class="mt-1 text-xs text-slate-400">Perubahan tercatat (web &amp; n8n)</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                {{-- Quick actions --}}
                <div class="page-card p-6 lg:col-span-1">
                    <h3 class="text-base font-semibold text-slate-900">Aksi Cepat</h3>
                    <div class="mt-4 space-y-2">
                        @can('create', \App\Models\Barang::class)
                        <a href="{{ route('barangs.create') }}" class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 text-sm font-medium text-slate-700 transition hover:border-brand-200 hover:bg-brand-50/50">
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-brand-50 text-brand-600">
                                <svg data-lucide="plus" class="h-4 w-4"></svg>
                            </span>
                            Tambah Barang Baru
                        </a>
                        @endcan
                        <a href="{{ route('barangs.index') }}" class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 text-sm font-medium text-slate-700 transition hover:border-brand-200 hover:bg-brand-50/50">
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                                <svg data-lucide="list" class="h-4 w-4"></svg>
                            </span>
                            Lihat Master Barang
                        </a>
                        <a href="{{ route('activity-logs.index') }}" class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 text-sm font-medium text-slate-700 transition hover:border-brand-200 hover:bg-brand-50/50">
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-violet-50 text-violet-600">
                                <svg data-lucide="history" class="h-4 w-4"></svg>
                            </span>
                            Lihat Log Aktivitas
                        </a>
                    </div>
                </div>

                {{-- Recent activity --}}
                <div class="page-card p-6 lg:col-span-2">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-semibold text-slate-900">Aktivitas Terbaru</h3>
                        <a href="{{ route('activity-logs.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">Lihat semua →</a>
                    </div>

                    @if($aktivitasTerbaru->isEmpty())
                    <div class="empty-state mt-4">
                        <svg data-lucide="inbox" class="h-6 w-6 text-slate-300"></svg>
                        <p class="mt-2 text-sm text-slate-500">Belum ada aktivitas tercatat.</p>
                    </div>
                    @else
                    <ul class="mt-4 divide-y divide-slate-100">
                        @foreach($aktivitasTerbaru as $log)
                        <li class="flex items-center gap-3 py-3">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full {{ $log->source === 'n8n' ? 'bg-violet-50 text-violet-600' : 'bg-slate-100 text-slate-600' }}">
                                <svg data-lucide="{{ $log->source === 'n8n' ? 'bot' : 'user' }}" class="h-4 w-4"></svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-medium text-slate-800">{{ $log->displayLabel() }}</p>
                                <p class="text-xs text-slate-400">{{ ucfirst(str_replace('_', ' ', $log->action)) }} oleh {{ $log->actorLabel() }}</p>
                            </div>
                            <span class="shrink-0 text-xs text-slate-400">{{ $log->created_at->diffForHumans() }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
