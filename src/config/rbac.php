<?php

/**
 * Taxonomy fitur & permission aplikasi.
 *
 * Dipakai untuk:
 *  - Seed daftar permission ke tabel Spatie (php artisan db:seed / rbac:sync).
 *  - Membangun matriks permission per-role di halaman Manajemen Role.
 *
 * Menambah fitur baru cukup menambahkan entri di sini lalu jalankan
 * `php artisan rbac:sync`. Tidak perlu mengubah struktur kode.
 *
 * Konvensi nama permission: "{ability} {group_key}" — mis. "create barang".
 * ability: view | create | update | delete (subset per fitur boleh berbeda).
 */

return [
    // Menu / fitur yang punya CRUD penuh
    'features' => [
        'dashboard' => [
            'label'     => 'Dashboard',
            'icon'      => 'layout-dashboard',
            'route'     => 'dashboard',
            'abilities' => ['view'],
        ],
        'barang' => [
            'label'     => 'Master Barang',
            'icon'      => 'package',
            'route'     => 'barangs.index',
            'abilities' => ['view', 'create', 'update', 'delete', 'export'],
        ],
        'activity_log' => [
            'label'     => 'Log Aktivitas',
            'icon'      => 'history',
            'route'     => 'activity-logs.index',
            'abilities' => ['view'],
        ],
        'stock_opname' => [
            'label'     => 'Stock Opname',
            'icon'      => 'clipboard-check',
            'route'     => 'stock-opname.index',
            'abilities' => ['view', 'create', 'finalize', 'delete'],
        ],
        'master_reference' => [
            'label'     => 'Master Referensi',
            'icon'      => 'layers',
            'route'     => null, // punya submenu, tak ada route tunggal
            'abilities' => ['view', 'create', 'update', 'delete'],
        ],
        'user_management' => [
            'label'     => 'Manajemen User',
            'icon'      => 'users',
            'route'     => 'users.index',
            'abilities' => ['view', 'create', 'update', 'delete'],
        ],
        'role_management' => [
            'label'     => 'Manajemen Role',
            'icon'      => 'shield-check',
            'route'     => 'roles.index',
            'abilities' => ['view', 'create', 'update', 'delete'],
        ],
    ],

    // Label ramah untuk tiap ability (dipakai header kolom matriks).
    'ability_labels' => [
        'view'     => 'Lihat',
        'create'   => 'Tambah',
        'update'   => 'Ubah',
        'delete'   => 'Hapus',
        'export'   => 'Export',
        'finalize' => 'Finalisasi',
    ],

    // Role default yang selalu ada. 'Super Admin' otomatis punya semua izin
    // (di-handle Gate::before), tidak bisa dihapus/diubah dari UI.
    'protected_roles' => ['Super Admin'],
];
