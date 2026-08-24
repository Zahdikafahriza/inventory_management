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
                            <p class="mt-1 text-sm text-slate-500">Total <span id="master-total-count">{{ number_format($items->total()) }}</span> data tersimpan.</p>
                        </div>
                        <span class="badge">
                            <svg data-lucide="{{ $config['icon'] }}"></svg>
                            {{ $config['label'] }}
                        </span>
                    </div>

                    <form id="master-search-form" method="GET" class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-center">
                        <label class="topbar-search sm:max-w-md">
                            <svg data-lucide="search" class="h-4 w-4 shrink-0 text-slate-400"></svg>
                            <input id="master-search-input" type="text" name="q" value="{{ $search }}" autocomplete="off"
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

                <div id="master-results" class="p-6 sm:p-8">
                    @include('master.partials.results')
                </div>
            </div>
        </div>
    </div>

    <script>
    (function () {
        const resultsEl = document.getElementById('master-results');
        const form  = document.getElementById('master-search-form');
        const input = document.getElementById('master-search-input');
        const totalEl = document.getElementById('master-total-count');
        if (!resultsEl || !form || !input) return;

        const baseUrl  = @json(route('master.index', $config['type']));
        const basePath = new URL(baseUrl, window.location.origin).pathname;
        let debounceTimer = null;
        let controller = null;

        function loadResults(params, pushState) {
            if (controller) controller.abort();
            controller = new AbortController();
            resultsEl.classList.add('opacity-50', 'pointer-events-none');

            axios.get(baseUrl, { params: params, signal: controller.signal })
                .then(function (res) {
                    resultsEl.innerHTML = res.data.html;
                    resultsEl.classList.remove('opacity-50', 'pointer-events-none');
                    if (totalEl) totalEl.textContent = Number(res.data.total || 0).toLocaleString('id-ID');
                    if (pushState !== false) {
                        const url = new URL(baseUrl, window.location.origin);
                        Object.keys(params).forEach(function (k) { if (params[k] !== '' && params[k] != null) url.searchParams.set(k, params[k]); });
                        window.history.pushState({ params: params }, '', url.toString());
                    }
                    if (window.lucide) window.lucide.createIcons();
                })
                .catch(function (err) {
                    if (axios.isCancel(err)) return;
                    resultsEl.classList.remove('opacity-50', 'pointer-events-none');
                    console.error('Live search gagal:', err);
                });
        }

        input.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            const q = input.value;
            debounceTimer = setTimeout(function () { loadResults({ q: q }); }, 350);
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            clearTimeout(debounceTimer);
            loadResults({ q: input.value });
        });

        resultsEl.addEventListener('click', function (e) {
            const link = e.target.closest('a[href]');
            if (!link) return;
            const url = new URL(link.href, window.location.origin);
            if (url.pathname !== basePath) return;
            e.preventDefault();
            const params = { q: url.searchParams.get('q') || '', page: url.searchParams.get('page') || undefined };
            input.value = params.q;
            loadResults(params);
        });

        window.addEventListener('popstate', function (e) {
            if (e.state && e.state.params) {
                input.value = e.state.params.q || '';
                loadResults(e.state.params, false);
            }
        });
    })();
    </script>
</x-app-layout>
