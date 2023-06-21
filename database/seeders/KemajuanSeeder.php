<?php

namespace Database\Seeders;

use App\Models\Kemajuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KemajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Kemajuan::create([
            'progres' => 'Sedang menunggu persetujuan'
        ]);
        Kemajuan::create([
            'progres' => 'Panggilan diterima'
        ]);
        Kemajuan::create([
            'progres' => 'Mitra sedang menuju ke tempat Anda'
        ]);
        Kemajuan::create([
            'progres' => 'Orderan sedang di proses'
        ]);
        Kemajuan::create([
            'progres' => 'Orderan telah selesai dikerjakan'
        ]);
        Kemajuan::create([
            'progres' => 'Orderan sukses'
        ]);
        Kemajuan::create([
            'progres' => 'Orderan ditolak'
        ]);
        Kemajuan::create([
            'progres' => 'Orderan dibatalkan'
        ]);
        
    }
}
