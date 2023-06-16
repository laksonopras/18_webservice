<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create([
            'id' => 1,
            'package_name' => 'Paket 1 Bulan',
            'count_month'=> 1,
            'price' => 500000
        ]);
        Package::create([
            'id' => 2,
            'package_name' => 'Paket 3 Bulan',
            'count_month'=> 3,
            'price'=> 1250000
        ]);
        Package::create([
            'id' => 3,
            'package_name' => 'Paket 6 Bulan',
            'count_month'=> 6,
            'price' => 2750000
        ]);
        Package::create([
            'id' => 4,
            'package_name' => 'Paket 1 Tahun',
            'count_month'=> 12,
            'price' => 5500000
        ]);
    }
}
