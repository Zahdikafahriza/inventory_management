<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <a href="{{ route('barangs.index') }}">Master Barang</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">Edit</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-2 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium text-brand-600">Inventaris</p>
                <h2 class="section-heading">Edit Barang</h2>
                <p class="section-subtitle">Perbarui informasi barang agar data inventaris tetap akurat.</p>
            </div>
            <a href="{{ route('barangs.show', $barang) }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 hover:text-brand-700">
                Lihat riwayat aktivitas barang ini
                <svg data-lucide="arrow-right" class="h-4 w-4"></svg>
            </a>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container">
            <div class="form-card">
                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <h3 class="text-lg font-semibold text-slate-900">Detail Barang</h3>
                    <p class="mt-1 text-sm text-slate-500">Sesuaikan data barang sesuai kondisi terbaru.</p>
                </div>

                <div class="p-6 sm:p-8">
                    @if($barang->updated_by_type)
                    <div class="alert-info mb-6">
                        <svg data-lucide="clock" class="mt-0.5 h-4 w-4 shrink-0"></svg>
                        <span>
                            Terakhir diubah oleh
                            <span class="font-semibold">{{ strtoupper($barang->updated_by_type) }}</span>
                            @if($barang->updated_by_id) ({{ $barang->updated_by_id }}) @endif
                            &middot; {{ $barang->updated_at->diffForHumans() }}
                            @if($barang->updated_by_type === 'n8n')
                                <span class="badge badge-n8n ml-1">Otomatis via n8n</span>
                            @endif
                        </span>
                    </div>
                    @endif

                    <form action="{{ route('barangs.update', $barang) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <div>
                            <p class="mb-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Identitas Aset</p>
                            <div class="form-grid">
                                <div>
                                    <x-input-label for="kode_aset" :value="__('Kode Aset')" />
                                    <input type="text" readonly
                                        class="mt-1 w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 shadow-sm"
                                        value="{{ $barang->kode_aset }}">
                                    <p class="mt-1 text-xs text-slate-400">Kode aset bersifat permanen dan tidak dapat diubah.</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('kode_aset')" />
                                </div>

                                <div>
                                    <x-input-label for="nama_aset" :value="__('Nama Aset')" />
                                    <x-text-input id="nama_aset" name="nama_aset" type="text" class="mt-1 block w-full" :value="old('nama_aset', $barang->nama_aset)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('nama_aset')" />
                                </div>

                                <x-master-select name="kategori" label="Kategori" :options="$masterOptions['kategori'] ?? []" :selected="$barang->kategori" required />

                                <x-master-select name="sub_kategori" label="Sub Kategori" :options="$masterOptions['sub_kategori'] ?? []" :selected="$barang->sub_kategori" />
                            </div>
                        </div>

                        <div>
                            <p class="mb-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Spesifikasi</p>
                            <div class="form-grid">
                                <x-master-select name="merk" label="Merk" :options="$masterOptions['merk'] ?? []" :selected="$barang->merk" />

                                <x-master-select name="tipe_spek" label="Tipe / Spesifikasi" :options="$masterOptions['tipe_spek'] ?? []" :selected="$barang->tipe_spek" />

                                <div>
                                    <x-input-label for="serial_number" :value="__('Serial Number')" />
                                    <x-text-input id="serial_number" name="serial_number" type="text" class="mt-1 block w-full" :value="old('serial_number', $barang->serial_number)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('serial_number')" />
                                </div>

                                <div>
                                    <x-input-label for="mac_address" :value="__('Mac Address')" />
                                    <x-text-input id="mac_address" name="mac_address" type="text" class="mt-1 block w-full" :value="old('mac_address', $barang->mac_address)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('mac_address')" />
                                </div>

                                <x-master-select name="satuan" label="Satuan" :options="$masterOptions['satuan'] ?? []" :selected="$barang->satuan" />

                                <div>
                                    <x-input-label for="stok" :value="__('Stok')" />
                                    <x-text-input id="stok" name="stok" type="number" class="mt-1 block w-full" :value="old('stok', $barang->stok)" min="0" required />
                                    <p class="mt-1 text-xs text-slate-400">Mengubah stok di sini akan tercatat sebagai perubahan manual oleh user pada log aktivitas.</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('stok')" />
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="mb-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Status &amp; Lokasi</p>
                            <div class="form-grid">
                                <x-master-select name="kondisi" label="Kondisi" :options="$masterOptions['kondisi'] ?? []" :selected="$barang->kondisi" required />

                                <x-master-select name="status" label="Status" :options="$masterOptions['status'] ?? []" :selected="$barang->status" required />

                                <x-master-select name="lokasi" label="Lokasi" :options="$masterOptions['lokasi'] ?? []" :selected="$barang->lokasi" />

                                <div>
                                    <x-input-label for="pic" :value="__('PIC')" />
                                    <x-text-input id="pic" name="pic" type="text" class="mt-1 block w-full" :value="old('pic', $barang->pic)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('pic')" />
                                </div>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="keterangan" :value="__('Keterangan')" />
                            <textarea id="keterangan" name="keterangan" rows="3" class="select-input">{{ old('keterangan', $barang->keterangan) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('keterangan')" />
                        </div>

                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end">
                            <a href="{{ route('barangs.index') }}" class="btn-secondary">
                                Batal
                            </a>
                            <x-primary-button>
                                <svg data-lucide="save"></svg>
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
