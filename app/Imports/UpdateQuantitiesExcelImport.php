<?php

namespace App\Imports;

use App\Models\QuantityType;
use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;

class UpdateQuantitiesExcelImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        $name = $row[0];
        $brand = $row[3];
       
        $product = ShopProduct::when($name, function ($query) use ($name) {
            return $query->whereHas('translations', function ($query) use ($name) {
                $query->where('name', $name);
            });
        })->when($brand, function ($query) use ($brand) {
            return $query->whereHas('brand', function ($query) use ($brand) {
                return $query->whereHas('translations', function ($query) use ($brand) {
                    $query->where('name', $brand);
                });
            });
        })->first();
        if (!$product) {
            return null;
        }

        $qty_type_name = $row[2];
        $qty_type = QuantityType::when( $qty_type_name, function ($query) use ($qty_type_name) {
            return $query->whereHas('translations', function ($query) use ($qty_type_name) {
                $query->where('name', $qty_type_name);
            });
        })->first();
        
        $product->qty = $row[1] ?? null;
        $product->quantity_type_id =  $qty_type->id;
        $product->save();
        return $product;
    }
}
