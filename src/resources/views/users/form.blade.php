<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <a href="{{ route('users.index') }}">Manajemen User</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">{{ $user->exists ? 'Edit' : 'Tambah' }}</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-medium text-brand-600">Administrasi</p>
            <h2 class="section-heading">{{ $user->exists ? 'Edit User' : 'Tambah User' }}</h2>
            <p class="section-subtitle">Atur data akun dan role yang melekat.</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container">
            <div class="form-card mx-auto max-w-2xl">
                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <h3 class="text-lg font-semibold text-slate-900">Data User</h3>
                </div>
                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ $user->exists ? route('users.update', $user) : route('users.store') }}" class="space-y-6">
                        @csrf
                        @if($user->exists) @method('PUT') @endif

                        <div class="form-grid">
                            <div>
                                <x-input-label for="name" value="Nama Lengkap" />
                                <x-text-input id="name" name="name" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="username" value="Username" />
                                <x-text-input id="username" name="username" class="mt-1 block w-full" :value="old('username', $user->username)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('username')" />
                            </div>
                            <div>
                                <x-input-label for="email" value="Email" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                            <div>
                                <x-input-label for="password" :value="$user->exists ? 'Password Baru (opsional)' : 'Password'" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" :required="!$user->exists" autocomplete="new-password" />
                                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                            </div>
                            <div>
                                <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" :required="!$user->exists" autocomplete="new-password" />
                            </div>
                            <div>
                            <x-input-label for="roles" value="Role" />
                            @php($userRoles = old('roles', $user->exists ? $user->getRoleNames()->all() : []))
                            <select id="roles" name="roles[]"
                                class="mt-1 block w-full h-auto border border-slate-300 rounded-xl">
                                @foreach($roles as $roleName)
                                    <option value="{{ $roleName }}" @selected(in_array($roleName, $userRoles))>{{ $roleName }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('roles')" />
                        </div>
                        </div>
                        @if($user->exists)
                            <p class="-mt-4 text-xs text-slate-400">Kosongkan password bila tidak ingin mengubahnya.</p>
                        @endif

                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                            <a href="{{ route('users.index') }}" class="btn-secondary">Batal</a>
                            <x-primary-button><svg data-lucide="save"></svg> Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>