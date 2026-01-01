<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product__ProductVariant extends Model
{
    protected $table = "product___product_variants";
    protected $casts = [
        'name' => 'array',
    ];
    public function getNameAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['name'],true);
        return $array_values[$locale];
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function created_by()
    {
        return $this->belongsTo(User::class,'created_by_id','id');
    }
    public function updated_by()
    {
        return $this->belongsTo(User::class,'updated_by_id','id');
    }
    public function deleted_by()
    {
        return $this->belongsTo(User::class,'deleted_by_id','id');
    }
}
