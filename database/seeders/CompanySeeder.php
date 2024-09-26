<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = [
            [
                'company_name' => 'Ilite',
                'brand_title' => 'Ilite',
                'company_address' => 'chingrighata',
                'bank_name' => 'hdfc',
                'bank_acc_number' => '4226511',
                'bank_ifsc' => '635656565',
                'gstin' => 'fdgd6557',
                'logo' => 'images/company/logo1.png',
                'status' => 'active',
            ],
            [
                'company_name' => 'Raju Bhai Group',
                'brand_title' => 'Raju Bhai Group',
                'company_address' => 'chinarpark',
                'bank_name' => 'icici',
                'bank_acc_number' => '422655551',
                'bank_ifsc' => '6356565',
                'gstin' => 'fdgd6666',
                'logo' => 'images/company/logo2.png',
                'status' => 'active',
            ],
            [
                'company_name' => 'Complete Board',
                'brand_title' => 'Complete Board',
                'company_address' => 'chinarpark',
                'bank_name' => 'icici',
                'bank_acc_number' => '422655552',
                'bank_ifsc' => '6356565',
                'gstin' => 'fdgd6449',
                'logo' => 'images/company/complete-board.png',
                'status' => 'active',
            ],
            [
                'company_name' => 'Conduit Fittings',
                'brand_title' => 'Conduit Fittings',
                'company_address' => 'chinarpark',
                'bank_name' => 'icici',
                'bank_acc_number' => '422655553',
                'bank_ifsc' => '6356564',
                'gstin' => 'fdgd6443',
                'logo' => 'images/company/conduit.png',
                'status' => 'active',
            ],
            [
                'company_name' => 'Polo Double Wall Surface Box',
                'brand_title' => 'Polo Double Wall Surface Box',
                'company_address' => 'chinarpark',
                'bank_name' => 'icici',
                'bank_acc_number' => '422655554',
                'bank_ifsc' => '6356565',
                'gstin' => 'fdgd6444',
                'logo' => 'images/company/polar.png',
                'status' => 'active',
            ],
            [
                'company_name' => 'Buddy Horizontal Switch Mate',
                'brand_title' => 'Buddy Horizontal Switch Mate',
                'company_address' => 'chinarpark',
                'bank_name' => 'icici',
                'bank_acc_number' => '422651111',
                'bank_ifsc' => '6356567',
                'gstin' => 'fdgd6445',
                'logo' => 'images/company/buddy.png',
                'status' => 'active',
            ],
            [
                'company_name' => 'Galaxy Silverline Modular Switch Box',
                'brand_title' => 'Galaxy Silverline Modular Switch Box',
                'company_address' => 'chinarpark',
                'bank_name' => 'icici',
                'bank_acc_number' => '422655559',
                'bank_ifsc' => '6356565',
                'gstin' => 'fdgd6446',
                'logo' => 'images/company/galaxy-silverline.png',
                'status' => 'active',
            ],
            [
                'company_name' => 'Euro Modular Switch Plate',
                'brand_title' => 'Euro Modular Switch Plate',
                'company_address' => 'chinarpark',
                'bank_name' => 'icici',
                'bank_acc_number' => '422655511',
                'bank_ifsc' => '6356565',
                'gstin' => 'fdgd6447',
                'logo' => 'images/company/euro.png',
                'status' => 'active',
            ],
            [
                'company_name' => 'Push Fit Joints',
                'brand_title' => 'Push Fit Joints',
                'company_address' => 'chinarpark',
                'bank_name' => 'icici',
                'bank_acc_number' => '422655555',
                'bank_ifsc' => '6356565',
                'gstin' => 'fdgd6448',
                'logo' => 'images/company/pushfit-joints.png',
                'status' => 'active',
            ],
            [
                'company_name' => 'Tresa Surface Box',
                'brand_title' => 'Tresa Surface Box',
                'company_address' => 'chinarpark',
                'bank_name' => 'icici',
                'bank_acc_number' => '422655666',
                'bank_ifsc' => '6356565',
                'gstin' => 'fdgd64102',
                'logo' => 'images/company/tresa-surface-box.png',
                'status' => 'active',
            ],

        ];

        foreach ($company as $entity) {
            Company::create($entity);
        }
    }
}
