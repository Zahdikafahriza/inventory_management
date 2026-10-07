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

    /**
     * Label tampilan untuk kolom "Item" di halaman log.
     * Digeneralisasi supaya jalan untuk berbagai jenis loggable
     * (Barang, StockOpnameSession, User/login, model master lain),
     * bukan cuma yang punya kode_aset/nama_aset.
     */
    public function displayLabel(): string
    {
        if ($this->loggable) {
            $m = $this->loggable;

            if (isset($m->kode_aset) || isset($m->nama_aset)) {
                return trim(collect([$m->kode_aset ?? null, $m->nama_aset ?? null])->filter()->implode(' — '));
            }

            if (isset($m->kode_so)) {
                return $m->kode_so;
            }

            if (isset($m->name)) {
                return $m->name;
            }

            if (isset($m->nama)) {
                return $m->nama;
            }
        }

        // loggable sudah terhapus / tidak ada relasi: fallback ke metadata.
        $metaKode = $this->metadata['kode_aset'] ?? $this->metadata['kode_so'] ?? null;
        $metaNama = $this->metadata['nama_aset'] ?? $this->metadata['nama'] ?? $this->metadata['label'] ?? null;

        if ($metaKode || $metaNama) {
            return trim(collect([$metaKode, $metaNama])->filter()->implode(' — ')) . ' (dihapus)';
        }

        return class_basename($this->loggable_type) . ' #' . $this->loggable_id;
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
            'kode_so'            => 'Kode SO',
            'jumlah_barang'      => 'Jumlah Barang',
            'jumlah_berubah'     => 'Jumlah Berubah',
            'nama'               => 'Nama',
            'email'              => 'Email',
            'ip'                 => 'IP',
            'model'              => 'Model',
            'label'              => 'Label',
            'email_dicoba'       => 'Email Dicoba',
        ];

        $result = [];

        foreach ($labels as $key => $label) {
            $value = $this->metadata[$key] ?? null;

            if ($value !== null && $value !== '') {
                $result[$label] = $value;
            }
        }

        // Rincian per-barang untuk log Stock Opname yang digabung jadi 1
        // baris per sesi finalisasi (lihat StockOpnameController::finalize()).
        if (!empty($this->metadata['perubahan']) && is_array($this->metadata['perubahan'])) {
            $result['Perubahan Stok'] = collect($this->metadata['perubahan'])
                ->map(function ($p) {
                    $line = "{$p['kode_aset']}: {$p['stok_lama']} → {$p['stok_baru']}";
                    if (!empty($p['keterangan'])) {
                        $line .= " ({$p['keterangan']})";
                    }
                    return $line;
                })
                ->implode('; ');
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