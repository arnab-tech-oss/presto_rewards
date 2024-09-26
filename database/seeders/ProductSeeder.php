<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $product = [
            [
            'product_name' => 'tiago',
            'description' => 'cars',
            'brand_id' => '1',
            // 'mrp_price' => '26000.25',
            'price_range' =>'55555.00-58000.00',
            'categories_id' => '1',
            'status' => 'active',
            'image' => 'images/product/product1.png',
            ],
            [
            'product_name' => 'ninja',
            'description' => 'bike',
             'brand_id' => '2',
            // 'mrp_price' => '26000.25',
            'price_range' =>'55555.00-58000.00',
            'categories_id' => '2',
            'status' => 'active',
            'image' => 'images/product/product2.png',
            ],
            
    ];
    
    foreach ($product as $entity)
    {
        Product::create($entity);
    }
    }
}
