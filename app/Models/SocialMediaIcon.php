<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMediaIcon extends Model
{
    protected $table = "social_media_icons";
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
