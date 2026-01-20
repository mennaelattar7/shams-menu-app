<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product__View extends Model
{
    protected $table = "product___views";
    protected $fillable = [
        'product_id',
        'user_id',
        'user_type',
        'ip_address',
        'viewed_at',
    ];
}
