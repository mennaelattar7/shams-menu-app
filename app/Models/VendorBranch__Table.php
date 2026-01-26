<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorBranch__Table extends Model
{
    protected $table ="vendor_branch___tables";

    public function branch()
    {
        return $this->belongsTo(VendorBranche::class,'branch_id','id');
    }
}
