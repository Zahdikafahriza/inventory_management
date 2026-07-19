<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'NISA Inventory') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden bg-slate-950 px-6 py-12">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(79,70,229,0.28),_transparent_32%),radial-gradient(circle_at_bottom_right,_rgba(99,102,241,0.20),_transparent_30%),linear-gradient(135deg,_#020617_0%,_#0f172a_45%,_#1e1b3a_100%)]"></div>
        <div class="absolute -left-24 top-10 h-72 w-72 rounded-full bg-brand-500/20 blur-3xl"></div>
        <div class="absolute -right-20 bottom-0 h-80 w-80 rounded-full bg-indigo-400/15 blur-3xl"></div>

        <div class="relative z-10 w-full max-w-xl text-center">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-[1.75rem] border border-white/20 bg-white shadow-2xl">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-600 text-white">
                    <x-application-logo class="h-6 w-6 fill-current" />
                </div>
            </div>
            <h1 class="mt-8 text-4xl font-semibold tracking-tight text-white sm:text-5xl">NISA Inventory</h1>
            <p class="mt-4 text-lg leading-8 text-slate-300">Network Inventory &amp; Stock Assistant — kelola stok, opname, dan audit inventaris dalam satu sistem yang rapi.</p>

            <div class="mt-10 flex flex-col items-center justify-center gap-3 sm:flex-row">
                @auth
                <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-6 py-3 text-sm font-semibold text-brand-700 shadow-sm transition hover:bg-brand-50">
                    Buka Dashboard →
                </a>
                @else
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-6 py-3 text-sm font-semibold text-brand-700 shadow-sm transition hover:bg-brand-50">
                    Masuk ke Sistem →
                </a>
                @endauth
            </div>
            <p class="mt-10 text-sm text-slate-400">© {{ date('Y') }} NISA Inventory System</p>
        </div>
    </div>
</body>
</html>
