<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <a href="{{ route('barangs.index') }}">Master Barang</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">Tambah Barang</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-medium text-brand-600">Inventaris</p>
            <h2 class="section-heading">Tambah Barang</h2>
            <p class="section-subtitle">Tambahkan data barang baru ke sistem inventaris.</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container">
            <div class="form-card">
                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <h3 class="text-lg font-semibold text-slate-900">Form Barang Baru</h3>
                    <p class="mt-1 text-sm text-slate-500">Isi informasi utama barang dengan lengkap agar data mudah dikelola.</p>
                </div>

                <div class="p-6 sm:p-8">
                    <form action="{{ route('barangs.store') }}" method="POST" class="space-y-8"
                        x-data="{
                            kategori: @js(old('kategori', '')),
                            kode: @js(old('kode_aset', '')),
                            loading: false,
                            async fetchKode() {
                                if (!this.kategori) { this.kode = ''; return; }
                                this.loading = true;
                                try {
                                    const url = '{{ route('barangs.preview-kode') }}?kategori=' + encodeURIComponent(this.kategori);
                                    const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                                    const data = await res.json();
                                    this.kode = data.kode_aset || '';
                                } catch (e) {
                                    this.kode = '';
                                } finally {
                                    this.loading = false;
                                }
                            }
                        }"
                        x-init="if (kategori && !kode) fetchKode()"
                    >
                        @csrf

                        <div>
                            <p class="mb-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Identitas Aset</p>
                            <div class="form-grid">
                                <div>
                                    <x-input-label for="kategori" :value="__('Kategori')" />
                                    <select id="kategori" name="kategori" class="select-input mt-1" required
                                        x-model="kategori" @change="fetchKode()">
                                        <option value="">Pilih kategori</option>
                                        @php($katOpts = collect($masterOptions['kategori'] ?? []))
                                        @if($katOpts->isEmpty())
                                            @php($katOpts = collect(['Alat', 'Bahan']))
                                        @endif
                                        @foreach($katOpts as $opt)
                                        <option value="{{ $opt }}" @selected(old('kategori') === $opt)>{{ $opt }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('kategori')" />
                                </div>

                                <div>
                                    <x-input-label for="kode_aset" :value="__('Kode Aset')" />
                                    <div class="relative mt-1">
                                        {{-- Field tampilan (read-only). Nilai asli dikirim lewat hidden input di bawah. --}}
                                        <input type="text" readonly
                                            class="w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 shadow-sm"
                                            :value="loading ? 'Menghitung...' : (kode || 'Pilih kategori dulu')"
                                        >
                                        <span x-show="loading" class="absolute right-3 top-1/2 -translate-y-1/2">
                                            <span class="spinner text-brand-500"></span>
                                        </span>
                                    </div>
                                    {{-- Kode tetap dihitung ulang di server saat simpan; hidden ini hanya untuk kejelasan. --}}
                                    <input type="hidden" name="kode_aset" :value="kode">
                                    <p class="mt-1 text-xs text-slate-400">Otomatis dibuat dari kategori (Alat &rarr; A, Bahan &rarr; B). Tidak dapat diubah.</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('kode_aset')" />
                                </div>

                                <div>
                                    <x-input-label for="nama_aset" :value="__('Nama Aset')" />
                                    <x-text-input id="nama_aset" name="nama_aset" type="text" class="mt-1 block w-full" :value="old('nama_aset')" required autofocus placeholder="Contoh: Laptop Dell Latitude 5420" />
                                    <x-input-error class="mt-2" :messages="$errors->get('nama_aset')" />
                                </div>

                                <x-master-select name="sub_kategori" label="Sub Kategori" :options="$masterOptions['sub_kategori'] ?? []" />
                            </div>
                        </div>

                        <div>
                            <p class="mb-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Spesifikasi</p>
                            <div class="form-grid">
                                <x-master-select name="merk" label="Merk" :options="$masterOptions['merk'] ?? []" />

                                <x-master-select name="tipe_spek" label="Tipe / Spesifikasi" :options="$masterOptions['tipe_spek'] ?? []" />

                                <div>
                                    <x-input-label for="serial_number" :value="__('Serial Number')" />
                                    <x-text-input id="serial_number" name="serial_number" type="text" class="mt-1 block w-full" :value="old('serial_number')" placeholder="Opsional" />
                                    <x-input-error class="mt-2" :messages="$errors->get('serial_number')" />
                                </div>

                                <div>
                                    <x-input-label for="mac_address" :value="__('Mac Address')" />
                                    <x-text-input id="mac_address" name="mac_address" type="text" class="mt-1 block w-full" :value="old('mac_address')" placeholder="Opsional, khusus perangkat jaringan" />
                                    <x-input-error class="mt-2" :messages="$errors->get('mac_address')" />
                                </div>

                                <x-master-select name="satuan" label="Satuan" :options="$masterOptions['satuan'] ?? []" />

                                <div>
                                    <x-input-label for="stok" :value="__('Stok')" />
                                    <x-text-input id="stok" name="stok" type="number" class="mt-1 block w-full" :value="old('stok', 0)" min="0" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('stok')" />
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="mb-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Status &amp; Lokasi</p>
                            <div class="form-grid">
                                <x-master-select name="kondisi" label="Kondisi" :options="$masterOptions['kondisi'] ?? []" required />

                                <x-master-select name="status" label="Status" :options="$masterOptions['status'] ?? []" required />

                                <x-master-select name="lokasi" label="Lokasi" :options="$masterOptions['lokasi'] ?? []" />

                                <div>
                                    <x-input-label for="pic" :value="__('PIC')" />
                                    <x-text-input id="pic" name="pic" type="text" class="mt-1 block w-full" :value="old('pic')" placeholder="Penanggung jawab barang" />
                                    <x-input-error class="mt-2" :messages="$errors->get('pic')" />
                                </div>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="keterangan" :value="__('Keterangan')" />
                            <textarea id="keterangan" name="keterangan" rows="3" class="select-input" placeholder="Catatan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('keterangan')" />
                        </div>

                        <div class="alert-info">
                            <svg data-lucide="info" class="mt-0.5 h-4 w-4 shrink-0"></svg>
                            <span>Kode aset harus unik dan tidak boleh sama dengan barang lain. Pastikan data ditulis jelas agar pencarian dan pelacakan lebih mudah.</span>
                        </div>

                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end">
                            <a href="{{ route('barangs.index') }}" class="btn-secondary">
                                Batal
                            </a>
                            <x-primary-button>
                                <svg data-lucide="save"></svg>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
