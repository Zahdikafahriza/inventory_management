<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RbacAuditLog extends Model
{
    const UPDATED_AT = null;

    protected $fillable = [
        'action', 'subject_type', 'subject_label', 'changes', 'actor_id', 'actor_name',
    ];

    protected $casts = [
        'changes'    => 'array',
        'created_at' => 'datetime',
    ];

    /**
     * Helper pencatatan cepat.
     */
    public static function record(string $action, ?string $subjectType = null, ?string $subjectLabel = null, array $changes = []): void
    {
        static::create([
            'action'        => $action,
            'subject_type'  => $subjectType,
            'subject_label' => $subjectLabel,
            'changes'       => $changes ?: null,
            'actor_id'      => auth()->id(),
            'actor_name'    => auth()->user()?->name,
        ]);
    }
}
