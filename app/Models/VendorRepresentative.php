<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorRepresentative extends Model
{
    protected $table = "vendor___representatives";
    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
}
