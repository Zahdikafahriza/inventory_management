<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * PENTING — Baca sebelum menjalankan migration ini.
 *
 * Migration `2025_12_03_062523_create_barangs_table.php` yang ada di project
 * hanya membuat kolom: nama_barang, jenis_barang, stock_awal.
 *
 * Namun `App\Models\Barang` dan `BarangController` sudah memakai kolom lain:
 * kode_aset, nama_aset, kategori, sub_kategori, merk, tipe_spek, serial_number,
 * mac_address, satuan, stok, kondisi, status, lokasi, pic, keterangan.
 *
 * Ini menandakan skema di database production KEMUNGKINAN BESAR sudah diubah
 * secara manual (bukan lewat migration) — sehingga migration di repo tidak lagi
 * merepresentasikan skema asli. Ini masalah reproducibility yang perlu diperbaiki.
 *
 * Migration ini dibuat DEFENSIF (cek hasColumn sebelum menambah) supaya:
 * - Aman dijalankan di environment yang skemanya SUDAH sesuai (kolom di-skip).
 * - Bisa dipakai untuk menyamakan environment lain (staging/fresh install) yang
 *   migration historynya belum punya kolom-kolom ini.
 *
 * REKOMENDASI: setelah ini jalan di semua environment, hapus/gabungkan migration
 * lama yang sudah tidak relevan (nama_barang/jenis_barang/stock_awal) supaya
 * riwayat migration kembali jadi satu sumber kebenaran yang akurat.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            if (!Schema::hasColumn('barangs', 'kode_aset')) {
                $table->string('kode_aset', 50)->unique()->nullable();
            }
            if (!Schema::hasColumn('barangs', 'nama_aset')) {
                $table->string('nama_aset')->nullable();
            }
            if (!Schema::hasColumn('barangs', 'kategori')) {
                $table->string('kategori', 50)->nullable();
            }
            if (!Schema::hasColumn('barangs', 'sub_kategori')) {
                $table->string('sub_kategori', 100)->nullable();
            }
            if (!Schema::hasColumn('barangs', 'merk')) {
                $table->string('merk', 100)->nullable();
            }
            if (!Schema::hasColumn('barangs', 'tipe_spek')) {
                $table->string('tipe_spek')->nullable();
            }
            if (!Schema::hasColumn('barangs', 'serial_number')) {
                $table->string('serial_number', 150)->nullable();
            }
            if (!Schema::hasColumn('barangs', 'mac_address')) {
                $table->string('mac_address', 100)->nullable();
            }
            if (!Schema::hasColumn('barangs', 'satuan')) {
                $table->string('satuan', 50)->nullable();
            }
            if (!Schema::hasColumn('barangs', 'stok')) {
                $table->integer('stok')->default(0);
            }
            if (!Schema::hasColumn('barangs', 'kondisi')) {
                $table->string('kondisi')->nullable();
            }
            if (!Schema::hasColumn('barangs', 'status')) {
                $table->string('status')->nullable();
            }
            if (!Schema::hasColumn('barangs', 'lokasi')) {
                $table->string('lokasi', 150)->nullable();
            }
            if (!Schema::hasColumn('barangs', 'pic')) {
                $table->string('pic', 100)->nullable();
            }
            if (!Schema::hasColumn('barangs', 'keterangan')) {
                $table->text('keterangan')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Sengaja tidak drop kolom di sini untuk mencegah kehilangan data
        // secara tidak sengaja di environment yang skemanya memang sudah begini.
        // Kembalikan manual jika benar-benar perlu rollback.
    }
};