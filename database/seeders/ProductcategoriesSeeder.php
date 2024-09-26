<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class ProductcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Moduler Switch Box',
            'description' => 'This is moduler switch box',
             'image' => 'images/category/moduler_switch_box.png',
            'status' => 'active',
        ]);
        Category::create([
            'name' => 'Double Wall Serface Box',
            'description' => 'This is double wall serface box',
             'image' => 'images/category/dauble_wall_serface_box.png',
            'status' => 'active',
        ]);
        Category::create([
            'name' => 'Horizental Switch Mate',
            'description' => 'This is horizental switch mate',
             'image' => 'images/category/horizontal_mate.png',
            'status' => 'active',
        ]);
        Category::create([
            'name' => 'Serface Box',
            'description' => 'This is serface box',
             'image' => 'images/category/surface_box.png',
            'status' => 'active',
        ]);
        Category::create([
            'name' => 'Complete Board',
            'description' => 'This is complete board',
             'image' => 'images/category/completeboard.png',
            'status' => 'active',
        ]);
        Category::create([
            'name' => 'PVC MCB',
            'description' => 'This is PVC MCB',
             'image' => 'images/category/pvc_mcb.png',
            'status' => 'active',
        ]);
        Category::create([
            'name' => 'Conduit Fitings',
            'description' => 'This is conduit fitings',
             'image' => 'images/category/conduit.png',
            'status' => 'active',
        ]);
        Category::create([
            'name' => 'Black Beauty Moduler Switch Plate',
            'description' => 'This is black beauty moduler switch plate',
             'image' => 'images/category/black_beauty.png',
            'status' => 'active',
        ]);

    }
}
