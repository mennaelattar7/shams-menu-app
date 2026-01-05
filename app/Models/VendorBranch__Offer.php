<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorBranch__Offer extends Model
{
    protected $table = "vendor_branch___offers";
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
    public function is_active()
    {
        return $this->status == "active" &&
               $this->start_date <= now() &&
               $this->end_date > now();
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
