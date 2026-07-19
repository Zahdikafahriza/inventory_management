<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'NISA Inventory') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('images/Logo Disa.png') }}" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Flowbite (component behaviors: tooltip, modal helpers) -->
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

        <!-- App assets (Tailwind + Alpine, sudah ter-bundle via Vite) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div
            x-data="{
                sidebarOpen: false,
                collapsed: (localStorage.getItem('sidebar-collapsed') === 'true'),
            }"
            x-init="$watch('collapsed', value => localStorage.setItem('sidebar-collapsed', value))"
            class="app-shell"
        >
            <x-toast-container />

            <x-sidebar />

            <div class="content-area" :class="collapsed ? 'lg:pl-[78px]' : 'lg:pl-72'">
                <x-topbar>
                    <x-slot name="breadcrumb">
                        {{ $breadcrumb ?? '' }}
                    </x-slot>
                </x-topbar>

                <!-- Page Heading -->
                @isset($header)
                    <div class="border-b border-slate-200/80 bg-white">
                        <div class="app-container py-6">
                            {{ $header }}
                        </div>
                    </div>
                @endisset

                <!-- Page Content -->
                <main class="flex-1">
                    {{ $slot }}
                </main>
            </div>
        </div>

        {{-- Flash messages -> toast.
             Catatan: session('status') SENGAJA tidak dimasukkan ke sini.
             Key 'status' dipakai oleh Breeze untuk pesan inline (mis. teks
             "Saved." di form profil/password, dan box hijau di halaman
             verifikasi email). Kalau ikut dipush ke toast, pesan yang sama
             akan tampil dua kali (inline + popup), dan popup-nya menampilkan
             slug mentah seperti "profile-updated" alih-alih teks yang layak
             dibaca. Toast di sini cukup untuk 'success' dan 'error' yang
             memang hanya dirender lewat komponen ini. --}}
        <script>
            window.__flashMessages = [
                @if(session('success')) { type: 'success', message: @json(session('success')) }, @endif
                @if(session('error')) { type: 'error', message: @json(session('error')) }, @endif
            ];
        </script>

        {{-- SweetAlert2 --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmDelete(form, itemName) {
                Swal.fire({
                    title: 'Hapus data ini?',
                    html: `Data <strong>${itemName ?? ''}</strong> akan dihapus permanen dan tidak bisa dikembalikan.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    focusCancel: true,
                    buttonsStyling: false,
                    customClass: {
                        popup: 'rounded-2xl',
                        title: 'text-slate-900',
                        confirmButton: 'rounded-xl bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 text-sm font-semibold',
                        cancelButton: 'rounded-xl border border-slate-300 bg-white hover:bg-slate-100 text-slate-700 px-4 py-2.5 text-sm font-semibold mr-2',
                    },
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
                return false;
            }
        </script>

        {{-- Lucide Icons --}}
        <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

        {{-- Flowbite (dropdown/tooltip/modal data-attribute helpers) --}}
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

        <script>
            const renderIcons = () => window.lucide && lucide.createIcons();
            renderIcons();
            // Render ulang saat Alpine memunculkan elemen baru (mis. flyout, dropdown).
            document.addEventListener('alpine:initialized', renderIcons);
            document.addEventListener('transitionend', renderIcons, { passive: true });
        </script>
    </body>
</html>
