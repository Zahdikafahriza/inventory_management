<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">Manajemen Role</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium text-brand-600">Administrasi</p>
                <h2 class="section-heading">Manajemen Role &amp; Hak Akses</h2>
                <p class="section-subtitle">Atur role secara dinamis beserta hak aksesnya per fitur.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('roles.audit') }}" class="btn-secondary"><svg data-lucide="scroll-text"></svg> Audit Log</a>
                @can('create role_management')
                <a href="{{ route('roles.create') }}" class="btn-primary"><svg data-lucide="plus"></svg> Tambah Role</a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($roles as $role)
                <div class="soft-card p-5">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl {{ $role->name === 'Super Admin' ? 'bg-red-50 text-red-600' : 'bg-brand-50 text-brand-600' }}">
                                <svg data-lucide="shield-check" class="h-5 w-5"></svg>
                            </span>
                            <div>
                                <p class="font-semibold text-slate-900">{{ $role->name }}</p>
                                <p class="text-xs text-slate-400">{{ $role->users_count }} user · {{ $role->name === 'Super Admin' ? 'semua akses' : $role->permissions_count.' izin' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 flex gap-2">
                        @if(in_array($role->name, config('rbac.protected_roles')))
                        <span class="badge badge-danger">Role Sistem</span>
                        @else
                        @can('update role_management')
                        <a href="{{ route('roles.edit', $role) }}" class="btn-secondary btn-sm flex-1 justify-center"><svg data-lucide="sliders-horizontal"></svg> Atur Akses</a>
                        @endcan
                        @can('delete role_management')
                        <form action="{{ route('roles.destroy', $role) }}" method="POST" onsubmit="return confirmDelete(this, {{ Js::from($role->name) }})">
                            @csrf @method('DELETE')
                            <button class="btn-ghost btn-sm text-red-600 hover:bg-red-50"><svg data-lucide="trash-2"></svg></button>
                        </form>
                        @endcan
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
