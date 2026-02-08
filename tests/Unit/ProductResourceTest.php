<?php

namespace Tests\Unit;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductResourceTest extends TestCase
{
    use RefreshDatabase;

    public function test_added_on_is_absent_without_pivot(): void
    {
        $product = Product::factory()->create();

        $resource = new ProductResource($product);

        $payload = $resource->resolve();

        $this->assertArrayNotHasKey('added_on', $payload);
    }

    public function test_added_on_is_present_with_pivot(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $user->wishlist()->attach($product->id);

        $productWithPivot = $user->wishlist()
            ->withPivot('created_at')
            ->first();

        $resource = new ProductResource($productWithPivot);
        $payload = $resource->toArray(request());

        $this->assertArrayHasKey('added_on', $payload);
        $this->assertNotEmpty($payload['added_on']);
    }
}
