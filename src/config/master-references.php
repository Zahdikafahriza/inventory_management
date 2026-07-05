<?php

/**
 * Konfigurasi terpusat untuk seluruh entitas Master Referensi.
 *
 * Semua CRUD master (Kategori, Merk, dll) dijalankan oleh SATU controller
 * generik (MasterReferenceController) yang membaca definisi dari sini.
 * Menambah jenis master baru cukup menambahkan satu entri di array ini.
 *
 * Key penting per entitas:
 * - table        : nama tabel master
 * - label        : label tampilan (judul halaman)
 * - label_plural : untuk teks "daftar ..."
 * - barang_column: kolom di tabel `barangs` yang nilainya diambil dari master ini.
 *                  Dipakai saat validasi hapus (cek apakah nilai masih dipakai barang).
 *                  null = tidak terhubung ke kolom barangs mana pun.
 * - icon         : nama ikon lucide untuk sidebar/heading
 * - seed         : nilai awal yang di-seed saat migrate (opsional)
 */

return [
    'kategori' => [
        'table'         => 'master_kategori',
        'label'         => 'Kategori',
        'label_plural'  => 'Kategori',
        'barang_column' => 'kategori',
        'icon'          => 'folder',
        'seed'          => ['Alat', 'Bahan'],
    ],
    'sub-kategori' => [
        'table'         => 'master_sub_kategori',
        'label'         => 'Sub Kategori',
        'label_plural'  => 'Sub Kategori',
        'barang_column' => 'sub_kategori',
        'icon'          => 'folder-tree',
        'seed'          => [],
    ],
    'merk' => [
        'table'         => 'master_merk',
        'label'         => 'Merk',
        'label_plural'  => 'Merk',
        'barang_column' => 'merk',
        'icon'          => 'tag',
        'seed'          => [],
    ],
    'tipe-spek' => [
        'table'         => 'master_tipe_spek',
        'label'         => 'Tipe / Spesifikasi',
        'label_plural'  => 'Tipe / Spesifikasi',
        'barang_column' => 'tipe_spek',
        'icon'          => 'cpu',
        'seed'          => [],
    ],
    'satuan' => [
        'table'         => 'master_satuan',
        'label'         => 'Satuan',
        'label_plural'  => 'Satuan',
        'barang_column' => 'satuan',
        'icon'          => 'ruler',
        'seed'          => ['Unit', 'Pcs', 'Set', 'Roll', 'Meter', 'Box'],
    ],
    'kondisi' => [
        'table'         => 'master_kondisi',
        'label'         => 'Kondisi',
        'label_plural'  => 'Kondisi',
        'barang_column' => 'kondisi',
        'icon'          => 'heart-pulse',
        'seed'          => ['Baik', 'Rusak', 'Retur', 'Hilang'],
    ],
    'status' => [
        'table'         => 'master_status',
        'label'         => 'Status',
        'label_plural'  => 'Status',
        'barang_column' => 'status',
        'icon'          => 'activity',
        'seed'          => ['Ready Stock', 'Dipinjam', 'Terpasang', 'Booking'],
    ],
    'lokasi' => [
        'table'         => 'master_lokasi',
        'label'         => 'Lokasi',
        'label_plural'  => 'Lokasi',
        'barang_column' => 'lokasi',
        'icon'          => 'map-pin',
        'seed'          => ['Gudang'],
    ],
];
