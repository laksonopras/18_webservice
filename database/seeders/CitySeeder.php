<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'id' => 1,
            'city' => 'Kota Jakarta Pusat',
            'province_id'=> 1
        ]);
        City::create([
            'id' => 2,
            'city' => 'Kota Jakarta Selatan',
            'province_id'=> 1
        ]);
        City::create([
            'id' => 3,
            'city' => 'Kabupaten Tulungagung',
            'province_id'=> 2
        ]);
        City::create([
            'id' => 4,
            'city' => 'Kota Blitar',
            'province_id'=> 2
        ]);
        City::create([
            'id' => 5,
            'city' => 'Kota Malang',
            'province_id'=> 2
        ]);
    }
}
