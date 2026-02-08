<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\HttpResponses;

class ProductController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     * GET /api/products
     */
    public function index()
    {
        return $this->success(
            ProductResource::collection(Product::all())
        );
    }

    /**
     * Display the specified resource.
     * GET /api/products/{id}
     */
    public function show(Product $product)
    {
        return $this->success(
            new ProductResource($product)
        );
    }
}
