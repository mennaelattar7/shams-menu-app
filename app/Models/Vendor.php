<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Vendor extends Model
{
    use HasSlug;

    protected $table = "vendors";
    public $fillable =[
        "brand_name"
    ];
    protected $casts = [
        'brand_name' => 'array',
    ];
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['company_name'])
            ->saveSlugsTo('slug');
    }
    public function getBrandNameAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['brand_name'],true);
        if (!is_array($array_values)) {
            return null; // أو '' لو تحبي سترينج فاضي بدل null
        }
        return $array_values[$locale] ?? null; // fallback لو اللغة مش موجودة
    }
    public function getSloganAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['slogan'],true);
        if (!is_array($array_values)) {
            return null; // أو '' لو تحبي سترينج فاضي بدل null
        }
        return $array_values[$locale] ?? null; // fallback لو اللغة مش موجودة
    }

    public function social_media()
    {
        return $this->belongsToMany(SocialMediaIcon::class,'vendor___social_media','vendor_id','social_media_id')->withPivot('created_by_id','link');
    }
    public function menu_categories()
    {
        return $this->hasMany(Vendor__MenuCategory::class,'vendor_id','id');
    }
    public function branches()
    {
        return $this->hasMany(VendorBranche::class,'vendor_id','id');
    }
    public function langs()
    {
        return $this->belongsToMany(Lang::class,'vendor___langs','vendor_id','lang_id');
    }

    public function currencies()
    {
        return $this->belongsToMany(Shams__Currency::class,'vendor___currencies','vendor_id','currency_id');
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
