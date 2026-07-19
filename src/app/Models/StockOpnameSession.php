<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockOpnameSession extends Model
{
    protected $fillable = [
        'kode_so',
        'status',
        'catatan',
        'created_by',
        'created_by_name',
        'finalized_at',
    ];

    protected $casts = [
        'finalized_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(StockOpnameItem::class, 'session_id');
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isFinalized(): bool
    {
        return $this->status === 'finalized';
    }

    /**
     * Buat kode SO unik berurut per hari, mis. SO-20260705-001.
     */
    public static function generateKode(): string
    {
        $prefix = 'SO-' . now()->format('Ymd') . '-';
        $lastNumber = static::where('kode_so', 'like', $prefix . '%')
            ->orderByDesc('kode_so')
            ->value('kode_so');

        $next = 1;
        if ($lastNumber && preg_match('/-(\d+)$/', $lastNumber, $m)) {
            $next = (int) $m[1] + 1;
        }

        return $prefix . str_pad((string) $next, 3, '0', STR_PAD_LEFT);
    }
}
