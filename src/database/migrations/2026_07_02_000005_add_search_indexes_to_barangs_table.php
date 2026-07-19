<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->index('nama_aset', 'barangs_nama_aset_index');
            $table->index('kategori', 'barangs_kategori_index');
            $table->index('lokasi', 'barangs_lokasi_index');
        });
    }

    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropIndex('barangs_nama_aset_index');
            $table->dropIndex('barangs_kategori_index');
            $table->dropIndex('barangs_lokasi_index');
        });
    }
};
