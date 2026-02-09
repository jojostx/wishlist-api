<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    use HttpResponses;

    /**
     * Display a paginated listing of products.
     */
    public function index(IndexProductRequest $request): JsonResponse
    {
        // get validated per_page or default to 15
        $perPage = $request->validated('per_page', 15);

        // query and Paginate
        $products = Product::orderBy('created_at', 'desc')->paginate($perPage);

        // return as Resource Collection
        // we use ->response()->getData(true) to convert the resource 
        // (which includes 'data', 'links', and 'meta') into an array 
        // so it fits inside your HttpResponses 'data' wrapper.
        return $this->success(
            ProductResource::collection($products)->response()->getData(true)
        );
    }

    /**
     * Display the specified product.
     * GET /api/products/{id}
     */
    public function show(Product $product): JsonResponse
    {
        return $this->success(
            new ProductResource($product)
        );
    }
}
