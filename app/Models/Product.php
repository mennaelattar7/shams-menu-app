<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasSlug;
    use SoftDeletes;
    protected $table = "products";
    protected $casts = [
        'name' => 'array',
        'description'=>'array'
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
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name'])
            ->saveSlugsTo('slug');
    }
    public function offers()
    {
        return $this->belongsToMany(VendorBranch__Offer::class,'vendor_branch___offer_products','product_id','offer_id');
    }
    public function branches()
    {
        return $this->belongsToMany(VendorBranche::class,'product___product_branches','product_id','branch_id')->withPivot('activation_status','availability_status');
    }
    public function badges()
    {
        return $this->belongsToMany(Shams__ProductBadge::class,'product___product_badges','product_id','badge_id');
    }
    public function cooking_levels()
    {
        return $this->belongsToMany(Shams__ProductCookingLevel::class,'product___product_cooking_levels','product_id','cooking_level_id');
    }

    public function variants()
    {
        return $this->hasMany(Product__ProductVariant::class,'product_id','id');
    }
    public function allergens()
    {
        return $this->belongsToMany(Shams__ProductAllergen::class,'product___product_allergens','product_id','allergen_id')->withPivot('created_by_id');
    }
    public function category()
    {
        return $this->belongsTo(Vendor__MenuCategory::class,'category_id','id');
    }
    public function product_type()
    {
        return $this->belongsTo(Shams__ProductType::class,'product_type_id','id');
    }
    public function views()
    {
        return $this->hasMany(Product__Tracking::class,'product_id','id');
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
