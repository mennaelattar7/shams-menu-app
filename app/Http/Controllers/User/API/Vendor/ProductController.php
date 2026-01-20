<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Requests\User\API\Vendor\Product\CreateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Product__ProductAllergen;
use App\Models\Product__ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;

class ProductController extends BaseController
{
    public function index(Request $request)
    {
        if($request->per_page != null)
        {
            $all_products= Product::whereHas('category',function($q){
                $q->where('vendor_id',$this->vendor->id);
            })->paginate($request->per_page);

            return ProductResource::collection($all_products)
            ->additional([
                'success' => true,
                'message' => 'Get Products Successfully'
            ])
            ->response()
            ->setStatusCode(200);
        }
        else
        {
            $all_products = Product::whereHas('category',function($q){
                $q->where('vendor_id',$this->vendor->id);
            })->get();
            return response()->json([
                'success' => true,
                'message' => 'Get Products Succefully',
                'data' => ProductResource::collection($all_products)
            ], 200);
        }
    }
    public function create(CreateRequest $request)
    {
        //add in product tabel
        $new_product = new Product();
        $new_product->created_by_id = $this->user->id;
        $new_product->category_id = $request->category_id;
        $new_product->product_type_id = $request->product_type_id;
        $new_product->name = $request->name;
        $new_product->description = $request->description;
        if(request()->hasFile('image'))
        {
            $file=$request->image;
            $name = $file->getClientOriginalName();
            $extension = pathinfo($name)['extension'];
            $fileName = 'vendor_menu_category_' . Str::random(5) . '.' . $extension;

            $file->storeAs('vendor/menu_category/images',$fileName,'public');
            $new_product->image = 'vendor/menu_category/images/' . $fileName;
        }
        $new_product->activation_status = $request->activation_status;
        $new_product->calories = $request->calories;
        $new_product->save();

        //add in product___product_variants table
        $new_variant = new Product__ProductVariant();
        $new_variant->created_by_id = $this->user->id;
        $new_variant->product_id = $new_product->id;
        if($request->product_variant_name != null)
        {
            $new_variant->name = $request->product_variant_name;
        }
        $new_variant->price = $request->price;
        $new_variant->activation_status =  "active";
        $new_variant->save();

        //add in product___product_branches table
        $new_product->branches()->sync($request->branches_ids);
        //add in product___product_badges table
        $new_product->badges()->sync($request->badges_ids);
        //add in product___product_badges table
        $new_product->cooking_levels()->sync($request->cooking_level_ids);

        //add in product___product_allergens table
        foreach($request->allergens as $one_allergen)
        {
            $new_product_allergen = new Product__ProductAllergen();
            $new_product_allergen->name = $one_allergen['name'];
            $new_product_allergen->display_name = $one_allergen['display_name'];
            $new_product_allergen->product_id = $new_product->id;
            $new_product_allergen->save();
        }
        return response()->json([
            'success' => true,
            'message' => 'Product Add successfuly'
        ]);
    }
}
