<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "cities";
    protected $casts = [
        'name' => 'array',
    ];

    public function getNameAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['name'],true);
        return $array_values[$locale];
    }

    public function districts()
    {
        return $this->hasMany(District::class,'city_id','id');
    }
}
