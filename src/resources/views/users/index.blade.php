<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">Manajemen User</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium text-brand-600">Administrasi</p>
                <h2 class="section-heading">Manajemen User</h2>
                <p class="section-subtitle">Kelola akun pengguna dan role yang melekat padanya.</p>
            </div>
            @can('create user_management')
            <a href="{{ route('users.create') }}" class="btn-primary">
                <svg data-lucide="user-plus"></svg> Tambah User
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container">
            <div class="page-card">
                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <form method="GET" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <label class="topbar-search sm:max-w-md">
                            <svg data-lucide="search" class="h-4 w-4 shrink-0 text-slate-400"></svg>
                            <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama, username, email..."
                                class="w-full bg-transparent text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none">
                        </label>
                            <div class="flex gap-2">
                            <button type="submit" class="btn-primary">
                                <svg data-lucide="search"></svg>
                                Cari
                            </button>
                            @if($search !== '')
                            <a href="{{ route('users.index') }}" class="btn-secondary">
                                <svg data-lucide="x"></svg>
                                Reset
                            </a>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="p-6 sm:p-8">
                    @if($users->isEmpty())
                    <div class="empty-state">
                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-brand-50 text-brand-600">
                            <svg data-lucide="users" class="h-8 w-8"></svg>
                        </div>
                        <h3 class="mt-5 text-lg font-semibold text-slate-900">Belum ada user</h3>
                    </div>
                    @else
                    <div class="hidden table-wrap lg:block">
                        <div class="table-scroll">
                            <table class="data-table">
                                <thead>
                                    <tr><th>Nama</th><th>Username</th><th>Email</th><th>Role</th><th class="text-right">Aksi</th></tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $u)
                                    <tr>
                                        <td class="font-medium text-slate-800">{{ $u->name }}</td>
                                        <td>{{ $u->username }}</td>
                                        <td>{{ $u->email ?? '-' }}</td>
                                        <td>
                                            @foreach($u->roles as $r)
                                            <span class="badge {{ $r->name === 'Super Admin' ? 'badge-danger' : '' }}">{{ $r->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-right whitespace-nowrap">
                                            @can('update user_management')
                                            <a href="{{ route('users.edit', $u) }}" class="btn-ghost btn-sm text-brand-600 hover:bg-brand-50" title="Edit"><svg data-lucide="pencil"></svg></a>
                                            @endcan
                                            @can('delete user_management')
                                            <form action="{{ route('users.destroy', $u) }}" method="POST" class="inline"
                                                onsubmit="return confirmDelete(this, {{ Js::from($u->name) }})">
                                                @csrf @method('DELETE')
                                                <button class="btn-ghost btn-sm text-red-600 hover:bg-red-50" title="Hapus"><svg data-lucide="trash-2"></svg></button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mobile-card-list lg:hidden">
                        @foreach($users as $u)
                        <div class="mobile-card">
                            <div class="mobile-card-top">
                                <span class="text-base font-semibold text-slate-800">{{ $u->name }}</span>
                                <span class="text-xs text-slate-400">{{ $u->username }}</span>
                            </div>
                            <div class="mobile-card-row"><span>Email</span><span>{{ $u->email ?? '-' }}</span></div>
                            <div class="mobile-card-row"><span>Role</span><span>{{ $u->roles->pluck('name')->join(', ') }}</span></div>
                            <div class="mobile-card-actions">
                                @can('update user_management')
                                <a href="{{ route('users.edit', $u) }}" class="mobile-card-btn mobile-card-btn-primary">Edit</a>
                                @endcan
                                @can('delete user_management')
                                <form action="{{ route('users.destroy', $u) }}" method="POST" onsubmit="return confirmDelete(this, {{ Js::from($u->name) }})">
                                    @csrf @method('DELETE')
                                    <button class="mobile-card-btn mobile-card-btn-danger">Hapus</button>
                                </form>
                                @endcan
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6 border-t border-slate-100 pt-6">{{ $users->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
