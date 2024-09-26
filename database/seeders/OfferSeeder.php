<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Offer;
use Carbon\Carbon;
class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Offer::create([
            'title' => 'Test 1',
            'description' => 'This is for Testing Purpose',
            'start_date' => Carbon::now(),
            'cta_type' => 'wa',
            'action_link' => '+919920292422',
            'baner' =>'images/banner/offer1.jpeg',
            'status'=> 'active'
        ]);
        Offer::create([
            'title' => 'Test 2',
            'description' => 'This is for Testing Purpose',
            'start_date' => Carbon::now(),
            'cta_type' => 'wa',
            'action_link' => '+919920292422',
            'baner' =>'images/banner/offer2.jpeg',
            'status'=> 'active'
        ]);
    }
}
