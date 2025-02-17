<?php

namespace App\DataTransfertObjects;

use App\Http\Requests\Product\StoreProductRequest;

final class CreateProductDTO
{

	public function __construct(
		public string $name,
		public float $price,
		public array $ingredients = []
	) {}

	public static function make(StoreProductRequest $request): self
	{
		return new self(
			name: $request->input('name'),
			price: $request->input('price'),
			ingredients: $request->input('ingredients', [])
		);
	}

	public function toArray()
	{
		return [
			'name' => $this->name,
			'price' => $this->price,
			'ingredients' => $this->ingredients
		];
	}
}
