<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

/**
 * Semua pencatatan log yang dipicu dari aplikasi web WAJIB lewat service ini,
 * supaya format data di tabel activity_logs konsisten dan gampang diaudit.
 *
 * Catatan: log untuk perubahan yang dilakukan n8n (update stok langsung ke DB)
 * TIDAK lewat service ini — n8n bertanggung jawab insert baris log-nya sendiri
 * langsung ke tabel activity_logs sebagai bagian dari workflow-nya
 * (lihat dokumentasi kontrak di README).
 */
class ActivityLogger
{
    public static function log(
        string $loggableType,
        int $loggableId,
        string $action,
        ?string $fieldChanged = null,
        mixed $oldValue = null,
        mixed $newValue = null,
        array $metadata = []
    ): ActivityLog {
        return ActivityLog::create([
            'loggable_type' => $loggableType,
            'loggable_id'   => $loggableId,
            'action'        => $action,
            'source'        => 'web',
            'actor_type'    => 'user',
            'actor_id'      => (string) (Auth::id() ?? 'system'),
            'field_changed' => $fieldChanged,
            'old_value'     => $oldValue !== null ? (string) $oldValue : null,
            'new_value'     => $newValue !== null ? (string) $newValue : null,
            'metadata'      => $metadata ?: null,
        ]);
    }
}
