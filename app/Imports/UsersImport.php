<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   

        return new Product([
            // because we would have 'Name', 'Email', and 'Password' heading in our excel
            'name'     => $row['name'], 
            'detail'   => $row['detail'],
            'price'    => $row['price'], 
            'stock'    => $row['stock'], 
            'image'    => $row['image'],
        ]);
    
    }
}
