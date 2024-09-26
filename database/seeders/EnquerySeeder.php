<?php

namespace Database\Seeders;

use App\Models\Enquiry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnquerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enquery =[
            'Products Related',
            'redemption Related',
            'Payment and Wallet',
            'General Support',
            'Technical and Bugs',
        ];

        foreach($enquery as $data)
        {
            Enquiry::create([
                'enquiry_type' => $data,
            ]);
        }
    }
}
