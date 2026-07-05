<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RuntimeException;

class ActivityLog extends Model
{
    // Tabel append-only: tidak ada kolom updated_at
    const UPDATED_AT = null;

    protected $fillable = [
        'loggable_type',
        'loggable_id',
        'action',
        'source',
        'actor_type',
        'actor_id',
        'actor_name',
        'field_changed',
        'old_value',
        'new_value',
        'metadata',
        'n8n_event_id',
    ];

    protected $casts = [
        'metadata'   => 'array',
        'created_at' => 'datetime',
    ];

    public function loggable()
    {
        return $this->morphTo();
    }

    public function displayLabel(): string
    {
        if ($this->loggable) {
            $kode = $this->loggable->kode_aset ?? null;
            $nama = $this->loggable->nama_aset ?? null;

            if ($kode || $nama) {
                return trim(collect([$kode, $nama])->filter()->implode(' — '));
            }
        }

        $metaKode = $this->metadata['kode_aset'] ?? null;
        $metaNama = $this->metadata['nama_aset'] ?? null;

        if ($metaKode || $metaNama) {
            return trim(collect([$metaKode, $metaNama])->filter()->implode(' — ')) . ' (dihapus)';
        }

        return 'Item #' . $this->loggable_id;
    }

    public function actorLabel(): string
    {
        if ($this->actor_name) {
            return $this->actor_name . ($this->actor_id ? " ({$this->actor_id})" : '');
        }

        return $this->actor_type . ($this->actor_id ? " ({$this->actor_id})" : '');
    }

    public function metadataList(): array
    {
        $labels = [
            'kode_aset'          => 'Kode Aset',
            'nama_aset'          => 'Nama Aset',
            'kategori'           => 'Kategori',
            'sub_kategori'       => 'Sub Kategori',
            'merk'               => 'Merk',
            'tipe_spek'          => 'Tipe / Spek',
            'lokasi_penyimpanan' => 'Lokasi',
            'lokasi'             => 'Lokasi',
            'satuan'             => 'Satuan',
            'keterangan'         => 'Keterangan',
        ];

        $result = [];

        foreach ($labels as $key => $label) {
            $value = $this->metadata[$key] ?? null;

            if ($value !== null && $value !== '') {
                $result[$label] = $value;
            }
        }

        if (!empty($this->metadata['pengirim']['username'])) {
            $result['Username Telegram'] = '@' . $this->metadata['pengirim']['username'];
        }

        return $result;
    }

    public function update(array $attributes = [], array $options = []): bool
    {
        throw new RuntimeException('Activity log bersifat append-only dan tidak dapat diubah.');
    }

    public function delete(): bool|null
    {
        throw new RuntimeException('Activity log bersifat append-only dan tidak dapat dihapus.');
    }
}
