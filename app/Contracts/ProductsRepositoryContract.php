<?php

namespace App\Contracts;

use App\DataTransfertObjects\CreateProductDTO;
use App\Models\Product;

interface ProductsRepositoryContract
{

	public function getProducts();

	public function createProduct(CreateProductDTO $createProductDTO);

	public function getProduct(Product $product);
}
