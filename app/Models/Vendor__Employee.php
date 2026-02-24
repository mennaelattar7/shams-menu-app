<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor__Employee extends Model
{

    protected $table = "vendor___employees";

    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function position()
    {
        return $this->belongsTo(Vendor__EmployeePosition::class,'position_id','id');
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
