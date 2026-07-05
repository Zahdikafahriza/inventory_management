{{-- Overlay untuk mobile drawer --}}
<div
    x-show="sidebarOpen"
    x-transition:enter="transition-opacity ease-out duration-250"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="sidebarOpen = false"
    class="fixed inset-0 z-30 bg-slate-950/50 backdrop-blur-sm lg:hidden"
    style="display: none;"></div>

<aside
    class="sidebar"
    :class="[collapsed ? 'is-collapsed' : '', sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0']">
    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-white shadow-sm shadow-brand-600/30">
            <img src="{{ asset('images/Logo Disa.png') }}" alt="Logo Disa" srcset="">
            <x-application-logo class="h-5 w-5 fill-current" />
        </div>
        <div x-show="!collapsed" x-transition.opacity class="min-w-0 leading-tight">
            <p class="truncate text-sm font-semibold text-white">NISA Inventory</p>
            <p class="truncate text-[11px] text-slate-400">Stock Assistant</p>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="sidebar-nav">
        <p class="sidebar-section-label" x-show="!collapsed" x-transition.opacity>Menu</p>

        <a href="{{ route('dashboard') }}"
            class="sidebar-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}"
            :title="collapsed ? 'Dashboard' : ''">
            <svg data-lucide="layout-dashboard"></svg>
            <span x-show="!collapsed" x-transition.opacity>Dashboard</span>
        </a>

        <a href="{{ route('barangs.index') }}"
            class="sidebar-link {{ request()->routeIs('barangs.*') ? 'is-active' : '' }}"
            :title="collapsed ? 'Master Barang' : ''">
            <svg data-lucide="package"></svg>
            <span x-show="!collapsed" x-transition.opacity>Master Barang</span>
        </a>

        {{-- Master Referensi (submenu collapsible) --}}
        @php($masterActive = request()->routeIs('master.*'))
        <div x-data="{ open: {{ $masterActive ? 'true' : 'false' }} }">
            <button
                @click="open = !open"
                class="sidebar-link w-full {{ $masterActive ? 'is-active' : '' }}"
                :title="collapsed ? 'Master Referensi' : ''">
                <svg data-lucide="layers"></svg>
                <span x-show="!collapsed" x-transition.opacity class="flex-1 text-left">Master Referensi</span>
                <svg data-lucide="chevron-down" x-show="!collapsed"
                    class="h-4 w-4 shrink-0 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></svg>
            </button>

            <div
                x-show="open && !collapsed"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="mt-1 space-y-0.5 pl-4">
                @foreach(config('master-references') as $type => $ref)
                <a href="{{ route('master.index', $type) }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition-all duration-200 {{ request()->routeIs('master.*') && request()->route('type') === $type ? 'text-white' : 'text-slate-400 hover:text-white' }}">
                    <span class="flex h-1.5 w-1.5 shrink-0 rounded-full {{ request()->routeIs('master.*') && request()->route('type') === $type ? 'bg-brand-400' : 'bg-slate-600' }}"></span>
                    {{ $ref['label'] }}
                </a>
                @endforeach
            </div>

            {{-- Saat sidebar collapsed: submenu muncul sebagai flyout sederhana --}}
            <div x-show="collapsed" class="hidden"></div>
        </div>

        <a href="{{ route('activity-logs.index') }}"
            class="sidebar-link {{ request()->routeIs('activity-logs.*') ? 'is-active' : '' }}"
            :title="collapsed ? 'Log Aktivitas' : ''">
            <svg data-lucide="history"></svg>
            <span x-show="!collapsed" x-transition.opacity>Log Aktivitas</span>
        </a>

        <p class="sidebar-section-label" x-show="!collapsed" x-transition.opacity>Akun</p>

        <a href="{{ route('profile.edit') }}"
            class="sidebar-link {{ request()->routeIs('profile.*') ? 'is-active' : '' }}"
            :title="collapsed ? 'Profil Saya' : ''">
            <svg data-lucide="user-circle"></svg>
            <span x-show="!collapsed" x-transition.opacity>Profil Saya</span>
        </a>
    </nav>

    {{-- Footer: collapse toggle (desktop only) --}}
    <div class="sidebar-footer">
        <button
            @click="collapsed = !collapsed"
            class="hidden w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white lg:flex">
            <svg data-lucide="panel-left-close" x-show="!collapsed" class="h-5 w-5 shrink-0"></svg>
            <svg data-lucide="panel-left-open" x-show="collapsed" class="h-5 w-5 shrink-0"></svg>
            <span x-show="!collapsed" x-transition.opacity>Ciutkan menu</span>
        </button>
    </div>
</aside>