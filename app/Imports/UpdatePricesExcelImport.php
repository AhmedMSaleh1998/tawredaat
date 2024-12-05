<?php

namespace App\Imports;

use App\Models\ShopProduct;
use App\Models\ShopProductTranslation;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;

class UpdatePricesExcelImport implements ToModel
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
  
        $product->old_price = $row[2] > $row[1] ? null : $row[1];
        $product->new_price = $row[2];
        $product->save();
        return $product;
    }
}
