# Integrasi n8n — Kontrak & Panduan Keamanan

Web ini **tidak** memproses update stok. Update stok dilakukan oleh n8n dengan
menulis langsung ke database. Dokumen ini adalah kontrak yang harus dipatuhi
workflow n8n agar data tetap konsisten dan bisa diaudit dari web.

## 1. Tabel yang boleh disentuh n8n

| Tabel | Operasi yang diizinkan | Kolom yang boleh ditulis |
|---|---|---|
| `barangs` | `UPDATE` saja (baris yang sudah ada) | `stok`, `updated_by_type`, `updated_by_id`, `updated_at` |
| `activity_logs` | `INSERT` saja | semua kolom kecuali `id` |

n8n **tidak boleh**: `DELETE` di tabel manapun, `INSERT`/`UPDATE` ke `barangs`
selain kolom di atas, atau menyentuh tabel `users`, `sessions`, `cache`, `jobs`, dll.

## 2. Kontrak wajib: setiap update stok WAJIB diikuti insert log

Setiap kali workflow n8n meng-`UPDATE` kolom `stok` di tabel `barangs`, step
berikutnya dalam workflow **wajib** melakukan `INSERT` ke `activity_logs`
dengan format berikut:

```sql
INSERT INTO activity_logs (
    loggable_type, loggable_id, action, source,
    actor_type, actor_id, field_changed,
    old_value, new_value, metadata, n8n_event_id, created_at
) VALUES (
    'App\\Models\\Barang',      -- loggable_type, string literal, tetap
    :barang_id,                 -- id baris di tabel barangs yang diupdate
    'stock_updated',            -- action
    'n8n',                      -- source
    'n8n_workflow',             -- actor_type
    :workflow_name,             -- actor_id, contoh: 'sync-stok-gudang-A'
    'stok',                     -- field_changed
    :stok_lama,                 -- old_value
    :stok_baru,                 -- new_value
    :metadata_json,             -- metadata, JSON payload mentah trigger (opsional)
    :execution_id,              -- n8n_event_id, WAJIB unik per eksekusi workflow
    NOW()
);
```

**`n8n_event_id` wajib diisi dan unik** (misal pakai `$execution.id` bawaan n8n).
Kolom ini punya UNIQUE constraint di database — kalau n8n retry karena timeout,
insert kedua akan gagal (bukan tercatat dobel), sehingga log tetap akurat.

Jangan lupa juga set `updated_by_type = 'n8n'` dan `updated_by_id = :workflow_name`
saat UPDATE ke `barangs`, supaya web bisa menampilkan "terakhir diubah oleh" tanpa
perlu join ke `activity_logs`.

## 3. Buat DB user khusus n8n dengan hak akses terbatas

**Jangan** pakai kredensial database yang sama dengan aplikasi Laravel untuk n8n.
Buat user MySQL terpisah dengan hak akses seminimal mungkin:

```sql
CREATE USER 'n8n_service'@'%' IDENTIFIED BY 'GANTI_DENGAN_PASSWORD_KUAT_DAN_ACAK';

-- Hanya boleh baca semua kolom barangs (untuk cek stok saat ini sebelum update)
GRANT SELECT ON nama_database.barangs TO 'n8n_service'@'%';

-- Hanya boleh update kolom-kolom ini, TIDAK termasuk kode_aset/nama_aset/dll
GRANT UPDATE (stok, updated_by_type, updated_by_id, updated_at)
    ON nama_database.barangs TO 'n8n_service'@'%';

-- Hanya boleh insert log, tidak boleh update/delete log
GRANT INSERT ON nama_database.activity_logs TO 'n8n_service'@'%';

FLUSH PRIVILEGES;
```

Simpan kredensial ini di **credential store n8n** (bukan hardcode di node HTTP/SQL),
dan batasi akses jaringan (firewall/security group) supaya hanya server n8n yang
bisa konek ke port database.

## 4. Kenapa tidak lewat webhook API?

Karena n8n menulis langsung ke database (bukan lewat endpoint HTTP web ini),
maka **tidak diperlukan** middleware signature verification, CORS, atau rate
limiting API untuk jalur ini — kontrol keamanan dipindah sepenuhnya ke level
database (hak akses user MySQL di atas). Ini valid selama:

- Koneksi n8n → database dilakukan lewat jaringan privat/terpercaya (VPN, VPC
  internal, atau minimal dibatasi IP allowlist di firewall database).
- Kredensial `n8n_service` tidak pernah dipakai di tempat lain / tidak bocor.

Kalau nanti n8n perlu berjalan dari luar jaringan yang tidak Anda percaya penuh,
pertimbangkan kembali pola webhook HTTP + signature verification (bisa didiskusikan
terpisah jika kebutuhan berubah).
