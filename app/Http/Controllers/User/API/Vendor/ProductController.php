<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Requests\User\API\Vendor\Product\CreateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Product__ProductVariant;
use App\Models\Vendor__MenuCategory;
use App\Models\VendorBranche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends BaseController
{
    public function index(Request $request)
    {
        $all_products = Product::query();
        if($request->branch_slug)
        {
            $branch = VendorBranche::where('slug',$request->branch_slug)->first();
            if($branch != null)
            {
                $all_products = $branch->products()->with('category');
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'This Branch Not Exist',
                ], 404);
            }
        }
        if($request->category_slug)
        {
            $category = Vendor__MenuCategory::where('slug',$request->category_slug)->first();
            if($category != null)
            {
                $all_products = $all_products->where('category_id',$category->id);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'This Category Not Exist',
                ], 404);
            }
        }
        if($request->per_page != null)
        {
            $all_products= $all_products->paginate($request->per_page);

            return ProductResource::collection($all_products)
            ->additional([
                'success' => true,
                'message' => 'Get Products Successfully'
            ])
            ->response()
            ->setStatusCode(200);
        }
        return response()->json([
            'success' => true,
            'message' => 'Get Products Succefully',
            'data' => ProductResource::collection($all_products->get())
        ], 200);
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
            $fileName = 'Product_' . Str::random(5) . '.' . $extension;

            $file->storeAs('Vendor/Product/Images',$fileName,'public');
            $new_product->image = 'Vendor/Product/Images/' . $fileName;
        }
        $new_product->calories = $request->calories;
        //get last product sort in same category
        $last_product = Product::where('category_id',$request->category_id)->latest()->first();
        if($last_product == null)
        {
            $new_product->sort = 1;
        }
        else
        {
            $new_product->sort = $last_product->sort + 1;
        }
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
        if($request->badges_ids)
        {
            $new_product->badges()->sync($request->badges_ids);
        }
        //add in product___product_badges table
        if($request->cooking_level_ids)
        {
            $new_product->cooking_levels()->sync($request->cooking_level_ids);
        }
        if($request->allergens_ids)
        {
            $data=[];
            foreach($request->allergens_ids as $key => $one_item)
            {
                $data[$one_item] = [
                    'created_by_id' => Auth::user()->id
                ];
            }

            $new_product->allergens()->sync($data);
        }
        return response()->json([
            'success' => true,
            'message' => 'Product Add successfuly'
        ]);
    }

    public function single($locale,$product_slug)
    {
        $product = Product::where('slug',$product_slug)->first();
        if($product == null)
        {
            return response()->json([
                'success' => true,
                'message' => 'This Product Not exist',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Get Branche Data Succefully',
            'data' => new ProductResource($product)
        ], 200);
    }
}
