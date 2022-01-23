<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Watch',
            'price' => 250,
            'description' => 'Good watch',
             ]);
        Product::create([
            'name' => 'Bag',
            'price' => 350,
            'description' => 'Good Bag',
            ]);
        Product::create([
            'name' => 'perfume',
            'price' => 100,
            'description' => 'Good perfume',
             ]);
    }
}
