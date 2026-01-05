<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorBranche extends Model
{
    protected $table = "vendor___branches";

    protected $casts = [
        'name' => 'array',
    ];

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

    public function operating_hours()
    {
        return $this->hasMany(VendorBranch__OperatingHour::class,'branch_id','id');
    }
    public function social_media()
    {
        return $this->belongsToMany(SocialMediaIcon::class,'vendor_branch___social_media','branch_id','social_media_id')->withPivot('link');
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
