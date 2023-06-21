<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Banner::create([
                'img_path' => 'dummy.jpg',
                'admin_id' => Admin::inRandomOrder()->first()->id,
            ]);
        }
    }
}
