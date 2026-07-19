<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockOpnameItem extends Model
{
    protected $fillable = [
        'session_id',
        'barang_id',
        'kode_aset',
        'nama_aset',
        'stok_bulan_lalu',
        'stok_sistem',
        'stok_so',
    ];

    protected $casts = [
        'stok_bulan_lalu' => 'integer',
        'stok_sistem'     => 'integer',
        'stok_so'         => 'integer',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(StockOpnameSession::class, 'session_id');
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    /**
     * Selisih hasil SO terhadap stok sistem.
     * null bila hasil SO belum diinput. Positif = surplus, negatif = minus.
     */
    public function getSelisihAttribute(): ?int
    {
        if ($this->stok_so === null) {
            return null;
        }

        return $this->stok_so - $this->stok_sistem;
    }
}
