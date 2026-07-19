<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Audit log khusus perubahan RBAC (role & permission).
 * Terpisah dari activity_logs (yang untuk data barang) agar jelas domainnya.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rbac_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action');                 // role.created, permission.granted, user.role_assigned, dst
            $table->string('subject_type')->nullable(); // Role | Permission | User
            $table->string('subject_label')->nullable(); // nama role/permission/user terdampak
            $table->json('changes')->nullable();      // detail before/after
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->string('actor_name')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('action');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rbac_audit_logs');
    }
};
