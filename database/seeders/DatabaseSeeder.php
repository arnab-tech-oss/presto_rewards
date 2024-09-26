<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Catalog;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            StateSeeder::class,
            BankSeeder::class,
            SettingAppSeeder::class,
            SettingpageSeeder::class,
            QuestionSeeder::class,
            SettingAppSeeder::class,
            CompanySeeder::class,
            // ProductCatalogSeeder::class,
            ProductcategoriesSeeder::class,
            ProductSeeder::class,
            OfferSeeder::class,
            CatelogSeeder::class,
            UsertypeSeeder::class,
            EnquerySeeder::class,
            Company_infoSeeder::class,
            UserSeeder::class,
            UseraddressSeeder::class,

        ]);
    }
}
