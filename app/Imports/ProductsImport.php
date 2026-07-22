<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ProductsImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

     
    public function model(array $row)
    {
        return new Product([
            //

            'name'=> $row['product_name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'status' => $row['status'],
        ]);
    }
     public function headingRow(): int
    {
        return 1;
    }
}
