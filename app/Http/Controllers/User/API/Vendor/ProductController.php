<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Requests\User\API\Vendor\Product\CreateRequest;
use App\Http\Requests\User\API\Vendor\Product\UpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Product__ProductBranch;
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
        $vendor = $this->vendor;
        $menu_categories_ids = $vendor->menu_categories->pluck('id')->toArray();

        $all_products = Product::whereIn('category_id',$menu_categories_ids);
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
        if($request->activation_status)
        {
            $all_products = $all_products->where('activation_status',$request->activation_status);
        }
        if ($request->product_name) {
            $all_products = $all_products->where(function ($q) use ($request) {
                $q->where('name->en', 'like', '%' . $request->product_name . '%')
                ->orWhere('name->ar', 'like', '%' . $request->product_name . '%');
            });
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
        $all_products = $all_products->get();
        if($all_products->isEmpty())
        {
            return response()->json([
                'success' => false,
                'message' => 'There Are No Products',
            ], 404);
        }
        else
        {
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
            'message' => 'Get Product Data Succefully',
            'data' => new ProductResource($product)
        ], 200);
    }

    public function update($locale,$product_slug,UpdateRequest $request)
    {
        $product = Product::where('slug',$product_slug)->first();
        if($product == null)
        {
            return response()->json([
                'success' => true,
                'message' => 'This Product Not exist',
            ], 404);
        }

        //update in product tabel
        $product->updated_by_id = $this->user->id;
        $product->category_id = $request->category_id;
        $product->product_type_id = $request->product_type_id;
        $product->name = $request->name;
        $product->description = $request->description;
        if(request()->hasFile('image'))
        {
            $file=$request->image;
            $name = $file->getClientOriginalName();
            $extension = pathinfo($name)['extension'];
            $fileName = 'Product_' . Str::random(5) . '.' . $extension;

            $file->storeAs('Vendor/Product/Images',$fileName,'public');
            $product->image = 'Vendor/Product/Images/' . $fileName;
        }
        $product->calories = $request->calories;
        $product->save();

        //Update in product___product_variants table
        $product_variant = $product->variants->first();
        $product_variant->updated_by_id = $this->user->id;
        if($request->product_variant_name != null)
        {
            $product_variant->name = $request->product_variant_name;
        }
        $product_variant->price = $request->price;
        $product_variant->activation_status =  "active";
        $product_variant->save();

        //add in product___product_branches table
        $product->branches()->sync($request->branches_ids);
        //add in product___product_badges table
        if($request->badges_ids)
        {
            $product->badges()->sync($request->badges_ids);
        }
        //add in product___product_badges table
        if($request->cooking_level_ids)
        {
            $product->cooking_levels()->sync($request->cooking_level_ids);
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

            $product->allergens()->sync($data);
        }
        return response()->json([
            'success' => true,
            'message' => 'Product Updated successfuly'
        ]);
    }

    public function toggleAvailability($locale,$product_slug,$branch_slug)
    {
        $product = Product::where('slug',$product_slug)->first();
        $branch = VendorBranche::where('slug',$branch_slug)->first();
        if($product == null || $branch == null)
        {
            return response()->json([
                'status' =>false,
                'message' => 'product or branch not exist'
            ]);
        }
        $avilabilty = Product__ProductBranch::where('branch_id',$branch->id)->where('product_id',$product->id)->first();
        if($avilabilty->availability_status == "available")
        {
            $avilabilty->availability_status = "not_available";
        }
        else
        {
            $avilabilty->availability_status = "available";
        }
        $avilabilty->save();
        return response()->json([
            'success' => true,
            'message' => 'Change Product Avilabilty Succefully',
        ], 200);
    }
    public function toggleActivation($locale,$product_slug)
    {
        $product = Product::where('slug',$product_slug)->first();
        if($product == null)
        {
            return response()->json([
                'status' =>false,
                'message' => 'this product not exist'
            ]);
        }
        if($product->activation_status == "active")
        {
            $product->activation_status = "inactive";
        }
        else
        {
            $product->activation_status = "active";
        }
        $product->save();
        return response()->json([
            'success' => true,
            'message' => 'Change Product Activation Succefully',
        ], 200);
    }

}
