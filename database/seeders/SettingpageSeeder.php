<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SettingsPages;

class SettingpageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingsPages::create([
            'tittle' => 'Privacy Policy',
            'description' => '<p>https://www.prestorewardsapp.com/privacy-policy/<p>',
        ]);
        SettingsPages::create([
            'tittle' => ' Disclaimer ',
            'description' => '<p>https://www.prestorewardsapp.com/disclaimer/<p>',
        ]);
        SettingsPages::create([
            'tittle' => 'Terms & Condition',
            'description' => '<p>https://www.prestorewardsapp.com/terms-and-conditions/<p>',
        ]);
        SettingsPages::create([
            'tittle' => 'Support',
            'description' => '<p>https://www.prestorewardsapp.com/support-and-help-center/<p>',
        ]);
    }
}
