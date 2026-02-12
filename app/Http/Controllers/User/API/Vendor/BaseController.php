<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected $user;
    protected $vendor;

    public function __construct()
    {
        if(Auth::user()->vendor_representative)
        {
            $this->vendor = Auth::user()->vendor_representative->vendor;
        }
        else
        {
            $this->vendor = Auth::user()->employee->vendor;
        }
        $this->user = Auth::user();
    }
}
