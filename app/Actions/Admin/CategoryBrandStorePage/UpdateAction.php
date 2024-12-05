<?php

namespace App\Actions\Admin\CategoryBrandStorePage;

use App\Models\CategoryBrandStorePage;
use Illuminate\Http\Request;

class UpdateAction
{
    public function execute(Request $request)
    {
        CategoryBrandStorePage::where('category_id', $request->category_id)->delete();

        foreach ($request->brands as $brand_id) {
            CategoryBrandStorePage::create(['category_id' => $request->category_id,
                'brand_id' => $brand_id]);
        }

    }
}