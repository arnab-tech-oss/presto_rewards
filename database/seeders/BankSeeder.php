<?php

namespace Database\Seeders;

use App\Models\BankName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bank_name = [
            [
                'bank_name' => 'State Bank of India',
                'ifsc' => 'SBIN000XXX',
            ],
            [
                'bank_name' => 'Punjab National Bank',
                'ifsc' => 'PUNB000XXX',
            ],
            [
                'bank_name' => 'Bank of Baroda',
                'ifsc' => 'BARB0XXXXXX',
            ],
            [
                'bank_name' => 'Canara Bank',
                'ifsc' => 'CNRB0XXXXXX',
            ],
            [
                'bank_name' => 'Union Bank of India',
                'ifsc' => 'UBIN0XXXXXX',
            ],
            [
                'bank_name' => 'HDFC Bank',
                'ifsc' => 'HDFC0XXXXXX',
            ],
            [
                'bank_name' => 'ICICI Bank',
                'ifsc' => 'ICIC0XXXXXX',
            ],
            [
                'bank_name' => 'Axis Bank',
                'ifsc' => 'UTIB0XXXXXX',
            ],
            [
                'bank_name' => 'Kotak Mahindra Bank',
                'ifsc' => 'KKBK0XXXXXX',
            ],
            [
                'bank_name' => 'IndusInd Bank',
                'ifsc' => 'INDB0XXXXXX',
            ],
            [
                'bank_name' => 'IDBI Bank',
                'ifsc' => 'IBKL0XXXXXX',
            ],
            [
                'bank_name' => 'Bank of India',
                'ifsc' => 'BKID0XXXXXX',
            ],
            [
                'bank_name' => 'Central Bank of India',
                'ifsc' => 'CBIN0XXXXXX',
            ],
            [
                'bank_name' => 'Indian Bank',
                'ifsc' => 'IDIB0XXXXXX',
            ],
            [
                'bank_name' => 'Indian Overseas Bank',
                'ifsc' => 'IOBA0XXXXXX',
            ],
            [
                'bank_name' => 'UCO Bank',
                'ifsc' => 'UCBA0XXXXXX',
            ],
            [
                'bank_name' => 'Bank of Maharashtra',
                'ifsc' => 'MAHB0XXXXXX',
            ],
            [
                'bank_name' => 'Federal Bank',
                'ifsc' => 'FDRL0XXXXXX',
            ],
            [
                'bank_name' => 'Federal Bank',
                'ifsc' => 'FDRL0XXXXXX',
            ],
            [
                'bank_name' => 'Yes Bank',
                'ifsc' => 'YESB0XXXXXX',
            ],
            [
                'bank_name' => 'RBL Bank',
                'ifsc' => 'RATN0XXXXXX',
            ],
            [
                'bank_name' => 'Punjab & Sind Bank',
                'ifsc' => 'PSIB0XXXXXX',
            ],
            [
                'bank_name' => 'Karur Vysya Bank',
                'ifsc' => 'KVBL0XXXXXX',
            ],
            [
                'bank_name' => 'South Indian Bank',
                'ifsc' => 'SIBL0XXXXXX',
            ],
            [
                'bank_name' => 'Catholic Syrian Bank',
                'ifsc' => 'CSBK0XXXXXX',
            ],
        ];

        foreach($bank_name as $data)
        {
            BankName::create($data);
        }
    }
}
