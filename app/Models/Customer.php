<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    public function favourites()
    {
        return $this->belongsToMany(Product::class,'customer___favourites','customer_id','product_id')->withPivot('branch_id');
    }
}
