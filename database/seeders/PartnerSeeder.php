<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Partner;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $partnerName = ['Netral', 'Mitsubishi Motor', 'Toyota AUTO 2000', 'Honda Motor', 'Berkah Abadi'];

        for ($i = 0; $i < count($partnerName); $i++) {
            $latitude = rand(-9000, 9000); // Generate a random latitude between -90 and 90
            $longitude = rand(-18000, 18000); // Generate a random longitude between -180 and 180

            Partner::create([
                'partner_name' => $partnerName[$i],
                'email' => $faker->email,
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'description' => $faker->text($maxNbChars = 200),
                'count_order' => rand(1, 1000),
                'account_status' => rand(0, 1),
                'operational_status' => rand(0, 1),
                'request_status' => 1,
                'category_id' => Category::inRandomOrder()->first()->id,
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
