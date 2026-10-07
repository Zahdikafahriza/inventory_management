<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Keterangan PER BARANG dalam satu sesi SO — bukan catatan sesi
     * (kolom stock_opname_sessions.catatan yang sudah ada, itu tetap
     * dipakai untuk catatan umum sesi). Ini untuk hal spesifik per item,
     * mis. "2 pcs rusak dipisah dari stok baik", "dipinjam ke gudang B".
     */
    public function up(): void
    {
        Schema::table('stock_opname_items', function (Blueprint $table) {
            $table->string('keterangan', 255)->nullable()->after('stok_so');
        });
    }

    public function down(): void
    {
        Schema::table('stock_opname_items', function (Blueprint $table) {
            $table->dropColumn('keterangan');
        });
    }
};
