@if($logs->isEmpty())
<div class="empty-state m-6 sm:m-8">
    <svg data-lucide="inbox" class="h-6 w-6 text-slate-300"></svg>
    <h3 class="mt-4 text-lg font-semibold text-slate-900">Belum ada aktivitas tercatat</h3>
    <p class="mt-2 max-w-md text-sm leading-6 text-slate-500">Log akan muncul di sini setiap ada perubahan data barang/master, login, atau finalisasi stock opname.</p>
</div>
@else

{{--
    PENTING: link "Item" sebelumnya SELALU diarahkan ke
    route('barangs.show', $log->loggable) untuk SEMUA jenis
    log. Ini rusak begitu loggable-nya bukan Barang (mis. User
    untuk login, StockOpnameSession untuk SO, atau model
    master lain) — route model binding akan salah/mismatch.

    Fix: link hanya dibuat kalau loggable_type memang Barang.
    Untuk StockOpnameSession, diarahkan ke halaman SO terkait
    (kalau route-nya ada). Jenis lain ditampilkan sebagai teks
    biasa (tidak diklik) supaya tidak salah arah.
--}}
@php
    $barangClass  = \App\Models\Barang::class;
    $soClass      = \App\Models\StockOpnameSession::class;
@endphp

{{-- Desktop: tabel --}}
<div class="hidden table-scroll lg:block">
    <table class="data-table">
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Item</th>
                <th>Aksi</th>
                <th>Sumber</th>
                <th>Aktor</th>
                <th>Field</th>
                <th>Sebelum</th>
                <th>Sesudah</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td class="whitespace-nowrap">{{ $log->created_at->format('d M Y H:i') }}</td>
                <td>
                    @if($log->loggable && $log->loggable_type === $barangClass)
                    <a href="{{ route('barangs.show', $log->loggable) }}" class="font-medium text-brand-700 hover:underline">
                        {{ $log->displayLabel() }}
                    </a>
                    @elseif($log->loggable && $log->loggable_type === $soClass && \Illuminate\Support\Facades\Route::has('stock-opname.show'))
                    <a href="{{ route('stock-opname.show', $log->loggable) }}" class="font-medium text-brand-700 hover:underline">
                        {{ $log->displayLabel() }}
                    </a>
                    @else
                    <span class="text-slate-500">{{ $log->displayLabel() }}</span>
                    @endif
                </td>
                <td><span class="badge">{{ ucfirst(str_replace('_', ' ', $log->action)) }}</span></td>
                <td>
                    <span class="badge {{ $log->source === 'n8n' ? 'badge-n8n' : ($log->source === 'system' ? 'badge-system' : 'badge-web') }}">
                        {{ strtoupper($log->source) }}
                    </span>
                </td>
                <td>{{ $log->actorLabel() }}</td>
                <td>{{ $log->field_changed ?? '-' }}</td>
                <td class="max-w-[160px] truncate" title="{{ $log->old_value }}">{{ $log->old_value ?? '-' }}</td>
                <td class="max-w-[160px] truncate" title="{{ $log->new_value }}">{{ $log->new_value ?? '-' }}</td>
                <td>
                    @php($metaList = $log->metadataList())
                    @if(!empty($metaList))
                    <details class="log-detail">
                        <summary>Lihat</summary>
                        <div class="log-detail-panel">
                            @foreach($metaList as $label => $value)
                            <div class="log-detail-row"><span>{{ $label }}</span><span>{{ $value }}</span></div>
                            @endforeach
                        </div>
                    </details>
                    @else
                    <span class="text-slate-400">-</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Mobile / tablet kecil: kartu --}}
<div class="mobile-card-list p-4 lg:hidden">
    @foreach ($logs as $log)
    <div class="mobile-card">
        <div class="mobile-card-top">
            <span class="badge">{{ ucfirst(str_replace('_', ' ', $log->action)) }}</span>
            <span class="badge {{ $log->source === 'n8n' ? 'badge-n8n' : ($log->source === 'system' ? 'badge-system' : 'badge-web') }}">
                {{ strtoupper($log->source) }}
            </span>
        </div>

        <p class="mt-2 text-sm font-semibold text-slate-800">
            @if($log->loggable && $log->loggable_type === $barangClass)
            <a href="{{ route('barangs.show', $log->loggable) }}" class="text-brand-700 hover:underline">{{ $log->displayLabel() }}</a>
            @elseif($log->loggable && $log->loggable_type === $soClass && \Illuminate\Support\Facades\Route::has('stock-opname.show'))
            <a href="{{ route('stock-opname.show', $log->loggable) }}" class="text-brand-700 hover:underline">{{ $log->displayLabel() }}</a>
            @else
            {{ $log->displayLabel() }}
            @endif
        </p>

        <div class="mobile-card-row"><span>Waktu</span><span>{{ $log->created_at->format('d M Y H:i') }}</span></div>
        <div class="mobile-card-row"><span>Aktor</span><span>{{ $log->actorLabel() }}</span></div>
        @if($log->field_changed)
        <div class="mobile-card-row"><span>Field</span><span>{{ $log->field_changed }}</span></div>
        <div class="mobile-card-row"><span>Sebelum</span><span>{{ $log->old_value ?? '-' }}</span></div>
        <div class="mobile-card-row"><span>Sesudah</span><span>{{ $log->new_value ?? '-' }}</span></div>
        @endif

        @php($metaList = $log->metadataList())
        @if(!empty($metaList))
        <details class="log-detail mt-3">
            <summary>Lihat detail lengkap</summary>
            <div class="log-detail-panel">
                @foreach($metaList as $label => $value)
                <div class="log-detail-row"><span>{{ $label }}</span><span>{{ $value }}</span></div>
                @endforeach
            </div>
        </details>
        @endif
    </div>
    @endforeach
</div>

<div class="border-t border-slate-200 px-6 py-4 sm:px-8">
    {{ $logs->links() }}
</div>
@endif
