<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorBranch__TableRequest extends Model
{
    protected $table ="vendor_branch___table_requests";

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function table()
    {
        return $this->belongsTo(VendorBranch__Table::class,'branch_table_id','id');
    }
    public function status_history()
    {
        return $this->hasMany(VendorBranch__TableRequest_StatusHistory::class,'table_request_id','id');
    }
}
