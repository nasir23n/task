<?php

namespace Database\Seeders;

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
        \App\Models\Category::insert([
            [
                'name' => 'Category one',
                'slug' => str('Category one')->slug(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Category two',
                'slug' => str('Category two')->slug(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
