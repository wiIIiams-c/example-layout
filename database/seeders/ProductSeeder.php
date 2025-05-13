<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Laptop', 'category' => 'Electronics', 'price' => 999.99, 'stock' => 50],
            ['name' => 'Smartphone', 'category' => 'Electronics', 'price' => 699.99, 'stock' => 100],
            ['name' => 'Headphones', 'category' => 'Audio', 'price' => 199.99, 'stock' => 75],
            ['name' => 'Monitor', 'category' => 'Electronics', 'price' => 299.99, 'stock' => 30],
            ['name' => 'Keyboard', 'category' => 'Accessories', 'price' => 89.99, 'stock' => 120],
            ['name' => 'Mouse', 'category' => 'Accessories', 'price' => 49.99, 'stock' => 150],
            ['name' => 'Speaker', 'category' => 'Audio', 'price' => 149.99, 'stock' => 40],
            ['name' => 'Tablet', 'category' => 'Electronics', 'price' => 399.99, 'stock' => 65],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
