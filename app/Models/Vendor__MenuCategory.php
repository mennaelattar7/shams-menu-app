<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor__MenuCategory extends Model
{
    protected $table = "vendor___menu_categories";
    protected $casts = [
        'name' => 'array',
    ];
    public function getNameAttribute()
    {
        $locale =  app()->getLocale();
        $array_values = json_decode($this->attributes['name'],true);
        return $array_values[$locale];
    }
    public function children_categories()
    {
        return $this->hasMany(Vendor__MenuCategory::class,'parent_category_id','id')->orderBy('sort');
    }
    public function parent_category()
    {
        return $this->belongsto(Vendor__MenuCategory::class,'parent_category_id','id');
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
