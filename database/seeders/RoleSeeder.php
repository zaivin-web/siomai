<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        Role::insert([
            ['name' => 'Admin', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'User', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
