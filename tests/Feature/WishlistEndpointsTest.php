<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class WishlistEndpointsTest extends TestCase
{
    use RefreshDatabase;

    public function test_wishlist_requires_authentication(): void
    {
        $response = $this->getJson('/api/wishlist');

        $response->assertStatus(401)
            ->assertJson([
                'status' => 'Error has occurred.',
                'message' => 'Unauthenticated.',
            ]);
    }

    public function test_user_can_add_product_to_wishlist_and_view_it(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        Sanctum::actingAs($user);

        $addResponse = $this->postJson('/api/wishlist', [
            'product_id' => $product->id,
        ]);

        $addResponse->assertStatus(201)
            ->assertJson([
                'status' => 'Request was successful.',
                'message' => 'Product successfully added to your wishlist.',
            ]);

        $this->assertDatabaseHas('wishlists', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $indexResponse = $this->getJson('/api/wishlist');

        $indexResponse->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    '*' => ['id', 'name', 'description', 'price', 'added_on'],
                ],
            ]);

        $this->assertIsString($indexResponse->json('data.0.added_on'));
    }

    public function test_user_can_remove_product_from_wishlist(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $user->wishlist()->attach($product->id);

        Sanctum::actingAs($user);

        $response = $this->deleteJson('/api/wishlist/' . $product->id);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'Request was successful.',
                'message' => 'Product successfully removed from your wishlist.',
            ]);

        $this->assertDatabaseMissing('wishlists', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }
}
