<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role_name' => 'admin',
            ],
            [
                'role_name' => 'customer',
            ],
            [
                'role_name' => 'technician',
            ],
            [
                'role_name' => 'distributors',
            ],
            [
                'role_name' => 'wholesaler',
            ],
            [
                'role_name' => 'retailer',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
