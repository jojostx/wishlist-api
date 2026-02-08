<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Laptop Pro 15',
                'description' => 'High-performance laptop with 16GB RAM and 512GB SSD',
                'price' => 1299.99,
                'stock' => 25,
            ],
            [
                'name' => 'Wireless Keyboard',
                'description' => 'Bluetooth mechanical keyboard with RGB backlighting',
                'price' => 89.99,
                'stock' => 50,
            ],
            [
                'name' => 'Wireless Mouse',
                'description' => 'Ergonomic wireless mouse with 6 programmable buttons',
                'price' => 29.99,
                'stock' => 150,
            ],
            [
                'name' => '4K Monitor 27"',
                'description' => 'Ultra HD 4K monitor with HDR support',
                'price' => 399.99,
                'stock' => 30,
            ],
            [
                'name' => 'USB-C Hub',
                'description' => '7-in-1 USB-C hub with HDMI, USB 3.0, and SD card reader',
                'price' => 49.99,
                'stock' => 75,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Create additional random products
        Product::factory()->count(35)->create();
    }
}
