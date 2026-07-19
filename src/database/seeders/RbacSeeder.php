<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RbacSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1) Generate seluruh permission dari config/rbac.php
        $allPermissions = [];
        foreach (config('rbac.features') as $key => $feature) {
            foreach ($feature['abilities'] as $ability) {
                $name = "{$ability} {$key}";      // mis. "create barang"
                Permission::findOrCreate($name, 'web');
                $allPermissions[] = $name;
            }
        }

        // 2) Role default
        // Super Admin: tidak perlu permission eksplisit (di-bypass Gate::before),
        // tapi tetap dibuat sebagai role.
        $superAdmin = Role::findOrCreate('Super Admin', 'web');

        // Admin: semua permission (bisa disesuaikan lewat UI nanti).
        $admin = Role::findOrCreate('Admin', 'web');
        $admin->syncPermissions($allPermissions);

        // Staff: read-only + operasi ringan (contoh default yang masuk akal).
        $staff = Role::findOrCreate('Staff', 'web');
        $staff->syncPermissions(array_values(array_filter($allPermissions, function ($p) {
            return str_starts_with($p, 'view ')
                || in_array($p, ['create stock_opname', 'update stock_opname', 'export barang'], true);
        })));

        // 3) Migrasi role lama (kolom users.role) -> role RBAC
        if (Schema::hasColumn('users', 'role')) {
            User::query()->get()->each(function (User $user) use ($admin, $staff) {
                $old = DB::table('users')->where('id', $user->id)->value('role');
                $target = $old === 'admin' ? $admin : $staff;
                if (!$user->hasAnyRole(['Super Admin', 'Admin', 'Staff'])) {
                    $user->assignRole($target);
                }
            });
        }

        // 4) Pastikan minimal ada satu Super Admin.
        // Prioritas: user dengan username 'admin', jika tidak ada ambil user pertama.
        $superUser = User::where('username', 'admin')->first() ?? User::orderBy('id')->first();
        if ($superUser && !$superUser->hasRole('Super Admin')) {
            $superUser->syncRoles(['Super Admin']);
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
