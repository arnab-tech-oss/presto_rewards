<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $usertypes = ['2','3','4','5','6'];

        foreach ($usertypes as $usertype)
        {
            UserType::create([
                'roll_id' => $usertype,
            ]);
        }
    }
}
