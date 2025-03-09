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
        // Ambil ID role Admin, Teacher, dan Student
        $adminRole = DB::table('roles')->where('name', 'Admin')->first();
        $teacherRole = DB::table('roles')->where('name', 'Teacher')->first();
        $studentRole = DB::table('roles')->where('name', 'Student')->first();

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
                'name' => 'Admin2',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('admin2'),
                'role_id' => $adminRole->id ?? 1, // Default ke 1 jika tidak ditemukan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin3',
                'email' => 'admin3@gmail.com',
                'password' => Hash::make('admin3'),
                'role_id' => $adminRole->id ?? 1, // Default ke 1 jika tidak ditemukan
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}