<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsertProducts extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Centella',
                'price' => '180000',
                'stock' => '10',
                'description' => '',
                'image' => '',
                'category_id' => '1'
            ]
        ]);
    }
}

//bisa juga dgn cara ini
// public function run(): void
//     {
//         Products::create([
//             'name' => 'Nasi',
//             'price' => '4000',
//             'stock' => '2',
//             'description' => 'Nasi itu sehat',
//             'image' => 'N',
//             'category_id' => '1',
//         ]);
//         Products::create([
//             'name' => 'Nasi goreng',
//             'price' => '5000',
//             'stock' => '2',
//             'description' => 'Nasi itu sehat',
//             'image' => 'U',
//             'category_id' => '2',
//         ]);
//     }
// }
