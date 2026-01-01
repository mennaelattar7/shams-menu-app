<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product__Type extends Model
{
    protected $table = "product___types";
    protected $casts = [
        'name' => 'array',
    ];

    public function getNameAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['name'],true);
        return $array_values[$locale];
    }
}
