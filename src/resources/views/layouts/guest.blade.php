<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NISA Inventory') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden bg-slate-950 px-6 py-12">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(79,70,229,0.25),_transparent_30%),radial-gradient(circle_at_bottom_right,_rgba(99,102,241,0.18),_transparent_28%),linear-gradient(135deg,_#020617_0%,_#0f172a_45%,_#1e1b3a_100%)]"></div>
        <div class="absolute -left-20 top-8 h-72 w-72 rounded-full bg-brand-500/20 blur-3xl"></div>
        <div class="absolute -right-16 bottom-0 h-80 w-80 rounded-full bg-indigo-400/15 blur-3xl"></div>

        <div class="relative z-10 grid w-full max-w-6xl gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <div class="hidden lg:block">
                <div class="max-w-xl">
                    <p class="auth-kicker">Inventory System</p>
                    <h1 class="mt-5 text-5xl font-semibold tracking-tight text-white">
                        Kelola stok dan data inventaris.
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-slate-300">
                        Dashboard ini membantu Anda memantau barang, menjaga data tetap terstruktur, dan memastikan seluruh aktivitas inventaris terdokumentasi dengan baik.
                    </p>
                    <div class="mt-10 flex items-center gap-6 text-sm text-slate-400">
                        <div class="flex items-center gap-2">
                            <svg data-lucide="shield-check" class="h-4 w-4 text-brand-400"></svg>
                            Akses aman berbasis peran
                        </div>
                        <div class="flex items-center gap-2">
                            <svg data-lucide="history" class="h-4 w-4 text-brand-400"></svg>
                            Log aktivitas lengkap
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-auto w-full max-w-md">
                <div class="mb-8 text-center">
                    <a href="/" class="inline-flex flex-col items-center">
                        <div class="flex h-20 w-20 items-center justify-center rounded-[1.75rem] border border-white/20 bg-white shadow-premium-lg backdrop-blur">
                            <img src="{{ asset('images/Logo Disa.png') }}" alt="Logo Disa" class="h-12 w-12 object-contain">
                        </div>
                        <h1 class="mt-5 text-3xl font-semibold text-white">NISA Inventory</h1>
                        <p class="mt-2 text-sm text-slate-300">Network Inventory & Stock Assistant</p>
                    </a>
                </div>

                <div class="auth-panel">
                    {{ $slot }}
                </div>

                <p class="mt-6 text-center text-sm text-slate-400">
                    © {{ date('Y') }}    System
                </p>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>if (window.lucide) lucide.createIcons();</script>
</body>

</html>
