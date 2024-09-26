<?php

namespace Database\Seeders;

use App\Models\UserAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =
            [
                [
                    'user_id' => "1",
                    'address_1' => "howrah",
                    'address_2' => "station",
                    'state' => "west bengal",
                    'district' => "kolkata",
                    'postal_code' => "700159"

                ],
                [
                    'user_id' => "2",
                    'address_1' => "bidhannager",
                    'address_2' => "road",
                    'state' => "west bengal",
                    'district' => "kolkata",
                    'postal_code' => "700158"
                ]

            ];

        foreach ($users as $user) {
            UserAddress::create($user);
        }
    }
}
