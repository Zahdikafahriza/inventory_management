<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom ini opsional tapi berguna untuk menampilkan "terakhir diubah oleh"
     * langsung di tabel/list barang tanpa perlu join ke activity_logs.
     * Kolom ini juga yang akan diisi n8n saat melakukan UPDATE langsung ke DB.
     */
    public function up(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->enum('updated_by_type', ['user', 'n8n', 'system'])->nullable();
            $table->string('updated_by_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropColumn(['updated_by_type', 'updated_by_id']);
        });
    }
};
