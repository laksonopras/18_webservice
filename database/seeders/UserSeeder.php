<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        User::create([
            "username" => "Ferdy Hahan Pradana",
            "email" => "user@user.com",
            "password" => Hash::make('password'),
            "no_phone"=> "+6285085085085",
        ]);
        User::create([
            "username" => "Ferdy Hahan Pradana 2",
            "email" => "user2@user.com",
            "password" => Hash::make('password'),
            "no_phone"=> "+6285085085081",
        ]);
        for ($i = 1; $i <= 10; $i++) {

            User::create([
                "username" => $faker->username,
                "email" => $faker->email,
                "password" => Hash::make('userpassword'),
                "no_phone"=> "+628508508504" . $i,
            ]);
        }
    }
}
