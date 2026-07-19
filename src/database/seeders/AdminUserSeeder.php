<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Role tidak diset di sini lagi; penetapan role dilakukan RbacSeeder
        // (user pertama otomatis jadi Super Admin).
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('P@ssw0rd'),
            ]
        );
    }
}
