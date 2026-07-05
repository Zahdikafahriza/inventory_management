<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <a href="{{ route('master.index', $config['type']) }}">{{ $config['label'] }}</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">Tambah</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-medium text-brand-600">Master Referensi</p>
            <h2 class="section-heading">Tambah {{ $config['label'] }}</h2>
            <p class="section-subtitle">Tambahkan pilihan {{ strtolower($config['label']) }} baru.</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container">
            <div class="form-card mx-auto max-w-xl">
                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <h3 class="text-lg font-semibold text-slate-900">Form {{ $config['label'] }}</h3>
                </div>
                <div class="p-6 sm:p-8">
                    <form action="{{ route('master.store', $config['type']) }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="nama" :value="'Nama ' . $config['label']" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full"
                                :value="old('nama')" required autofocus placeholder="Masukkan {{ strtolower($config['label']) }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                        </div>

                        <label class="flex items-center gap-3">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}
                                class="rounded border-slate-300 text-brand-600 shadow-sm focus:ring-brand-500">
                            <span class="text-sm text-slate-600">Aktif (tampil sebagai pilihan di form barang)</span>
                        </label>

                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end">
                            <a href="{{ route('master.index', $config['type']) }}" class="btn-secondary">Batal</a>
                            <x-primary-button>
                                <svg data-lucide="save"></svg>
                                Simpan
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
