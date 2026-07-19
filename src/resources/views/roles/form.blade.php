<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <a href="{{ route('roles.index') }}">Manajemen Role</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">{{ $role->exists ? $role->name : 'Role Baru' }}</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-medium text-brand-600">Administrasi</p>
            <h2 class="section-heading">{{ $role->exists ? 'Atur Hak Akses' : 'Tambah Role' }}</h2>
            <p class="section-subtitle">{{ $role->exists ? 'Perubahan hak akses tersimpan otomatis.' : 'Beri nama role, lalu atur hak aksesnya.' }}</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container space-y-6">
            {{-- Nama role --}}
            <div class="form-card">
                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ $role->exists ? route('roles.update', $role) : route('roles.store') }}"
                        class="flex flex-col gap-4 sm:flex-row sm:items-end">
                        @csrf
                        @if($role->exists) @method('PUT') @endif
                        <div class="flex-1">
                            <x-input-label for="name" value="Nama Role" />
                            <x-text-input id="name" name="name" class="mt-1 block w-full" :value="old('name', $role->name)" required placeholder="mis. Supervisor Gudang" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <x-primary-button><svg data-lucide="save"></svg> {{ $role->exists ? 'Simpan Nama' : 'Buat Role' }}</x-primary-button>
                    </form>
                </div>
            </div>

            {{-- Matriks permission (autosave) --}}
            @if($role->exists)
            <div class="page-card"
                x-data="permissionMatrix('{{ route('roles.toggle-permission', $role) }}', '{{ csrf_token() }}')">
                <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5 sm:px-8">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Hak Akses per Fitur</h3>
                        <p class="mt-1 text-sm text-slate-500">Klik toggle untuk memberi/mencabut izin. Otomatis tersimpan.</p>
                    </div>
                    <span class="flex items-center gap-2 text-sm" x-show="status" x-transition>
                        <template x-if="status === 'saving'"><span class="flex items-center gap-1.5 text-slate-500"><span class="spinner"></span> Menyimpan...</span></template>
                        <template x-if="status === 'saved'"><span class="flex items-center gap-1.5 text-emerald-600"><svg data-lucide="check" class="h-4 w-4"></svg> Tersimpan <span x-text="savedAt" class="text-slate-400"></span></span></template>
                        <template x-if="status === 'error'"><span class="flex items-center gap-1.5 text-red-600"><svg data-lucide="alert-circle" class="h-4 w-4"></svg> Gagal, coba lagi</span></template>
                    </span>
                </div>

                <div class="divide-y divide-slate-100">
                    @foreach($matrix as $row)
                    <div class="flex flex-col gap-4 px-6 py-5 sm:px-8 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-center gap-6">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                                <svg data-lucide="{{ $row['icon'] }}" class="h-5 w-5"></svg>
                            </span>
                            <span class="font-medium text-slate-800">{{ $row['label'] }}</span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach($row['abilities'] as $ab)
                            <label
                                class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 transition-all hover:border-brand-300 hover:bg-brand-50">

                                <input
                                    type="checkbox"
                                    @checked($ab['granted'])
                                    @change="toggle($event, '{{ $ab['permission'] }}')"
                                    class="h-5 w-5 rounded border-slate-300 text-brand-600 focus:ring-2 focus:ring-brand-500">

                                <span class="flex flex-col">
                                    <span class="font-medium text-slate-800">
                                        {{ $ab['label'] }}
                                    </span>
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="alert-info">
                <svg data-lucide="info" class="mt-0.5 h-4 w-4 shrink-0"></svg>
                <span>Simpan role terlebih dahulu, lalu kamu bisa mengatur hak aksesnya.</span>
            </div>
            @endif
        </div>
    </div>

    <script>
        function permissionMatrix(url, token) {
            return {
                status: null,
                savedAt: '',
                _timer: null,
                async toggle(e, permission) {
                    const granted = e.target.checked;
                    this.status = 'saving';
                    try {
                        const res = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ permission, granted }),
                        });
                        if (!res.ok) throw new Error('failed');
                        const data = await res.json();
                        this.status = 'saved';
                        this.savedAt = data.saved_at ? '(' + data.saved_at + ')' : '';
                        clearTimeout(this._timer);
                        this._timer = setTimeout(() => { this.status = null; }, 2500);
                    } catch (err) {
                        e.target.checked = !granted; // rollback tampilan
                        this.status = 'error';
                    }
                }
            };
        }
    </script>
</x-app-layout>
