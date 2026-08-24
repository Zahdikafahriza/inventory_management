<?php

namespace App\Models\Concerns;

use App\Services\ActivityLogger;

/**
 * Tempel trait ini ke model master referensi manapun (mis. Kategori, Lokasi,
 * Satuan, Ruangan, dll) supaya create/update/delete-nya OTOMATIS tercatat ke
 * activity_logs lewat ActivityLogger::log(), tanpa perlu menulis logging
 * manual di setiap controller.
 *
 * Cara pakai di model:
 *
 *   class Kategori extends Model
 *   {
 *       use \App\Models\Concerns\LogsActivity;
 *
 *       // opsional: kolom mana yang dipakai sebagai "nama tampilan" di
 *       // metadata log. Default: kolom "nama" kalau ada.
 *       protected $logDisplayColumn = 'nama';
 *
 *       // opsional: kolom yang TIDAK usah dicatat perubahannya
 *       // (timestamps sudah otomatis dikecualikan)
 *       protected $logExcept = [];
 *   }
 */
trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            $model->writeActivityLog('create', null, null, null);
        });

        static::updated(function ($model) {
            $except = array_merge(['updated_at'], $model->logExcept ?? []);
            $changes = array_diff_key($model->getChanges(), array_flip($except));

            if (empty($changes)) {
                return;
            }

            foreach ($changes as $field => $newValue) {
                $model->writeActivityLog(
                    'update',
                    $field,
                    $model->getOriginal($field),
                    $newValue
                );
            }
        });

        static::deleted(function ($model) {
            $model->writeActivityLog('delete', null, null, null);
        });
    }

    protected function writeActivityLog(string $action, ?string $field, mixed $old, mixed $new): void
    {
        $displayColumn = $this->logDisplayColumn ?? 'nama';
        $label = $this->{$displayColumn} ?? $this->getKey();

        // ActivityLogger::log() men-cast old/new value ke (string) kalau
        // tidak null, jadi di sini keduanya sudah dijamin scalar (bukan
        // array) karena datang dari 1 kolom Eloquent, aman dikirim langsung.
        ActivityLogger::log(
            loggableType: static::class,
            loggableId: (int) $this->getKey(),
            action: $action,
            fieldChanged: $field,
            oldValue: $old,
            newValue: $new,
            metadata: [
                'model' => class_basename(static::class),
                'label' => $label,
            ],
        );
    }
}