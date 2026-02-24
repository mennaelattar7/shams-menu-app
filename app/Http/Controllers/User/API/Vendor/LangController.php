<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\Lang\SelectLangRequest;
use App\Http\Resources\LangResource;
use App\Models\Lang;
use App\Models\VendorLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LangController extends Controller
{
    public function index()
    {
        $vendor = Auth::user()->vendor_representative->vendor;
        $langs = $vendor->langs;
        if($langs)
        {
            return response()->json([
                'success' => true,
                'message' => 'Get Langs Succefully',
                'data' => LangResource::collection($langs)
            ], 200);
        }
        else
        {
            return response()->json([
                'success' => true,
                'message' => 'No Langs',
                'data' => LangResource::collection($langs)
            ], 200);
        }
    }
    public function selectLangs(SelectLangRequest $request)
    {
        $lang = Lang::find($request->lang_id);
        $vendor = Auth::user()->vendor_representative->vendor;
        if(!$lang)
        {
            return response()->json([
                'success' => false,
                'message' => 'This Lang Not exist'
            ], 404);
        }
        //check if lang is selected before
        $check_langs = VendorLang::where('vendor_id',$vendor->id)->where('lang_id',$lang->id)->first();
        if($check_langs)
        {
            $check_langs->delete();
            return response()->json([
                'success' => true,
                'message' => 'Language Removed From Vendor',
                'action'  => 'removed'
            ], 200);
        }
        else
        {
            $new_vendor_lang = new VendorLang();
            $new_vendor_lang->vendor_id = $vendor->id;
            $new_vendor_lang->lang_id = $lang->id;
            $new_vendor_lang->save();
            return response()->json([
                'success' => true,
                'message' => 'Lang Add To vendor Successfully',
                'action'  => 'add'
            ], 200);
        }
    }
}
