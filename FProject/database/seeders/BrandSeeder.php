<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand; // Make sure to import your Brand model

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Toyota'],
            ['name' => 'Honda'],
            ['name' => 'Maruti'],
            ['name' => 'BMW'],
            ['name' => 'Audi'],
        ];

        foreach ($brands as $brandData) {
            Brand::create($brandData);
        }
    }
}