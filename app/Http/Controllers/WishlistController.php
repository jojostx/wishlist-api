<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWishlistRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    use HttpResponses;

    /**
     * Display the current user's wishlist.
     */
    public function index(Request $request)
    {
        // We eagerly load the pivot table data so we can access 'created_at'
        // inside the Resource via 'whenPivotLoaded'
        $wishlist = $request->user()
            ->wishlist()
            ->withPivot('created_at')
            ->get();

        return $this->success(
            ProductResource::collection($wishlist)
        );
    }

    /**
     * Add a product to the wishlist.
     */
    public function store(StoreWishlistRequest $request)
    {
        $request->user()->wishlist()->syncWithoutDetaching([
            $request->validated('product_id')
        ]);

        return $this->success(
            null,
            'Product successfully added to your wishlist.',
            201
        );
    }

    /**
     * Remove a product from the wishlist.
     */
    public function destroy(Request $request, Product $product)
    {
        // Detach removes the link in the pivot table.
        // If the user tries to remove a product not in their list, 
        // this fails silently (which is standard idempotent behavior).
        $request->user()->wishlist()->detach($product->id);

        return $this->success(
            null,
            'Product successfully removed from your wishlist.'
        );
    }
}
