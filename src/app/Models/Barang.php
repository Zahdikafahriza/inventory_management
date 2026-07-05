<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Barang extends Model
{
    protected $table = 'barangs';

    protected $fillable = [
        'kode_aset',
        'kategori',
        'sub_kategori',
        'nama_aset',
        'merk',
        'tipe_spek',
        'serial_number',
        'mac_address',
        'satuan',
        'stok',
        'kondisi',
        'status',
        'lokasi',
        'pic',
        'keterangan',
        'updated_by_type',
        'updated_by_id',
    ];

    /**
     * Histori aktivitas terkait barang ini, termasuk update stok dari n8n.
     */
    public function activityLogs(): MorphMany
    {
        return $this->morphMany(ActivityLog::class, 'loggable');
    }

    /**
     * Peta kategori -> prefix kode aset.
     * Alat = A, Bahan = B. Kategori lain (kalau ada) fallback ke huruf pertamanya.
     */
    public static function prefixForKategori(?string $kategori): string
    {
        $key = mb_strtoupper(trim((string) $kategori));

        return match ($key) {
            'ALAT'  => 'A',
            'BAHAN' => 'B',
            default => $key !== '' ? mb_substr($key, 0, 1) : 'X',
        };
    }

    /**
     * Hasilkan kode aset berikutnya untuk sebuah kategori.
     * Contoh: prefix B, kode terakhir B045 -> "B046". Format 3 digit nol depan.
     *
     * Nomor dihitung dari kode_aset yang SUDAH ADA di database dengan prefix sama,
     * jadi tidak perlu kolom counter terpisah.
     */
    public static function nextKodeAset(?string $kategori): string
    {
        $prefix = self::prefixForKategori($kategori);

        // Ambil angka terbesar dari kode ber-prefix ini.
        $codes = self::where('kode_aset', 'like', $prefix . '%')->pluck('kode_aset');

        $max = 0;
        foreach ($codes as $code) {
            // Ambil bagian angka setelah prefix (mis. "B045" -> 45).
            if (preg_match('/^' . preg_quote($prefix, '/') . '(\d+)$/', $code, $m)) {
                $max = max($max, (int) $m[1]);
            }
        }

        return $prefix . str_pad((string) ($max + 1), 3, '0', STR_PAD_LEFT);
    }
}