<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function favourites()
    {
        return $this->belongsToMany(Product::class,'customer___favourites','customer_id','product_id')->withPivot('branch_id');
    }
}
