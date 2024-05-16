<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithHeadings
{
    

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Detail',
            'Image',
            'Price',
            'Stock',
            'Created At',
            'Updated At',
        ];
    }

    public function query()
    {
        return Product::query();   // class that we use for the query
    }
}
