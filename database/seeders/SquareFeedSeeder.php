<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\SquareFeed;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SquareFeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            SquareFeed::create([
                'img_path' => 'dummy.jpg',
                'admin_id' => Admin::inRandomOrder()->first()->id,
            ]);
        }
    }
}
