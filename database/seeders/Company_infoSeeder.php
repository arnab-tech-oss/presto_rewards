<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;
class Company_infoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyInfo::create([
            'company_name' => 'PRESTO PLAST INDIA',
            'address' => 'Newtown',
            'city' => 'Kolkata',
            'state' => 'West Bengal',
            'country_name' => 'India',
            'phone' => '+7595058736',
            'email' => 'support@prestorewardsapp.com',
            'whats_app_no' => "+7595058736"
        ]);
    }
}
