<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Test Pertama',
                'description' => 'Role pertama dalam sistem',
                'status' => 1, // 1 = aktif
                'created_at' => now(),
                'created_id' => 1, // Misal ID admin pertama
                'updated_at' => now(),
                'updated_id' => 1,
            ],
            [
                'name' => 'Test Kedua',
                'description' => 'Role kedua dalam sistem',
                'status' => 1, // 1 = aktif
                'created_at' => now(),
                'created_id' => 1,
                'updated_at' => now(),
                'updated_id' => 1,
            ]
        ]);
    }
}
