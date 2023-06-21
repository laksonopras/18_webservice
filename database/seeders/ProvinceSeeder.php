<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::create([
            'id' => 1,
            'province' => 'DKI Jakarta'
        ]);
        Province::create([
            'id' => 2,
            'province' => 'Jawa Timur'
        ]);
    }
}
