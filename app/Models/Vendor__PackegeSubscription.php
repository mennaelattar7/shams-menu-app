<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor__PackegeSubscription extends Model
{
    protected $table = "vendor___package_subscriptions";
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id','id');
    }

    public function package()
    {
        return $this->belongsTo(Shams__VendorPackage::class, 'package_id','id');
    }
}
