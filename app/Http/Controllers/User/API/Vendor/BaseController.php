<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected $vendor;

    public function __construct()
    {
        $this->vendor = Auth::user()
            ->vendor_representative
            ->vendor;
    }
}
