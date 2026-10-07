<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <a href="{{ route('activity-logs.index') }}">Log Aktivitas</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">Aktivitas Login</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-medium text-brand-600">Audit</p>
            <h2 class="section-heading">Aktivitas Login Web</h2>
            <p class="section-subtitle">Histori login, logout, dan percobaan login gagal lewat aplikasi web.</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container">
            <div class="page-card">
                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <form id="activity-filter-form" method="GET" class="grid grid-cols-2 gap-3 sm:flex sm:flex-wrap sm:items-end">
                        <div class="col-span-2 sm:col-span-1 sm:min-w-[200px]">
                            <label class="field-label">Cari nama / email</label>
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="nama atau email" class="select-input py-2.5">
                        </div>
                        <div class="col-span-1">
                            <label class="field-label">Aksi</label>
                            <select name="action" class="select-input py-2.5">
                                <option value="">Semua</option>
                                <option value="login" @selected(request('action') === 'login')>Login</option>
                                <option value="logout" @selected(request('action') === 'logout')>Logout</option>
                                <option value="login_failed" @selected(request('action') === 'login_failed')>Login gagal</option>
                            </select>
                        </div>
                        <div class="col-span-1">
                            <label class="field-label">Dari Tanggal</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="select-input py-2.5">
                        </div>
                        <div class="col-span-1">
                            <label class="field-label">Sampai Tanggal</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" class="select-input py-2.5">
                        </div>
                        <div class="col-span-2 flex gap-2 sm:col-span-1">
                            <button type="submit" class="btn-primary w-full sm:w-auto">
                                <svg data-lucide="filter"></svg>
                                Filter
                            </button>
                            @if(request()->anyFilled(['q', 'action', 'date_from', 'date_to']))
                            <a href="{{ route('activity-logs.login') }}" class="btn-secondary w-full sm:w-auto">
                                <svg data-lucide="x"></svg>
                                Reset
                            </a>
                            @endif
                        </div>
                    </form>
                </div>

                <div id="activity-logs-results">
                    @include('activity-logs.partials.results')
                </div>
            </div>
        </div>
    </div>

    <script>
    (function () {
        const resultsEl = document.getElementById('activity-logs-results');
        const form = document.getElementById('activity-filter-form');
        if (!resultsEl || !form) return;

        const baseUrl  = @json(route('activity-logs.login'));
        const basePath = new URL(baseUrl, window.location.origin).pathname;
        let debounceTimer = null;
        let controller = null;

        function formParams() {
            const data = new FormData(form);
            const params = {};
            data.forEach(function (v, k) { if (v !== '') params[k] = v; });
            return params;
        }

        function loadResults(params, pushState) {
            if (controller) controller.abort();
            controller = new AbortController();
            resultsEl.classList.add('opacity-50', 'pointer-events-none');

            axios.get(baseUrl, { params: params, signal: controller.signal })
                .then(function (res) {
                    resultsEl.innerHTML = res.data.html;
                    resultsEl.classList.remove('opacity-50', 'pointer-events-none');
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
                    console.error('Live filter gagal:', err);
                });
        }

        form.querySelectorAll('select').forEach(function (el) {
            el.addEventListener('change', function () { loadResults(formParams()); });
        });
        form.querySelectorAll('input[type="date"]').forEach(function (el) {
            el.addEventListener('change', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function () { loadResults(formParams()); }, 300);
            });
        });
        form.querySelectorAll('input[type="text"]').forEach(function (el) {
            el.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function () { loadResults(formParams()); }, 400);
            });
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            clearTimeout(debounceTimer);
            loadResults(formParams());
        });

        document.addEventListener('click', function (e) {
            const link = e.target.closest('a[href]');
            if (!link) return;
            const url = new URL(link.href, window.location.origin);
            if (url.pathname !== basePath) return;
            if (!form.contains(link) && !resultsEl.contains(link)) return;
            e.preventDefault();
            const params = {
                q: url.searchParams.get('q') || '',
                action: url.searchParams.get('action') || '',
                date_from: url.searchParams.get('date_from') || '',
                date_to: url.searchParams.get('date_to') || '',
                page: url.searchParams.get('page') || undefined,
            };
            const qInput    = form.querySelector('[name="q"]');
            const actionSel = form.querySelector('[name="action"]');
            const fromInput = form.querySelector('[name="date_from"]');
            const toInput   = form.querySelector('[name="date_to"]');
            if (qInput) qInput.value = params.q;
            if (actionSel) actionSel.value = params.action;
            if (fromInput) fromInput.value = params.date_from;
            if (toInput) toInput.value = params.date_to;
            loadResults(params);
        });

        window.addEventListener('popstate', function (e) {
            if (e.state && e.state.params) {
                const p = e.state.params;
                const qInput    = form.querySelector('[name="q"]');
                const actionSel = form.querySelector('[name="action"]');
                const fromInput = form.querySelector('[name="date_from"]');
                const toInput   = form.querySelector('[name="date_to"]');
                if (qInput) qInput.value = p.q || '';
                if (actionSel) actionSel.value = p.action || '';
                if (fromInput) fromInput.value = p.date_from || '';
                if (toInput) toInput.value = p.date_to || '';
                loadResults(p, false);
            }
        });
    })();
    </script>
</x-app-layout>
