<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <a href="{{ route('stock-opname.index') }}">Stock Opname</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">{{ $session->kode_so }}</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium text-brand-600">Stock Opname</p>
                <h2 class="section-heading">{{ $session->kode_so }}</h2>
                <p class="section-subtitle">
                    Dibuat {{ $session->created_at->format('d M Y H:i') }} oleh {{ $session->created_by_name }}.
                    @if($session->isFinalized())
                        <span class="badge badge-success ml-1">Final</span>
                    @else
                        <span class="badge badge-system ml-1">Draft</span>
                    @endif
                </p>
            </div>
            <a href="{{ route('stock-opname.index') }}" class="btn-secondary">
                <svg data-lucide="arrow-left"></svg> Kembali
            </a>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container space-y-6"
            x-data="soForm({{ $session->isDraft() ? 'true' : 'false' }}, {{ $items->whereNotNull('stok_so')->count() }})">

            @if($session->isFinalized())
            <div class="alert-success">
                <svg data-lucide="check-circle" class="mt-0.5 h-4 w-4 shrink-0"></svg>
                <span>Sesi ini sudah difinalisasi pada {{ $session->finalized_at->format('d M Y H:i') }}. Data bersifat read-only untuk keperluan audit.</span>
            </div>
            @endif
            <form method="POST"
                action="{{ route('stock-opname.update', $session) }}"
                id="soFormEl">
                @csrf
                @method('PUT')

                <div class="page-card">
                    <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">Perbandingan Stok</h3>
                                <p class="mt-1 text-sm text-slate-500">Isi kolom <strong>Hasil SO</strong> dengan jumlah fisik hasil hitung.</p>
                            </div>
                            <!-- <div class="flex flex-wrap items-center gap-2 text-xs">
                                <span class="badge badge-success">Surplus (lebih)</span>
                                <span class="badge badge-danger">Minus (kurang)</span>
                                <span class="badge badge-neutral">Sesuai</span>
                            </div> -->
                        </div>
                    </div>

                    {{-- Desktop tabel --}}
                    <div class="hidden table-scroll lg:block">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Aset</th>
                                    <th class="text-right">Stok Bulan Lalu</th>
                                    <th class="text-right">Stok Sistem</th>
                                    <th class="text-right">Hasil SO</th>
                                    <th class="text-right">Selisih</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr x-data="{ so: {{ $item->stok_so === null ? 'null' : $item->stok_so }}, sistem: {{ $item->stok_sistem }}, wasFilled: {{ $item->stok_so !== null ? 'true' : 'false' }} }"
                                    :class="{
                                        'bg-emerald-50 border-l-4 border-emerald-400': isDraft && so !== null && so !== '',
                                        'bg-red-100 border-l-4 border-red-400': isDraft && (so === null || so === '') && filledCount > 0
                                    }">
                                    <td class="font-medium text-slate-700">{{ $item->kode_aset }}</td>
                                    <td>{{ $item->nama_aset }}</td>
                                    <td class="text-right">{{ $item->stok_bulan_lalu === null ? '—' : number_format($item->stok_bulan_lalu) }}</td>
                                    <td class="text-right font-semibold text-slate-800">{{ number_format($item->stok_sistem) }}</td>
                                    <td class="text-right">
                                        @if($session->isDraft())
                                        <input type="number" min="0"
                                            name="items[{{ $item->id }}]"
                                            value="{{ $item->stok_so }}"
                                            x-model.number="so"
                                            @input="const filled = (so !== null && so !== ''); if (filled !== wasFilled) { wasFilled = filled; filled ? filledCount++ : filledCount-- }"
                                            :disabled="!isDesktop"
                                            class="w-24 rounded-lg border border-slate-200 px-2 py-1.5 text-right text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 disabled:opacity-0 disabled:pointer-events-none">
                                        @else
                                        {{ $item->stok_so === null ? '—' : number_format($item->stok_so) }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($session->isDraft())
                                        <template x-if="so === null || so === ''">
                                            <span class="text-slate-300">—</span>
                                        </template>
                                        <template x-if="so !== null && so !== ''">
                                            <span class="badge"
                                                :class="{
                                                    'badge-success': (so - sistem) > 0,
                                                    'badge-danger': (so - sistem) < 0,
                                                    'badge-neutral': (so - sistem) === 0
                                                }"
                                                x-text="(so - sistem) > 0 ? '+' + (so - sistem) : (so - sistem)"></span>
                                        </template>
                                        @else
                                            @php($sel = $item->selisih)
                                            @if($sel === null)
                                                <span class="text-slate-300">—</span>
                                            @else
                                                <span class="badge {{ $sel > 0 ? 'badge-success' : ($sel < 0 ? 'badge-danger' : 'badge-neutral') }}">
                                                    {{ $sel > 0 ? '+'.$sel : $sel }}
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($session->isDraft())
                                        <input type="text" maxlength="255"
                                            name="keterangan[{{ $item->id }}]"
                                            value="{{ $item->keterangan }}"
                                            placeholder="contoh : tidak ditemukan"
                                            :disabled="!isDesktop"
                                            class="w-56 rounded-lg border border-slate-200 px-2 py-1.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 disabled:opacity-0 disabled:pointer-events-none">
                                        @else
                                        <span class="text-slate-600">{{ $item->keterangan ?? '—' }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Mobile kartu --}}
                    <div class="mobile-card-list p-4 lg:hidden">
                        @foreach($items as $item)
                        <div class="mobile-card" x-data="{ so: {{ $item->stok_so === null ? 'null' : $item->stok_so }}, sistem: {{ $item->stok_sistem }}, wasFilled: {{ $item->stok_so !== null ? 'true' : 'false' }} }"
                            :class="{
                                'bg-emerald-50 border-l-4 border-emerald-400': isDraft && so !== null && so !== '',
                                'bg-red-100 border-l-4 border-red-400': isDraft && (so === null || so === '') && filledCount > 0
                            }">
                            <div class="mobile-card-top">
                                <span class="text-base font-semibold text-slate-800">{{ $item->nama_aset }}</span>
                                <span class="text-xs text-slate-400">{{ $item->kode_aset }}</span>
                            </div>
                            <div class="mobile-card-row"><span>Bulan Lalu</span><span>{{ $item->stok_bulan_lalu === null ? '—' : number_format($item->stok_bulan_lalu) }}</span></div>
                            <div class="mobile-card-row"><span>Sistem</span><span class="font-semibold">{{ number_format($item->stok_sistem) }}</span></div>
                            <div class="mobile-card-row">
                                <span>Hasil SO</span>
                                <span>
                                    @if($session->isDraft())
                                    <input type="number" min="0"
                                        name="items[{{ $item->id }}]"
                                        value="{{ $item->stok_so }}"
                                        x-model.number="so"
                                        @input="const filled = (so !== null && so !== ''); if (filled !== wasFilled) { wasFilled = filled; filled ? filledCount++ : filledCount-- }"
                                        :disabled="isDesktop"
                                        class="w-24 rounded-lg border border-slate-200 px-2 py-1.5 text-right text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 disabled:opacity-0 disabled:pointer-events-none">
                                    @else
                                    {{ $item->stok_so === null ? '—' : number_format($item->stok_so) }}
                                    @endif
                                </span>
                            </div>
                            <div class="mobile-card-row">
                                <span>Selisih</span>
                                <span>
                                    @if($session->isDraft())
                                    <template x-if="so === null || so === ''"><span class="text-slate-300">—</span></template>
                                    <template x-if="so !== null && so !== ''">
                                        <span class="badge" :class="{ 'badge-success': (so-sistem)>0, 'badge-danger': (so-sistem)<0, 'badge-neutral': (so-sistem)===0 }"
                                            x-text="(so-sistem)>0 ? '+'+(so-sistem) : (so-sistem)"></span>
                                    </template>
                                    @else
                                        @php($sel = $item->selisih)
                                        @if($sel === null)<span class="text-slate-300">—</span>
                                        @else<span class="badge {{ $sel>0?'badge-success':($sel<0?'badge-danger':'badge-neutral') }}">{{ $sel>0?'+'.$sel:$sel }}</span>@endif
                                    @endif
                                </span>
                            </div>
                            <div class="mobile-card-row">
                                <span>Keterangan</span>
                                <span>
                                    @if($session->isDraft())
                                    <input type="text" maxlength="255"
                                        name="keterangan[{{ $item->id }}]"
                                        value="{{ $item->keterangan }}"
                                        placeholder="opsional..."
                                        :disabled="isDesktop"
                                        class="w-40 rounded-lg border border-slate-200 px-2 py-1.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 disabled:opacity-0 disabled:pointer-events-none">
                                    @else
                                    <span class="text-slate-600">{{ $item->keterangan ?? '—' }}</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </form>

            @if($session->isDraft())
            <div class="page-card mt-6 p-6 sm:p-8">
                <label class="field-label" for="catatan">Catatan (opsional)</label>
                {{-- form="soFormEl" menghubungkan textarea ini kembali ke form di
                     atas walau posisinya sekarang di luar tag <form> --}}
                <textarea id="catatan" name="catatan" form="soFormEl" rows="2" class="select-input" placeholder="Catatan sesi opname ini...">{{ $session->catatan }}</textarea>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    {{-- Form "Batalkan Draft" sekarang jadi sibling, BUKAN nested --}}
                    <form method="POST" action="{{ route('stock-opname.destroy', $session) }}"
                        onsubmit="return confirmDelete(this, '{{ $session->kode_so }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">
                            <svg data-lucide="trash-2"></svg> Batalkan Draft
                        </button>
                    </form>

                    <div class="flex flex-col-reverse gap-3 sm:flex-row">
                        {{-- form="soFormEl" supaya tombol ini tetap submit form
                             utama walau secara DOM sudah tidak nested lagi --}}
                        <button type="submit" form="soFormEl" class="btn-secondary">
                            <svg data-lucide="save"></svg> Simpan Draft
                        </button>
                        <button type="button" class="btn-success" @click="finalize()">
                            <svg data-lucide="check-circle"></svg> Finalisasi &amp; Update Master
                        </button>
                    </div>
                </div>
            </div>
            @endif

            {{-- Form tersembunyi untuk finalisasi --}}
            @if($session->isDraft())
            <form method="POST" action="{{ route('stock-opname.finalize', $session) }}" id="finalizeForm" class="hidden">
                @csrf
            </form>
            @endif
        </div>
    </div>

    <script>
        function forceSwalButtonsVisible() {
            const confirmBtn = Swal.getConfirmButton();
            const cancelBtn = Swal.getCancelButton();
            [confirmBtn, cancelBtn].forEach((btn) => {
                if (!btn) return;
                btn.style.setProperty('display', 'inline-block', 'important');
                btn.style.setProperty('visibility', 'visible', 'important');
                btn.style.setProperty('opacity', '1', 'important');
            });
        }

        function soForm(isDraft, initialFilledCount) {
            return {
                isDraft,
                isDesktop: window.matchMedia('(min-width: 1024px)').matches,
                // Jumlah barang yang Hasil SO-nya sudah diisi (client-side, live).
                // Dipakai tiap baris (lewat merge scope Alpine) untuk nentuin
                // kapan baris kosong mulai ditandai merah — SENGAJA baru
                // muncul warnanya begitu ada minimal 1 barang yang keisi,
                // bukan langsung merah semua pas SO baru dibuka.
                filledCount: initialFilledCount,
                init() {
                    const mq = window.matchMedia('(min-width: 1024px)');
                    const sync = (e) => { this.isDesktop = e.matches; };
                    if (mq.addEventListener) {
                        mq.addEventListener('change', sync);
                    } else {
                        // fallback browser lama
                        mq.addListener(sync);
                    }
                },
                finalize() {
                    Swal.fire({
                        title: 'Finalisasi Stock Opname?',
                        html: 'Stok di <strong>Master Barang</strong> akan diperbarui dengan nilai Hasil SO.<br>Tindakan ini <strong>tidak bisa dibatalkan</strong>.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, finalisasi',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#4f46e5',
                        cancelButtonColor: '#64748b',
                        reverseButtons: true,
                        customClass: { popup: 'rounded-2xl' },
                        didOpen: () => {
                        const confirmBtn = Swal.getConfirmButton();
                        const cancelBtn = Swal.getCancelButton();
                        [[confirmBtn, '#4f46e5'], [cancelBtn, '#64748b']].forEach(([btn, color]) => {
                            if (!btn) return;
                            btn.style.setProperty('background-color', color, 'important');
                            btn.style.setProperty('color', '#ffffff', 'important');
                            btn.style.setProperty('display', 'inline-block', 'important');
                            btn.style.setProperty('visibility', 'visible', 'important');
                            btn.style.setProperty('opacity', '1', 'important');
                        });
                    },
                    }).then((r) => {
                        if (!r.isConfirmed) return;
                        const main = document.getElementById('soFormEl');
                        const fin = document.getElementById('finalizeForm');
                        const catatanEl = document.getElementById('catatan');

                        main.querySelectorAll('input[name^="items"]:not(:disabled), input[name^="keterangan"]:not(:disabled)').forEach((el) => {
                            const clone = document.createElement('input');
                            clone.type = 'hidden';
                            clone.name = el.name;
                            clone.value = el.value;
                            fin.appendChild(clone);
                        });

                        if (catatanEl) {
                            const clone = document.createElement('input');
                            clone.type = 'hidden';
                            clone.name = 'catatan';
                            clone.value = catatanEl.value;
                            fin.appendChild(clone);
                        }

                        fin.submit();
                    });
                }
            };
        }

        function confirmDelete(form, kode) {
            Swal.fire({
                title: `Batalkan draft ${kode}?`,
                html: 'Draft Stock Opname ini akan <strong>dihapus permanen</strong> dan tidak bisa dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, batalkan',
                cancelButtonText: 'Tidak',
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                reverseButtons: true,
                focusCancel: true,
                customClass: { popup: 'rounded-2xl' },
                didOpen: () => {
                const confirmBtn = Swal.getConfirmButton();
                const cancelBtn = Swal.getCancelButton();
                [[confirmBtn, '#4f46e5'], [cancelBtn, '#64748b']].forEach(([btn, color]) => {
                    if (!btn) return;
                    btn.style.setProperty('background-color', color, 'important');
                    btn.style.setProperty('color', '#ffffff', 'important');
                    btn.style.setProperty('display', 'inline-block', 'important');
                    btn.style.setProperty('visibility', 'visible', 'important');
                    btn.style.setProperty('opacity', '1', 'important');
                });
            },
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

            // WAJIB: hentikan submit bawaan browser sampai user konfirmasi
            return false;
        }
    </script>
</x-app-layout>