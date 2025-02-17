<?php

namespace App\Repositories;

use App\Contracts\ProductsRepositoryContract;
use App\DataTransfertObjects\CreateProductDTO;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductsRepository implements ProductsRepositoryContract
{

	public function getProducts()
	{
		return ProductResource::collection(
			Product::query()
				->withCount('ingredients')
				->get()
		);
	}

	public function createProduct(CreateProductDTO $createProductDTO)
	{

		// Attach ingredients to the product
		$product = Product::create($createProductDTO->toArray());

		// return quantity + ingredient id
		$product->ingredients()->attach(
			collect($createProductDTO->ingredients)->mapWithKeys(function ($ingredient) {
				return [
					$ingredient['id'] => [
						'quantity' => $ingredient['quantity']
					]
				];
			})

		);

		$product->loadCount('ingredients');

		return ProductResource::make(
			$product
		);
	}

	public function getProduct(Product $product)
	{
		return ProductResource::make($product);
	}
}
