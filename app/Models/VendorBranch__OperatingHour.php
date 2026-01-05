<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorBranch__OperatingHour extends Model
{
    protected $table = "vendor_branch___operating_hours";

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
