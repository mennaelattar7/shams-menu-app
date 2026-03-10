<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\VendorBranche;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //check if branch_slug in route
        if($request->route('branch_slug') != null)
        {
            $branch = VendorBranche::where('slug',$request->route('branch_slug'))->first();
        }
        else
        {
            $branch = null;
        }
        // $active_offer = $this->offers->filter(fn($offer)=>$offer->is_active())->first();
        $offers = $this->offers()
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where('vendor_branch___offers.activation_status','active')
            ->get();

        $offer = $offers->first();


        $price_after_discount = $this->variants->first()->price; // السعر الافتراضي


        if($offer) {
            if($offer->discount_type == "fixed") {

                $price_after_discount = $this->variants->first()->price - $offer->discount_value;
            } elseif($offer->discount_type == "percent") {
                $price_after_discount = $this->variants->first()->price - ($this->variants->first()->price * $offer->discount_value / 100);
            }
        }

        if(Auth::check())
        {
            if(Auth::user()->account_type == "customer")
            {
                $customer = Auth::user()->customer;
                $favourites_products_ids_array = $customer->favourites->pluck('id')->toArray();
                if (in_array($this->id, $favourites_products_ids_array)) {
                    $is_favorite = true;
                }
                else
                {
                    $is_favorite =false;
                }
            }
            else
            {
                $is_favorite =false;
            }

        }
        else
        {
            $is_favorite = false;
        }



        return [
            'id'=>$this->id,

            'name' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.branch.products',
                'user.api.vendor.offer.index',
                'user.api.vendor.offer.single',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.ad.index',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.home.most_viewed_product',
                'user.api.public.customer.get_favourite_products',
            ]),$this->name),

            'name_object' => $this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.branch.products',
                'user.api.vendor.offer.index',
                'user.api.vendor.offer.single',
                'user.api.vendor.ad.index',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.home.most_viewed_product',
            ]),json_decode($this->getRawOriginal('name'), true)),

            'slug' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.branch.products',
                'user.api.vendor.offer.index',
                'user.api.vendor.offer.single',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.ad.index',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.home.most_viewed_product',
                'user.api.public.customer.get_favourite_products',
            ]),$this->slug),

            'description' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.public.branch.product.get_products',
                'user.api.public.customer.get_favourite_products',

            ]),$this->description),

            'description_object' => $this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.branch.products',
                'user.api.vendor.offer.index',
                'user.api.vendor.offer.single',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.menu_category.single',
            ]),json_decode($this->getRawOriginal('description'), true)),

            'price' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.offer.index',
                'user.api.vendor.offer.single',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.home.most_viewed_product',
                'user.api.public.customer.get_favourite_products',
            ]) && $this->variants->count() == 1 ,$this->variants->first()->price),

            'price_after_discount' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.offer.index',
                'user.api.vendor.offer.single',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.menu_category.single',
                'user.api.vendor.home.most_viewed_product',
                'user.api.public.customer.get_favourite_products',
            ]) && $this->variants->count() == 1 ,$price_after_discount),

            'discount_type' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.branch.products',
                'user.api.vendor.offer.index',
                'user.api.vendor.offer.single',
                'user.api.public.branch.product.get_products',
                'user.api.public.customer.get_favourite_products',
            ]),$offer?->discount_type),

            'discount_value' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.branch.products',
                'user.api.vendor.offer.index',
                'user.api.vendor.offer.single',
                'user.api.public.branch.product.get_products',
                'user.api.public.customer.get_favourite_products',
            ]),$offer?->discount_value),

            'currency' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.offer.index',
                'user.api.vendor.offer.single',
                'user.api.public.branch.product.get_products',
                'user.api.public.customer.get_favourite_products',
            ])  ,$this->category?->vendor?->currencies?->first()?->symbol),

            'activation_status_in_vendor' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.product.single',
                'user.api.vendor.branch.products',

            ]),$this->activation_status),


            'availability_status_in_branch' => $this->whenPivotLoaded('product___product_branches', function () {
                return $this->pivot->availability_status;
            }),
            'availability_status_in_branch' => $this->when($request->routeIs([
                'user.api.public.branch.product.get_products',
                'user.api.public.branch.product.single',
                'user.api.vendor.product.index',
                ])&&$branch != null, function () use ($branch) {
                $branchRelation = $this->branches
                    ->firstWhere('id', $branch->id);

                return $branchRelation
                    ? $branchRelation->pivot->availability_status
                    : null;
            }),

            'availability_status_in_branch' => $this->when($request->routeIs([
                'user.api.vendor.product.index',
                'user.api.public.branch.product.get_products',
                ])&&$request->branch_slug != null, function () use ($request){
                    $branch = VendorBranche::where('slug',$request->branch_slug)->first();
                    $branchRelation = $this->branches
                        ->firstWhere('id', $branch->id);
                return $branchRelation
                    ? $branchRelation->pivot->availability_status
                    : null;
            }),


            'activation_status_in_branch' => $this->when($request->routeIs([
                'user.api.public.branch.product.get_products',
                'user.api.public.branch.product.single'])&&$branch != null, function () use ($branch) {
                $branchRelation = $this->branches
                    ->firstWhere('id', $branch->id);

                return $branchRelation
                    ? $branchRelation->pivot->activation_status
                    : null;
            }),

            'activation_status_in_branch' => $this->when($request->routeIs([
                'user.api.vendor.product.index'
                ])&&$request->branch_slug != null, function () use ($request) {
                    $branch = VendorBranche::where('slug',$request->branch_slug)->first();
                $branchRelation = $this->branches
                    ->firstWhere('id', $branch->id);

                return $branchRelation
                    ? $branchRelation->pivot->activation_status
                    : null;
            }),

            'availability_branches' => $this->when(
                $request->routeIs(['user.api.public.menu_category.get_products']),
                $this->branches->map(function ($branch) {
                    return [
                        'id' => $branch->id,
                        'name' => $branch->name,
                        'slug' =>$branch->slug,
                        'availability_status' => $branch->pivot->availability_status,
                    ];
                })
            ),
            'activation_status_in_offer' => $this->when($request->routeIs([
                    'user.api.vendor.offer.index',
                    'user.api.vendor.offer.single',
                    ]), $this->whenPivotLoaded('vendor_branch___offer_products', function () {
                        return $this->pivot->activation_status;
            })),

            'variants' => $this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',

            ]) && $this->variants->count()>1,  ProductVariantResource::collection($this->variants)),

            'category' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.vendor.offer.single',

            ]),new VendorMenuCategoryResource($this->category)) ,

            'product_type' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',

            ]),new ProductTypeResource($this->product_type)),

            'image' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.home.most_viewed_product',
                'user.api.public.customer.get_favourite_products',
            ]),$this->image ? url(Storage::url($this->image))  : null),

            'is_favorite' =>$this->when($request->routeIs([
                'user.api.public.branch.product.get_products',
                'user.api.vendor.product.index',
                'user.api.public.customer.get_favourite_products',
            ]),$is_favorite),

            'calories' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.menu_category.products',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.product.single',
            ]),$this->calories),

            'badges' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.vendor.menu_category.products',
                'user.api.public.branch.product.get_products',
                'user.api.vendor.product.single',

            ]),ProductBadgeResource::collection($this->badges)),

            'allergens' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.public.branch.product.get_products',
                'user.api.public.customer.get_favourite_products',
            ]),ProductAllergenResource::collection($this->allergens)),

            'cooking_levels' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.public.branch.product.get_products',

            ]),ProductCookingLevelResource::collection($this->cooking_levels)),

            'branches' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
            ]),VendorBranchResource::collection($this->branches)),

            'sort' =>$this->when($request->routeIs([
                'user.api.public.branch.product.single',
                'user.api.public.menu_category.get_products',
                'user.api.vendor.product.index',
                'user.api.vendor.menu_category.products',
                'user.api.vendor.product.single',
                'user.api.public.branch.product.get_products',

            ]),$this->sort),

            'views_count' =>$this->when($request->routeIs([
                'user.api.vendor.home.most_viewed_product',
                'user.api.vendor.menu_category.products',
            ]),$this->views->count()),
        ];
    }
}
