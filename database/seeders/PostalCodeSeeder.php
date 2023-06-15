<?php

namespace Database\Seeders;

use App\Models\PostalCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostalCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostalCode::create([
            'id' => 1,
            'postal_code' => 10510
        ]);
        PostalCode::create([
            'id' => 2,
            'postal_code' => 10520
        ]);
        PostalCode::create([
            'id' => 3,
            'postal_code' => 10120
        ]);
        PostalCode::create([
            'id' => 4,
            'postal_code' => 10130
        ]);
        PostalCode::create([
            'id' => 5,
            'postal_code' => 12530
        ]);
        PostalCode::create([
            'id' => 6,
            'postal_code' => 12630
        ]);
        PostalCode::create([
            'id' => 7,
            'postal_code' => 12110
        ]);
        PostalCode::create([
            'id' => 8,
            'postal_code' => 12120
        ]);
        PostalCode::create([
            'id' => 9,
            'postal_code' => 65115
        ]);
        PostalCode::create([
            'id' => 10,
            'postal_code' => 65116
        ]);
        PostalCode::create([
            'id' => 11,
            'postal_code' => 65141
        ]);
        PostalCode::create([
            'id' => 12,
            'postal_code' => 65144
        ]);
        PostalCode::create([
            'id' => 13,
            'postal_code' => 66124
        ]);
        PostalCode::create([
            'id' => 14,
            'postal_code' => 66126
        ]);
        PostalCode::create([
            'id' => 15,
            'postal_code' => 66133
        ]);
        PostalCode::create([
            'id' => 16,
            'postal_code' => 66137
        ]);
        PostalCode::create([
            'id' => 17,
            'postal_code' => 66274
        ]);
        PostalCode::create([
            'id' => 18,
            'postal_code' => 66275
        ]);
    }
}
