<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorBranch__TableRequest extends Model
{
    protected $table ="vendor_branch___table_requests";

    public function table()
    {
        return $this->belongsTo(VendorBranch__Table::class,'branch_table_id','id');
    }
}
