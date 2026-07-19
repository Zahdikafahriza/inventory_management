<x-app-layout>
    <x-slot name="breadcrumb">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <a href="{{ route('roles.index') }}">Manajemen Role</a>
            <svg data-lucide="chevron-right" class="h-3.5 w-3.5 text-slate-300"></svg>
            <span class="is-current">Audit Log</span>
        </nav>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-medium text-brand-600">Administrasi</p>
            <h2 class="section-heading">Audit Log RBAC</h2>
            <p class="section-subtitle">Riwayat perubahan role, permission, dan user.</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="app-container">
            <div class="page-card">
                @if($logs->isEmpty())
                <div class="empty-state m-6 sm:m-8">
                    <svg data-lucide="scroll-text" class="h-6 w-6 text-slate-300"></svg>
                    <p class="mt-2 text-sm text-slate-500">Belum ada perubahan tercatat.</p>
                </div>
                @else
                <div class="hidden table-scroll lg:block">
                    <table class="data-table">
                        <thead><tr><th>Waktu</th><th>Aksi</th><th>Objek</th><th>Detail</th><th>Oleh</th></tr></thead>
                        <tbody>
                            @foreach($logs as $log)
                            <tr>
                                <td class="whitespace-nowrap">{{ $log->created_at->format('d M Y H:i') }}</td>
                                <td><span class="badge">{{ $log->action }}</span></td>
                                <td>{{ $log->subject_label ?? '-' }}</td>
                                <td class="text-xs text-slate-500">{{ $log->changes ? json_encode($log->changes, JSON_UNESCAPED_SLASHES) : '-' }}</td>
                                <td>{{ $log->actor_name ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mobile-card-list p-4 lg:hidden">
                    @foreach($logs as $log)
                    <div class="mobile-card">
                        <div class="mobile-card-top">
                            <span class="badge">{{ $log->action }}</span>
                            <span class="text-xs text-slate-400">{{ $log->created_at->format('d M H:i') }}</span>
                        </div>
                        <div class="mobile-card-row"><span>Objek</span><span>{{ $log->subject_label ?? '-' }}</span></div>
                        <div class="mobile-card-row"><span>Oleh</span><span>{{ $log->actor_name ?? '-' }}</span></div>
                    </div>
                    @endforeach
                </div>
                <div class="border-t border-slate-200 px-6 py-4 sm:px-8">{{ $logs->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
