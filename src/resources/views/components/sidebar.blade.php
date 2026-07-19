{{-- Overlay untuk mobile drawer --}}
<div
    x-show="sidebarOpen"
    x-transition:enter="transition-opacity ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="sidebarOpen = false"
    class="fixed inset-0 z-30 bg-slate-950/60 backdrop-blur-sm lg:hidden"
    style="display: none;"
></div>

<aside
    class="sidebar"
    :class="[collapsed ? 'is-collapsed' : '', sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0']"
>
    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-white/10">
            <img src="{{ asset('images/Logo Disa.png') }}" alt="Logo DISA" class="h-7 w-7 object-contain">
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

        @can('view barang')
        <a href="{{ route('barangs.index') }}"
            class="sidebar-link {{ request()->routeIs('barangs.*') ? 'is-active' : '' }}"
            :title="collapsed ? 'Master Barang' : ''">
            <svg data-lucide="package"></svg>
            <span x-show="!collapsed" x-transition.opacity>Master Barang</span>
        </a>
        @endcan

        @can('view stock_opname')
        <a href="{{ route('stock-opname.index') }}"
            class="sidebar-link {{ request()->routeIs('stock-opname.*') ? 'is-active' : '' }}"
            :title="collapsed ? 'Stock Opname' : ''">
            <svg data-lucide="clipboard-check"></svg>
            <span x-show="!collapsed" x-transition.opacity>Stock Opname</span>
        </a>
        @endcan

        @can('view master_reference')
        {{-- Master Referensi (submenu collapsible; jadi flyout saat collapsed) --}}
        @php($masterActive = request()->routeIs('master.*'))
        <div class="relative" x-data="{ open: {{ $masterActive ? 'true' : 'false' }}, flyout: false }"
            @mouseenter="flyout = true" @mouseleave="flyout = false">
            <button
                @click="collapsed ? null : (open = !open)"
                class="sidebar-link w-full {{ $masterActive ? 'is-active' : '' }}"
                :title="collapsed ? 'Master Referensi' : ''"
            >
                <svg data-lucide="layers"></svg>
                <span x-show="!collapsed" x-transition.opacity class="flex-1 text-left">Master Referensi</span>
                <svg data-lucide="chevron-down" x-show="!collapsed"
                    class="chevron transition-transform duration-200" :class="open ? 'rotate-180' : ''"></svg>
            </button>

            {{-- Submenu inline (expanded) --}}
            <div x-show="open && !collapsed" x-collapse.duration.200ms class="mt-0.5 space-y-0.5 pl-5">
                @foreach(config('master-references') as $type => $ref)
                @php($childActive = request()->routeIs('master.*') && request()->route('type') === $type)
                <a href="{{ route('master.index', $type) }}" class="sidebar-child {{ $childActive ? 'is-active' : '' }}">
                    <span class="dot"></span>
                    {{ $ref['label'] }}
                </a>
                @endforeach
            </div>

            {{-- Flyout submenu (collapsed, muncul saat hover) --}}
            <div
                x-show="collapsed && flyout"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 translate-x-1"
                x-transition:enter-end="opacity-100 translate-x-0"
                class="absolute left-full top-0 z-50 ml-2 hidden min-w-[190px] rounded-2xl border border-slate-700/60 bg-slate-800 p-2 shadow-premium-lg lg:block"
                style="display: none;"
            >
                <p class="px-2 pb-1.5 pt-1 text-[10px] font-semibold uppercase tracking-widest text-slate-500">Master Referensi</p>
                @foreach(config('master-references') as $type => $ref)
                @php($childActive = request()->routeIs('master.*') && request()->route('type') === $type)
                <a href="{{ route('master.index', $type) }}"
                    class="flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-sm font-medium {{ $childActive ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/[0.06] hover:text-white' }}">
                    <span class="h-1.5 w-1.5 shrink-0 rounded-full {{ $childActive ? 'bg-brand-400' : 'bg-slate-600' }}"></span>
                    {{ $ref['label'] }}
                </a>
                @endforeach
            </div>
        </div>
        @endcan

        @canany(['view user_management', 'view role_management', 'view activity_log'])
        <p class="sidebar-section-label" x-show="!collapsed" x-transition.opacity>Administrasi</p>

        @can('view user_management')
        <a href="{{ route('users.index') }}"
            class="sidebar-link {{ request()->routeIs('users.*') ? 'is-active' : '' }}"
            :title="collapsed ? 'Manajemen User' : ''">
            <svg data-lucide="users"></svg>
            <span x-show="!collapsed" x-transition.opacity>Manajemen User</span>
        </a>
        @endcan

        @can('view role_management')
        <a href="{{ route('roles.index') }}"
            class="sidebar-link {{ request()->routeIs('roles.*') ? 'is-active' : '' }}"
            :title="collapsed ? 'Manajemen Role' : ''">
            <svg data-lucide="shield-check"></svg>
            <span x-show="!collapsed" x-transition.opacity>Manajemen Role</span>
        </a>
        @endcan

        @can('view activity_log')
        <a href="{{ route('activity-logs.index') }}"
            class="sidebar-link {{ request()->routeIs('activity-logs.*') ? 'is-active' : '' }}"
            :title="collapsed ? 'Log Aktivitas' : ''">
            <svg data-lucide="history"></svg>
            <span x-show="!collapsed" x-transition.opacity>Log Aktivitas</span>
        </a>
        @endcan
        @endcanany
    </nav>

    {{-- Footer: profil user + collapse toggle --}}
    <div class="sidebar-footer">
        <button
            @click="collapsed = !collapsed"
            class="hidden w-full items-center gap-3 rounded-xl px-2.5 py-2 text-sm font-medium text-slate-400 transition hover:bg-white/[0.06] hover:text-white lg:flex"
        >
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/[0.04]">
                <svg data-lucide="panel-left-close" x-show="!collapsed" class="h-4 w-4"></svg>
                <svg data-lucide="panel-left-open" x-show="collapsed" class="h-4 w-4"></svg>
            </span>
            <span x-show="!collapsed" x-transition.opacity>Ciutkan menu</span>
        </button>
    </div>
</aside>
