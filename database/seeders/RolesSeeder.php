<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'business-owner', 'description' => 'Business Owner with full access'],
            ['name' => 'administrator', 'description' => 'Administrator with management access'],
            ['name' => 'staff', 'description' => 'Staff with basic access'],
            ['name' => 'business-investigator', 'description' => 'Business Investigator with view-only access']
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role['name'],
                'description' => $role['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
