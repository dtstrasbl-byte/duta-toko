<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed akun admin default.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@dutabakery.com'],
            [
                'name'     => 'Admin Duta Bakery',
                'password' => bcrypt('admin123'),
            ]
        );
    }
}
