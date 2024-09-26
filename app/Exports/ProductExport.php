<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Product::all();
    // }

    public function headings(): array{
        return[
            'product_name',
            'description',
            'brand_id ',
            'categories_id',
            'product_code'
        ];
    }
}
