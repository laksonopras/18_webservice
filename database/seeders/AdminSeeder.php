<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'username' => "adminferdy",
            'email' => 'admin@admin.com',
            'password' => Hash::make('Admin12345.'),
        ]);
        Admin::create([
            'username' => "admingupron",
            'email' => 'admin2@admin.com',
            'password' => Hash::make('Admin12345.'),
        ]);
        Admin::create([
            'username' => "adminpras",
            'email' => 'admin3@admin.com',
            'password' => Hash::make('Admin12345.'),
        ]);
        Admin::create([
            'username' => "adminfazlul",
            'email' => 'admin4@admin.com',
            'password' => Hash::make('Admin12345.'),
        ]);
        Admin::create([
            'username' => "adminbagas",
            'email' => 'admin5@admin.com',
            'password' => Hash::make('Admin12345.'),
        ]);
    }
}
