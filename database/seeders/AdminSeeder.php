<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'full_name' => "Admin",
            'email_id' => "admin@gmail.com",
            'phone_number' => "1234567890",
            'passcode' => Hash::make("admin@123"),
            'user_type' => "admin",
        ]);
    }
}
