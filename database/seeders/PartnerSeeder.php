<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Partner;
use App\Models\User;
use App\Models\Village;
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
        $request_status = [null, 0, 1];
        for ($i = 0; $i < 50; $i++) {
            // $latitude = rand(-9000, 9000); // Generate a random latitude between -90 and 90
            // $longitude = rand(-18000, 18000); // Generate a random longitude between -180 and 180

            $partner = Partner::create([
                'partner_name' => $partnerName[rand(0, 4)],
                'email' => $faker->email,
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                // 'latitude' => $latitude,
                // 'longitude' => $longitude,
                'description' => $faker->text($maxNbChars = 200),
                'count_order' => rand(1, 1000),
                'account_status' => rand(0, 1),
                'operational_status' => rand(0, 1),
                'request_status' => $request_status[rand(0, 2)],
                'category_id' => Category::inRandomOrder()->first()->id,
                'user_id' => User::inRandomOrder()->first()->id,
                'link_google_map' => "https://goo.gl/maps/Qr8qa2vx94zgV9a3A",
                'village_id' => Village::inRandomOrder()->first()->id
            ]);

            $user = User::find($partner->user_id);
            $user->update(['partner_id' => $partner->id]);
        }
    }
}
