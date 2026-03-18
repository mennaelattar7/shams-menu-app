<?php

namespace App\Http\Resources;

use App\Models\VendorBranche;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class VendorMenuCategoryResource extends JsonResource
{
    private $depth;

    public function __construct($resource, $depth = 1)
    {
        parent::__construct($resource);

        $this->depth = $depth;
    }
    public function toArray(Request $request): array
    {
        //check if branch_slug in route
        if($request->route('branch_slug') != null)
        {
            $branch = VendorBranche::where('slug',$request->route('branch_slug'))->first();
            $features = $branch->features;
            $activation_features = collect();
            foreach($features as $one_feature)
            {
                if($one_feature->activation_status == "active")
                {
                    if($one_feature->pivot->activation_status == "active")
                    {
                        $activation_features->push($one_feature);
                    }
                }
            }
            $items = $activation_features->whereIn('code', ['main_category', 'subcategory']);

            if($items->count() == 2)
            {
                $products = $this->products;
            }
            elseif($items->count() == 1)
            {
                if($items->first()->code == "main_category")
                {
                    $products = collect();
                    if ($branch) {
                        if ($this->sub_categories && $this->sub_categories->isNotEmpty()) {

                            // 👇 هات كل IDs بتاعة sub categories
                            $subIds = $this->sub_categories->pluck('id');

                            // 👇 هات المنتجات بتاعتهم
                            $products = $branch->products()
                                ->wherePivot('activation_status', 'active')
                                ->whereIn('category_id', $subIds)
                                ->get();

                        } else {
                            // 👇 لو مفيش sub categories
                            $products = $branch->products()
                                ->wherePivot('activation_status', 'active')
                                ->where('category_id', $this->id)
                                ->get();
                        }
                    }
                }
                else
                {
                    $products = $this->products;
                }
            }
        }
        else
        {
            $branch = null;
            $products = $this->products;
        }


        return [
            'id'=>$this->id,
            'parent_category' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.sub_categories',
                'user.api.public.branch.getMenuCategories',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.product.single',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.offer.single',
            ]) ,new VendorMenuCategoryResource(
                                $this->parent_category,
                                $this->depth - 1   // ↓ نقص العمق
                            )
                        ),

            'name' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.sub_categories',
                'user.api.public.branch.getMenuCategories',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.product.single',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.offer.single',
            ]),$this->name),

            'name_object' => $this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.sub_categories',
                'user.api.public.branch.getMenuCategories',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.product.single',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.offer.single',
            ]),json_decode($this->getRawOriginal('name'), true)),

            'slug' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.sub_categories',
                'user.api.public.branch.getMenuCategories',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.product.single',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.offer.single',
            ]),$this->slug) ,

            'image' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.menu_category.sub_categories',
                'user.api.public.branch.getMenuCategories',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.product.single',
                'user.api.vendor.menu_category.single',
            ]),$this->image ? url(Storage::url($this->image)) : null) ,



            'activation_status_in_vendor' =>$this->when($request->routeIs([
                'user.api.public.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.branch.categories',
                'user.api.vendor.menu_category.sub_categories',
                'user.api.vendor.menu_category.index',
                'user.api.vendor.branch.categories.by_branches',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.menu_category.single',
                'user.api.public.branch.getMenuCategories',
            ]),$this->activation_status),

            'activation_status_in_branch' => $this->when($request->routeIs([
                'user.api.public.branch.getMenuCategories',
                'user.api.public.branch.product.get_products'])&&$branch != null, function () use ($branch) {
                $branchRelation = $this->branches
                    ->firstWhere('id', $branch->id);

                return $branchRelation
                    ? $branchRelation->pivot->activation_status
                    : null;
            }),

            'sort' =>$this->when($request->routeIs([
                    'user.api.public.product.single',
                    'user.api.vendor.product.index',
                    'user.api.vendor.branch.categories',
                    'user.api.vendor.menu_category.index',
                    'user.api.vendor.menu_category.sub_categories',
                    'user.api.public.branch.getMenuCategories',
                    'user.api.vendor.branch.categories.by_branches',
                    'user.api.public.branch.product.get_products',
                    'user.api.vendor.menu_category.single',
                ]),$this->sort),

            //in vendor
            'products' =>$this->when($request->routeIs([
                    'user.api.vendor.menu_category.single',
                ]),ProductResource::collection($this->products)),

            //in public
            'products' =>$this->when($request->routeIs([
                    'user.api.public.branch.product.get_products',
                ]),ProductResource::collection($products)),

            'branches' => $this->when($request->routeIs([
                    'user.api.vendor.menu_category.single',
                ]),VendorBranchResource::collection($this->branches)),
        ];
    }
}
