<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Brand::insert([
            [
                'name' => 'Brand one',
                'slug' => str('Brand one')->slug(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brand two',
                'slug' => str('Brand two')->slug(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
