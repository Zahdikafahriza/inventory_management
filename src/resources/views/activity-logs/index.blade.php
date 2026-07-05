<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">Log Aktivitas</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-medium text-brand-600">Audit</p>
            <h2 class="section-heading">Log Aktivitas</h2>
            <p class="section-subtitle">Histori seluruh perubahan data barang, termasuk update stok otomatis dari n8n.</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container">
            <div class="page-card">
                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <form method="GET" class="grid grid-cols-2 gap-3 sm:flex sm:flex-wrap sm:items-end">
                        <div class="col-span-1">
                            <label class="field-label">Sumber</label>
                            <select name="source" class="select-input py-2.5">
                                <option value="">Semua</option>
                                <option value="web" @selected(request('source') === 'web')>Web</option>
                                <option value="n8n" @selected(request('source') === 'n8n')>n8n</option>
                                <option value="system" @selected(request('source') === 'system')>System</option>
                            </select>
                        </div>
                        <div class="col-span-1">
                            <label class="field-label">Aksi</label>
                            <select name="action" class="select-input py-2.5">
                                <option value="">Semua</option>
                                @foreach($actionOptions as $opt)
                                <option value="{{ $opt }}" @selected(request('action') === $opt)>{{ ucfirst(str_replace('_', ' ', $opt)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-1">
                            <label class="field-label">Dari Tanggal</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="select-input py-2.5">
                        </div>
                        <div class="col-span-1">
                            <label class="field-label">Sampai Tanggal</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" class="select-input py-2.5">
                        </div>
                        <div class="col-span-2 flex gap-2 sm:col-span-1">
                            <button type="submit" class="btn-primary w-full sm:w-auto">
                                <svg data-lucide="filter"></svg>
                                Filter
                            </button>
                            @if(request()->anyFilled(['source', 'action', 'date_from', 'date_to']))
                            <a href="{{ route('activity-logs.index') }}" class="btn-secondary w-full sm:w-auto">
                                <svg data-lucide="x"></svg>
                                Reset
                            </a>
                            @endif
                        </div>
                    </form>
                </div>

                @if($logs->isEmpty())
                <div class="empty-state m-6 sm:m-8">
                    <svg data-lucide="inbox" class="h-6 w-6 text-slate-300"></svg>
                    <h3 class="mt-4 text-lg font-semibold text-slate-900">Belum ada aktivitas tercatat</h3>
                    <p class="mt-2 max-w-md text-sm leading-6 text-slate-500">Log akan muncul di sini setiap ada perubahan data barang dari web maupun dari workflow n8n.</p>
                </div>
                @else

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
                                    @if($log->loggable)
                                    <a href="{{ route('barangs.show', $log->loggable) }}" class="font-medium text-brand-700 hover:underline">
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
                            @if($log->loggable)
                            <a href="{{ route('barangs.show', $log->loggable) }}" class="text-brand-700 hover:underline">{{ $log->displayLabel() }}</a>
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
            </div>
        </div>
    </div>
</x-app-layout>
