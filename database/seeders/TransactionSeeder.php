<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Partner;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Ramsey\Uuid\Uuid;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {
            $quantity = rand(1, 10);
            $sub_price = 50000;
            $price = $quantity * $sub_price;

            Transaction::create([
                'id' => Uuid::uuid4(),
                'quantity' => rand(1, 10),
                'sub_price' => $sub_price,
                'price' => $price,
                'partner_id' => Partner::inRandomOrder()->first()->id,
                'admin_id' => Admin::inRandomOrder()->first()->id,
            ]);
        }
    }
}
