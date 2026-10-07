<header
    class="topbar"
    x-data="{ scrolled: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 8, { passive: true })"
    :class="scrolled ? 'is-scrolled' : ''"
>
    {{-- Hamburger (mobile) --}}
    <button @click="sidebarOpen = true" class="icon-btn lg:hidden" aria-label="Buka menu">
        <svg data-lucide="menu"></svg>
    </button>

    {{-- Breadcrumb (desktop) --}}
    <div class="hidden min-w-0 flex-1 lg:block">
        {{ $breadcrumb ?? '' }}
    </div>

    <div class="ml-auto flex items-center gap-1.5 sm:gap-2">
        {{-- Notifikasi --}}
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" class="icon-btn relative" aria-label="Notifikasi">
                <svg data-lucide="bell"></svg>
                <span class="absolute right-2 top-2 h-1.5 w-1.5 rounded-full bg-brand-500"></span>
            </button>
            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 z-50 mt-2 w-80 origin-top-right dropdown-panel"
                style="display: none;"
            >
                <div class="px-3 py-2.5 text-xs font-semibold uppercase tracking-wide text-slate-400">Notifikasi</div>
                <div class="empty-state !py-8">
                    <svg data-lucide="bell-off" class="h-6 w-6 text-slate-300"></svg>
                    <p class="mt-2 text-sm text-slate-500">Belum ada notifikasi baru</p>
                </div>
            </div>
        </div>

        {{-- Profile dropdown --}}
        <x-dropdown align="right" width="64">
            <x-slot name="trigger">
                <button class="flex items-center gap-2.5 rounded-xl py-1.5 pl-1.5 pr-2 transition hover:bg-slate-100">
                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 text-sm font-semibold text-white shadow-sm">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </span>
                    <span class="hidden text-left sm:block">
                        <span class="block text-sm font-semibold leading-tight text-slate-800">{{ Auth::user()->name }}</span>
                        <span class="block text-xs leading-tight text-slate-400">
                            {{ optional(Auth::user()->getRoleNames())->first() ?? 'Pengguna' }}
                        </span>
                    </span>
                    <svg data-lucide="chevron-down" class="hidden h-4 w-4 text-slate-400 sm:block"></svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="flex items-center gap-3 px-3 py-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 text-sm font-semibold text-white">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </span>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</p>
                        <p class="truncate text-xs text-slate-500">{{ Auth::user()->email ?? Auth::user()->username ?? '' }}</p>
                    </div>
                </div>
                <div class="my-1 border-t border-slate-100"></div>
                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                    <svg data-lucide="user-circle" class="h-4 w-4"></svg>
                    Profil Saya
                </a>
                <div class="my-1 border-t border-slate-100"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item is-danger w-full">
                        <svg data-lucide="log-out" class="h-4 w-4"></svg>
                        Keluar
                    </button>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
