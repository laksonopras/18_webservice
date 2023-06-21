<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        District::create([
            'id' => 1,
            'district' => 'Kecamatan Cempaka Putih',
            'city_id'=> 1
        ]);
        District::create([
            'id' => 2,
            'district' => 'Kecamatan Gambir',
            'city_id'=> 1
        ]);
        District::create([
            'id' => 3,
            'district' => 'Kecamatan Jagakarsa',
            'city_id'=> 2
        ]);
        District::create([
            'id' => 4,
            'district' => 'Kecamatan Kebayoran Baru',
            'city_id'=> 2
        ]);
        District::create([
            'id' => 5,
            'district' => 'Kecamatan Bandung',
            'city_id'=> 3
        ]);
        District::create([
            'id' => 6,
            'district' => 'Kecamatan Besuki',
            'city_id'=> 3
        ]);
        District::create([
            'id' => 7,
            'district' => 'Kecamatan Sananwetan',
            'city_id'=> 4
        ]);
        District::create([
            'id' => 8,
            'district' => 'Kecamatan Sukorejo',
            'city_id'=> 4
        ]);
        District::create([
            'id' => 9,
            'district' => 'Kecamatan Klojen',
            'city_id'=> 5
        ]);
        District::create([
            'id' => 10,
            'district' => 'Kecamatan Lowokwaru',
            'city_id'=> 5
        ]);
    }
}
