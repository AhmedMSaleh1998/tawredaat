<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public function cart()
    {
        return $this->belongsTo('App\Models\Cart','cart_id');
    }

    public function shopProduct()
    {
        return $this->belongsTo('App\Models\ShopProduct','shop_product_id');
    }

    public function offerPackage()
    {
        return $this->belongsTo('App\Models\OfferPackage','offer_package_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }
    
     public function bundel()
    {
        return $this->belongsTo(Bundel::class, 'bundel_id');
    }
}