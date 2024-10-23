<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::create(['name' => 'Nature', 'slug' => 'nature']);
        \App\Models\Category::create(['name' => 'Architecture', 'slug' => 'architecture']);
        \App\Models\Category::create(['name' => 'People', 'slug' => 'people']);
        \App\Models\Category::create(['name' => 'Animals', 'slug' => 'animals']);
    }
}
