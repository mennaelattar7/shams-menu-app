<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shams__ProductType extends Model
{
    protected $table = "shams___product_types";
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
