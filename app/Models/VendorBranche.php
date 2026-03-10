<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class VendorBranche extends Model
{
    use HasSlug;
    protected $table = "vendor___branches";

    protected $casts = [
        'name' => 'array',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name'])
            ->saveSlugsTo('slug');
    }

    public function getNameAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['name'],true);
        return $array_values[$locale];
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function district()
    {
        return $this->belongsTo(District::class,'district_id','id');
    }

    public function operating_hours()
    {
        return $this->hasMany(VendorBranch__OperatingHour::class,'branch_id','id');
    }

    public function tables()
    {
        return $this->hasMany(VendorBranch__Table::class,'branch_id','id');
    }
    public function social_media()
    {
        return $this->belongsToMany(SocialMediaIcon::class,'vendor_branch___social_media','branch_id','social_media_id')->withPivot('link');
    }
    public function categories()
    {
        return $this->belongsToMany(Vendor__MenuCategory::class,'vendor_branch___vendor_menu_categories','branch_id','vendor_menu_category_id')->withPivot('activation_status');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'product___product_branches','branch_id','product_id')->orderBy('products.sort')->withPivot('activation_status','availability_status');
    }
    public function features()
    {
        return $this->belongsToMany(Shams__VendorFeature::class,'vendor_branch___features','branch_id','feature_id')->withPivot('activation_status');
    }
    public function offers()
    {
        return $this->hasMany(VendorBranch__Offer::class,'branch_id','id');
    }
    public function visits()
    {
        return $this->hasMany(VendorBranch__Tracking::class,'branch_id','id');
    }
    public function reviews()
    {
        return $this->hasMany(Vendor__Review::class,'branch_id','id');
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
