<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel ini bersifat APPEND-ONLY.
     * Tidak ada kolom `updated_at` dan tidak menggunakan SoftDeletes,
     * karena log aktivitas tidak boleh diubah/dihapus oleh siapa pun
     * melalui aplikasi (lihat App\Models\ActivityLog).
     */
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // Target yang di-log (polymorphic, future-proof untuk entitas lain)
            $table->string('loggable_type');
            $table->unsignedBigInteger('loggable_id');

            // created | updated | deleted | stock_updated | dst
            $table->string('action', 50);

            // Siapa/apa pemicunya
            $table->enum('source', ['web', 'n8n', 'system'])->default('web');
            $table->enum('actor_type', ['user', 'n8n_workflow', 'system'])->default('user');
            $table->string('actor_id')->nullable(); // user_id, atau nama workflow n8n

            // Detail perubahan
            $table->string('field_changed')->nullable();
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->json('metadata')->nullable(); // payload mentah / konteks tambahan

            // Untuk idempotency: cegah n8n mencatat log dobel saat retry
            $table->string('n8n_event_id')->nullable()->unique();

            $table->timestamp('created_at')->useCurrent();

            $table->index(['loggable_type', 'loggable_id']);
            $table->index('source');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};