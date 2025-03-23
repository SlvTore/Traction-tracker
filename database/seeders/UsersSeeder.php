<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil ID role Admin, Owner, Mentor, dan Member
        $adminRole = DB::table('roles')->where('name', 'Admin')->first();
        $ownerRole = DB::table('roles')->where('name', 'Owner')->first();
        $mentorRole = DB::table('roles')->where('name', 'Mentor')->first();
        $memberRole = DB::table('roles')->where('name', 'Member')->first();

        // Insert Users
        DB::table('users')->insert([
            [
                'name' => 'Admin1',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('admin1'),
                'role_id' => $adminRole->id ?? 1, // Default ke 1 jika tidak ditemukan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Owner1',
                'email' => 'owner1@gmail.com',
                'password' => Hash::make('owner1'),
                'role_id' => $ownerRole->id ?? 1, // Default ke 1 jika tidak ditemukan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mentor1',
                'email' => 'mentor1@gmail.com',
                'password' => Hash::make('mentor1'),
                'role_id' => $mentorRole->id ?? 1, // Default ke 1 jika tidak ditemukan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Member1',
                'email' => 'member1@gmail.com',
                'password' => Hash::make('member1'),
                'role_id' => $memberRole->id ?? 1, // Default ke 1 jika tidak ditemukan
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}