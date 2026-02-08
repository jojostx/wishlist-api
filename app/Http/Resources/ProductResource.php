<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => (float) $this->price,
            // Only include pivot data if it exists (i.e., when viewing wishlist)
            'added_on' => $this->whenPivotLoaded('wishlists', function () {
                return $this->pivot->created_at->toIso8601String();
            }),
        ];
    }
}