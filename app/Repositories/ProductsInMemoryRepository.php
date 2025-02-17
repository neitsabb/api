<?php

namespace App\Repositories;

use App\Contracts\ProductsRepositoryContract;
use Illuminate\Support\Facades\Session; // Importer la session
use App\DataTransfertObjects\CreateProductDTO;
use Illuminate\Support\Facades\Cache;

class ProductsInMemoryRepository implements ProductsRepositoryContract
{
	private array $products;
	private int $id;

	public function __construct()
	{
		$this->products = Cache::get('products', []);
		$this->id = Cache::get('last_product_id', 0);
	}

	public function getPaginatedProducts(int $perPage)
	{
		return $this->products;
	}
	public function createProduct(CreateProductDTO $createProductDTO)
	{
		$this->id++;

		$newProduct = [
			'id' => $this->id,
			'name' => $createProductDTO->name,
			'price' => $createProductDTO->price,
		];

		$this->products[] = $newProduct;

		// Sauvegarder les produits dans le cache (TTL de 1 heure)
		Cache::put('products', $this->products, now()->addHour());
		Cache::put('last_product_id', $this->id, now()->addHour());

		return $newProduct;
	}
}
