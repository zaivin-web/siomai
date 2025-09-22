<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        User::insert([
            [
                'name' => 'Administration',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'role_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('user123'),
                'role_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
