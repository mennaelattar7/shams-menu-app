<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = "vendors";
    protected $casts = [
        'company_name' => 'array',
    ];
    public function getBrandNameAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['brand_name'],true);
        return $array_values[$locale];
    }
    public function getCompanyNameAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['company_name'],true);
        return $array_values[$locale];
    }
    public function getSloganAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['slogan'],true);
        return $array_values[$locale];
    }

    public function social_media()
    {
        return $this->belongsToMany(SocialMediaIcon::class,'vendor___social_media','vendor_id','social_media_id')->withPivot('link');
    }
    public function menu_categories()
    {
        return $this->hasMany(Vendor__MenuCategory::class,'vendor_id','id');
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
