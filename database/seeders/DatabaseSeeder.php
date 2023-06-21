<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\District;
use App\Models\Progres;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            AdminSeeder::class,
            // UserSeeder::class,
            CategorySeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            DistrictSeeder::class,
            PostalCodeSeeder::class,
            VillageSeeder::class,
            PackageSeeder::class,
            // PartnerSeeder::class,
            // TransactionSeeder::class,
            // BannerSeeder::class,
            // SquareFeedSeeder::class,
            KemajuanSeeder::class,
            
        ]);
    }
}
