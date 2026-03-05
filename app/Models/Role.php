<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;


class Role extends SpatieRole
{
    use HasFactory;
    protected $table = "roles";
    // protected $fillable = [
    //     'display_name',
    //     'guard_name',
    // ];

    protected $casts = [
        'name' => 'array',
    ];
    public $guarded = [];

    public function position()
    {
        return $this->belongsTo(Vendor__EmployeePosition::class,'position_id','id');
    }

    // public function created_by()
    // {
    //     return $this->belongsTo(User::class,'created_by_id','id');
    // }
    // public function updated_by()
    // {
    //     return $this->belongsTo(User::class,'updated_by_id','id');
    // }
    // public function deleted_by()
    // {
    //     return $this->belongsTo(User::class,'deleted_by_id','id');
    // }

}
