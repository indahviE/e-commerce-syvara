<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsertCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'category_name' => 'Hydration'
        ]);
        Category::create([
            'category_name' => 'Brightening'
        ]);
        Category::create([
            'category_name' => 'Acne Care'
        ]);
    }
}
