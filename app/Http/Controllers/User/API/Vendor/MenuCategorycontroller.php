<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\MenuCategory\CreateRequest;
use App\Models\Vendor__MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MenuCategorycontroller extends Controller
{
    public function create(CreateRequest $request)
    {
        $user = Auth::user();
        $new_vendor_menu_category = new Vendor__MenuCategory();
        $new_vendor_menu_category->created_by_id = $user->id;
        $new_vendor_menu_category->vendor_id = $user->vendor_representative->vendor->id;
        $new_vendor_menu_category->parent_category_id = $request->parent_category_id;
        $new_vendor_menu_category->name = $request->name;
        $new_vendor_menu_category->activation_status = $request->activation_status;
        $new_vendor_menu_category->sort = $request->sort;
        if(request()->hasFile('image'))
        {
            $file=$request->image;
            $name = $file->getClientOriginalName();
            $extension = pathinfo($name)['extension'];
            $fileName = 'vendor_menu_category_' . Str::random(5) . '.' . $extension;

            $file->storeAs('vendor/menu_category/images',$fileName,'public');
            $new_vendor_menu_category->image = 'vendor/menu_category/images/' . $fileName;
        }
        $new_vendor_menu_category->save();
        if ($new_vendor_menu_category->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Category added successfully'
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Something went wrong'
        ], 500);
    }
}
