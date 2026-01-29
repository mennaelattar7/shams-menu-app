<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shams__VendorPackage extends Model
{
    protected $table = "shams___vendor_packages";

    public function features() 
    {
        return $this->belongsToMany(Shams__VendorFeature::class,'shams___vendor_package_features','package_id','feature_id')->withPivot('activation_status');
    } 

}
