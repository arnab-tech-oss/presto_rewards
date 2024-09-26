<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserAddress;

class UseraddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserAddress::create([
            'user_id' => 1,
            'address_1' =>  'Address',
            'address_2' =>  'Address 2',
            'state' =>  'West Bengal',
            'district' => 'Kolkata',
            'postal_code' => '700105',
        ]);
    }
}
