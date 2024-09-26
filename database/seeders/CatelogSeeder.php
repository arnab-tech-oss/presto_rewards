<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Catalog;
class CatelogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Catalog::create([
            'name' => 'Catelog 1',
            'description' => 'This is for Test',
            'image' => 'images/catalog/cat1.png',
            'status' => 'active',
        ]);
        Catalog::create([
            'name' => 'Catelog 2',
            'description' => 'This is for Test 2 ',
            'image' => 'images/catalog/cat2.png',
            'status' => 'active',
        ]);
    }
}
