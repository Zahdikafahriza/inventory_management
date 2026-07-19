<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migrasi data role lama -> RBAC dinamis.
 *
 * Pemetaan nilai role lama dilakukan di RbacSeeder (dijalankan setelah migrate).
 * Migration ini HANYA menghapus kolom `role` lama dari tabel users setelah
 * data dipindahkan. Dijalankan defensif: hanya drop bila kolomnya ada.
 *
 * PENTING urutan deploy:
 *   1) php artisan migrate           (buat tabel spatie + audit; kolom role MASIH ada)
 *   2) php artisan db:seed --class=RbacSeeder   (buat role/permission + assign ke user berdasarkan kolom role lama)
 *   3) migration ini akan men-drop kolom role saat migrate berikutnya.
 *
 * Agar aman, migration ini diberi nomor paling akhir sehingga bisa dijalankan
 * TERPISAH setelah seeder. Kalau kamu menjalankan `migrate` sekaligus, seeder
 * tetap bisa membaca role dari kolom sebelum di-drop bila kamu seed dulu.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('user');
            });
        }
    }
};
