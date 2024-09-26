<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SettingApp;

class SettingAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingApp::create([
            'title' => 'PrestoRewards - By PRESTO PLAST INDIA',
            'description' => 'Presto Plast India.The leading name in Domestic Electrical Wiring Accessories for surface and concealed wiring systems.',
            'version' => '1.0',
            'applogo' => 'images/company/logo-lg.jpg',
            'favicon_logo' => 'images/company/kjjjjrhquyqq4r34r.jpg',
            'footer_right' => 'Disclaimer | Payment Policy | Terms & Condition',
            'footer_left' =>  '© 2024 All Rights Reserved by PRESTO PLAST INDIA',
            'beta_url' => 'https://www.prestorewardsapp.com/',
            'playstore_url' => 'https://play.google.com/store/apps/details?id=com.prestoplast.prestorewards',
            'appstore_url' => 'https://apps.apple.com/in/app/presto-plast-rewards/id6502875320',
        ]);
    }
}
