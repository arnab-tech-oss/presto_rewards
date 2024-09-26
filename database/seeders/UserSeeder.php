<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
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
                    'full_name' => "presto",
                    'email' => "sa@prestorewardsapp.com",
                    'password' => Hash::make("O)-s]{]j9EOti(e"),
                    'user_type' => "admin",
                    'phone' => "1234567284",
                    'role_id' => 1,
                ],
                [
                    // 'full_name' => "Admin",
                    // 'email' => "admin@gmail.com",
                    // 'phone' => "1234567891",
                    // 'password' => Hash::make("admin@123"),
                    // 'user_type' => "admin",
                ]
            ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
