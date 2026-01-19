<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product__ProductAllergen extends Model
{
    protected $table = "product___product_allergens";
    protected $casts = [
        'display_name' => 'array',
    ];
    public function getDisplayNameAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['display_name'],true);
        return $array_values[$locale];
    }

}
