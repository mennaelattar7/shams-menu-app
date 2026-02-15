<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shams__ProductAllergen extends Model
{
    protected $table = "shams___product_allergens";
    protected $casts = [
        'name' => 'array',
        'description' => 'array'
    ];
    public function getNameAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['name'],true);
        return $array_values[$locale];
    }
    public function getDescriptionAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['description'],true);
        return $array_values[$locale];
    }


}
