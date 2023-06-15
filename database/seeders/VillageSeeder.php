<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Village::create([
            'id' => 1,
            'Village' => 'Kelurahan Cempaka Putih Timur',
            'district_id'=> 1,
            'postal_code_id' => 1
        ]);
        Village::create([
            'id' => 2,
            'Village' => 'Kelurahan Cempaka Putih Barat',
            'district_id'=> 1,
            'postal_code_id' => 2
        ]);
        Village::create([
            'id' => 3,
            'Village' => 'Kelurahan Kebon Kelapa',
            'district_id'=> 2,
            'postal_code_id' => 3
        ]);
        Village::create([
            'id' => 4,
            'Village' => 'Kelurahan Petojo Utara',
            'district_id'=> 2,
            'postal_code_id' => 4
        ]);
        Village::create([
            'id' => 5,
            'Village' => 'Kelurahan Tanjung Barat',
            'district_id'=> 3,
            'postal_code_id' => 5
        ]);
        Village::create([
            'id' => 6,
            'Village' => 'Kelurahan Cipedak',
            'district_id'=> 3,
            'postal_code_id' => 6
        ]);
        Village::create([
            'id' => 7,
            'Village' => 'Kelurahan Selong',
            'district_id'=> 4,
            'postal_code_id' => 7
        ]);
        Village::create([
            'id' => 8,
            'Village' => 'Kelurahan Gunung',
            'district_id'=> 4,
            'postal_code_id' => 8
        ]);
        Village::create([
            'id' => 9,
            'Village' => 'Kelurahan Bandung',
            'district_id'=> 5,
            'postal_code_id' => 17
        ]);
        Village::create([
            'id' => 10,
            'Village' => 'Kelurahan Bantengan',
            'district_id'=> 5,
            'postal_code_id' => 17
        ]);
        Village::create([
            'id' => 11,
            'Village' => 'Kelurahan Besole',
            'district_id'=> 6,
            'postal_code_id' => 18
        ]);
        Village::create([
            'id' => 12,
            'village' => 'Kelurahan Besuki',
            'district_id'=> 6,
            'postal_code_id' => 18
        ]);
        Village::create([
            'id' => 13,
            'village' => 'Kelurahan Bendogerit',
            'district_id'=> 7,
            'postal_code_id' => 15
        ]);
        Village::create([
            'id' => 14,
            'village' => 'Kelurahan Gedog',
            'district_id'=> 7,
            'postal_code_id' => 16
        ]);
        Village::create([
            'id' => 15,
            'village' => 'Kelurahan Tanjungsari',
            'district_id'=> 8,
            'postal_code_id' => 14
        ]);
        Village::create([
            'id' => 16,
            'Village' => 'Kelurahan Tlumpu',
            'district_id'=> 8,
            'postal_code_id' => 13
        ]);
        Village::create([
            'id' => 17,
            'Village' => 'Kelurahan Bareng',
            'district_id'=> 9,
            'postal_code_id' => 10
        ]);
        Village::create([
            'id' => 18,
            'Village' => 'Kelurahan Gadingkasri',
            'district_id'=> 9,
            'postal_code_id' => 9
        ]);
        Village::create([
            'id' => 19,
            'Village' => 'Kelurahan Dinoyo',
            'district_id'=> 10,
            'postal_code_id' => 12
        ]);
        Village::create([
            'id' => 20,
            'Village' => 'Kelurahan Jatimulyo',
            'district_id'=> 10,
            'postal_code_id' => 11
        ]);
    }
}
