<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel untuk fitur Stock Opname (SO).
 *
 * - stock_opname_sessions: header sesi SO (satu sesi = satu kali opname semua barang).
 * - stock_opname_items    : detail per barang dalam sesi tsb, menyimpan tiga nilai
 *                           stok (bulan lalu / sistem saat ini / hasil fisik SO).
 *
 * Histori tersimpan permanen untuk keperluan audit — sesi yang sudah final
 * tidak dihapus.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_opname_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('kode_so')->unique();            // mis. SO-20260705-001
            $table->enum('status', ['draft', 'finalized'])->default('draft');
            $table->string('catatan')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();  // user id pembuat
            $table->string('created_by_name')->nullable();
            $table->timestamp('finalized_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });

        Schema::create('stock_opname_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')
                ->constrained('stock_opname_sessions')
                ->cascadeOnDelete();
            $table->foreignId('barang_id')
                ->constrained('barangs')
                ->cascadeOnDelete();

            // Snapshot identitas barang saat SO dibuat (agar histori tetap terbaca
            // walau barang kelak diubah/dihapus).
            $table->string('kode_aset')->nullable();
            $table->string('nama_aset')->nullable();

            $table->integer('stok_bulan_lalu')->nullable();   // dari SO terakhir yg final
            $table->integer('stok_sistem');                    // stok di master saat SO dibuat
            $table->integer('stok_so')->nullable();            // hasil hitung fisik (input user)

            $table->timestamps();

            $table->unique(['session_id', 'barang_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_opname_items');
        Schema::dropIfExists('stock_opname_sessions');
    }
};
