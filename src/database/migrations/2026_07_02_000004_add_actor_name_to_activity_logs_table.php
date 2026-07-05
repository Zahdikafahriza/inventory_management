<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('activity_logs', 'actor_name')) {
                $table->string('actor_name', 150)->nullable()->after('actor_id');
            }
        });
    }

    public function down(): void
    {
        // Sengaja tidak drop kolom untuk mencegah kehilangan data.
    }
};
