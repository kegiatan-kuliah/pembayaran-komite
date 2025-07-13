<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            [
                'username' => 'admin@komite.com'
            ],
            [
                'username' => 'admin@komite.com',
                'password' => bcrypt('password!23'),
                'nama' => 'Admin',
                'role' => 'ADMIN'
            ]
        );
    }
}
