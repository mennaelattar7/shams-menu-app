<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shams__ProductCookingLevel extends Model
{
    protected $table = "shams___product_cooking_levels";
    protected $casts = [
        'display_name' => 'array',
    ];

    public function getDisplayNameAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['display_name'],true);
        return $array_values[$locale];
    }
    public function getDescriptionAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['description'],true);
        return $array_values[$locale];
    }
}
