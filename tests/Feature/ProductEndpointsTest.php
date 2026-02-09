<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductEndpointsTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_index_returns_paginated_products(): void
    {
        // create 3 products
        $products = Product::factory()->count(3)->create();

        // hit the endpoint
        $response = $this->getJson('/api/products');

        // check the new nested structure
        $response->assertStatus(200)
            ->assertJsonCount(3, 'data.data')
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'data' => [
                        '*' => ['id', 'name', 'description', 'price']
                    ],
                    'links',
                    'meta' => [
                        'current_page',
                        'from',
                        'last_page',
                        'per_page',
                        'total'
                    ]
                ],
            ]);

        // check specific data points
        $response->assertJsonPath('data.data.0.id', (string) $products[0]->id)
            ->assertJsonPath('data.data.0.name', $products[0]->name);
    }

    public function test_product_index_pagination_params_work(): void
    {
        // create 15 products
        Product::factory()->count(15)->create();

        // request Page 2 with 5 items per page
        $response = $this->getJson('/api/products?page=2&per_page=5');

        // assert pagination metadata and data count
        $response->assertStatus(200)
            ->assertJsonCount(5, 'data.data')
            ->assertJsonPath('data.meta.current_page', 2)
            ->assertJsonPath('data.meta.per_page', 5)
            ->assertJsonPath('data.meta.total', 15);
    }

    public function test_product_index_validates_params(): void
    {
        // send invalid non-integer string for per_page
        $response = $this->getJson('/api/products?per_page=invalid');

        // expect 422 Unprocessable Entity
        $response->assertStatus(422)
            ->assertJson([
                'status' => 'Error has occurred.',
                'message' => 'Validation failed.',
            ])
            // check that the specific error key exists in your custom error structure
            ->assertJsonStructure([
                'data' => ['per_page']
            ]);
    }

    public function test_product_show_returns_single_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->getJson('/api/products/' . $product->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => ['id', 'name', 'description', 'price'],
            ])
            ->assertJsonPath('data.id', (string) $product->id);
    }

    public function test_product_show_returns_404_if_not_found(): void
    {
        $response = $this->getJson('/api/products/99999');

        $response->assertStatus(404)
            ->assertJson([
                'status' => 'Error has occurred.',
                'message' => 'Resource not found.',
            ]);
    }
}
