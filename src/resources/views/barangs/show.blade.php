<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <a href="{{ route('barangs.index') }}">Master Barang</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">Detail</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-2 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium text-brand-600">Inventaris</p>
                <h2 class="section-heading">{{ $barang->nama_aset }}</h2>
                <p class="section-subtitle">Kode aset: {{ $barang->kode_aset }}</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('barangs.index') }}" class="btn-secondary">
                    <svg data-lucide="arrow-left"></svg>
                    Kembali
                </a>
                @can('update', $barang)
                <a href="{{ route('barangs.edit', $barang) }}" class="btn-primary">
                    <svg data-lucide="pencil"></svg>
                    Edit Barang
                </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="page-section space-y-6">
        <div class="app-container space-y-6">

            {{-- Detail barang --}}
            <div class="page-card">
                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <h3 class="text-lg font-semibold text-slate-900">Detail Barang</h3>
                </div>
                <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 sm:grid-cols-2 sm:p-8 lg:grid-cols-3">
                    @php
                        $fields = [
                            'Kode Aset' => $barang->kode_aset,
                            'Nama Aset' => $barang->nama_aset,
                            'Kategori' => $barang->kategori,
                            'Sub Kategori' => $barang->sub_kategori,
                            'Merk' => $barang->merk,
                            'Tipe/Spek' => $barang->tipe_spek,
                            'Serial Number' => $barang->serial_number,
                            'Mac Address' => $barang->mac_address,
                            'Satuan' => $barang->satuan,
                            'Stok' => number_format($barang->stok),
                            'Kondisi' => $barang->kondisi,
                            'Status' => $barang->status,
                            'Lokasi' => $barang->lokasi,
                            'PIC' => $barang->pic,
                        ];
                    @endphp
                    @foreach($fields as $label => $value)
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">{{ $label }}</p>
                        <p class="mt-1 text-sm font-medium text-slate-800">{{ $value ?: '-' }}</p>
                    </div>
                    @endforeach

                    <div class="sm:col-span-2 lg:col-span-3">
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Keterangan</p>
                        <p class="mt-1 text-sm leading-6 text-slate-600">{{ $barang->keterangan ?: '-' }}</p>
                    </div>

                    @if($barang->updated_by_type)
                    <div class="sm:col-span-2 lg:col-span-3">
                        <span class="badge">
                            <svg data-lucide="clock"></svg>
                            Terakhir diubah oleh {{ strtoupper($barang->updated_by_type) }}
                            @if($barang->updated_by_id) ({{ $barang->updated_by_id }}) @endif
                            &middot; {{ $barang->updated_at->diffForHumans() }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Log aktivitas khusus barang ini --}}
            <div class="page-card">
                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <h3 class="text-lg font-semibold text-slate-900">Riwayat Aktivitas Barang Ini</h3>
                    <p class="mt-1 text-sm text-slate-500">Termasuk perubahan stok otomatis dari n8n.</p>
                </div>

                @php($itemLogs = $barang->activityLogs()->latest('created_at')->get())

                @if($itemLogs->isEmpty())
                <div class="empty-state m-6 sm:m-8">
                    <svg data-lucide="inbox" class="h-6 w-6 text-slate-300"></svg>
                    <p class="mt-2 text-sm text-slate-500">Belum ada aktivitas tercatat untuk barang ini.</p>
                </div>
                @else
                <div class="hidden table-scroll sm:block">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>Aksi</th>
                                <th>Sumber</th>
                                <th>Aktor</th>
                                <th>Field</th>
                                <th>Sebelum</th>
                                <th>Sesudah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($itemLogs as $log)
                            <tr>
                                <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                                <td><span class="badge">{{ $log->action }}</span></td>
                                <td>
                                    <span class="badge {{ $log->source === 'n8n' ? 'badge-n8n' : ($log->source === 'system' ? 'badge-system' : 'badge-web') }}">
                                        {{ strtoupper($log->source) }}
                                    </span>
                                </td>
                                <td>{{ $log->actorLabel() }}</td>
                                <td>{{ $log->field_changed ?? '-' }}</td>
                                <td>{{ $log->old_value ?? '-' }}</td>
                                <td>{{ $log->new_value ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile card view --}}
                <div class="mobile-card-list p-4 sm:hidden">
                    @foreach($itemLogs as $log)
                    <div class="mobile-card">
                        <div class="mobile-card-top">
                            <span class="badge">{{ $log->action }}</span>
                            <span class="badge {{ $log->source === 'n8n' ? 'badge-n8n' : ($log->source === 'system' ? 'badge-system' : 'badge-web') }}">
                                {{ strtoupper($log->source) }}
                            </span>
                        </div>
                        <div class="mobile-card-row"><span>Waktu</span><span>{{ $log->created_at->format('d M Y H:i') }}</span></div>
                        <div class="mobile-card-row"><span>Aktor</span><span>{{ $log->actorLabel() }}</span></div>
                        <div class="mobile-card-row"><span>Field</span><span>{{ $log->field_changed ?? '-' }}</span></div>
                        <div class="mobile-card-row"><span>Sebelum</span><span>{{ $log->old_value ?? '-' }}</span></div>
                        <div class="mobile-card-row"><span>Sesudah</span><span>{{ $log->new_value ?? '-' }}</span></div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
