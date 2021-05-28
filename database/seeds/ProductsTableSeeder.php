<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id' => '1',
            'name' => 'Nasi Goreng',
            'slug' => 'nasi-goreng',
            'price' => '15000'
        ]);

        Product::create([
            'category_id' => '1',
            'name' => 'Nasi Uduk',
            'slug' => 'nasi-uduk',
            'price' => '10000'
        ]);

        Product::create([
            'category_id' => '2',
            'name' => 'Jus Alpukat',
            'slug' => 'jus-alpukat',
            'price' => '8000'
        ]);

        Product::create([
            'category_id' => '2',
            'name' => 'Jus Jeruk',
            'slug' => 'jus-jeruk',
            'price' => '8000'
        ]);
    }
}
