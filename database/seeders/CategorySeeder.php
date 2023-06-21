<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            "category_name" => "Restorasi",
            "admin_id" => Admin::inRandomOrder()->first()->id,
        ]);
        Category::create([
            "category_name" => "Kebersihan",
            "admin_id" => Admin::inRandomOrder()->first()->id,
        ]);
        Category::create([
            "category_name" => "Bukan Kebersihan",
            "admin_id" => Admin::inRandomOrder()->first()->id,
        ]);
    }
}
