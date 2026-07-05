<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model generik untuk seluruh tabel Master Referensi.
 *
 * Karena semua tabel master berstruktur identik (id, nama, is_active),
 * kita pakai satu model saja dan set tabelnya secara dinamis via forTable().
 */
class MasterReference extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Buat instance model yang terikat ke tabel master tertentu.
     */
    public static function forTable(string $table): self
    {
        $model = new self();
        $model->setTable($table);

        return $model;
    }

    /**
     * Query builder yang sudah terikat ke tabel master tertentu.
     */
    public static function query_for(string $table)
    {
        return self::forTable($table)->newQuery();
    }
}
