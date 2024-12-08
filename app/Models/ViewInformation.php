<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewInformation extends Model
{
    protected $fillable = ['user_id', 'company_id'];

    public function user()
    {
       return $this->belongsTo('App\User', 'user_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}