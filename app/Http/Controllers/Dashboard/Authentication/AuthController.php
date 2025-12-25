<?php

namespace App\Http\Controllers\Dashboard\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dahboard\Auth\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view ('Dashboard.Auth.Login.index');
    }
    public function postLogin($locale,LoginRequest $request)
    {
        if($request->req_method())
        {
            return redirect()->route('dashboard.home.index',['locale'=>$locale]);
        }
        else
        {
            dd('no');
        }
    }
}
