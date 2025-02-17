<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $resource = [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'image' => $this->image,
            'ingredientsCount' => $this->ingredients_count ?: 0,
            'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients')),
        ];

        return $resource;
    }
}
