<?php

namespace App\Http\Controllers;

use App\Contracts\ProductsRepositoryContract;
use App\DataTransfertObjects\CreateProductDTO;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    public function __construct(
        private ProductsRepositoryContract $repository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json(
            $this->repository->getProducts()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = $this->repository->createProduct(
            CreateProductDTO::make(
                $request
            )
        );

        if ($request->has('ingredients')) {
            $product->ingredients()->sync(
                collect($request->input('ingredients'))->mapWithKeys(
                    fn($ingredient) => [$ingredient['id'] => ['quantity' => $ingredient['quantity']]]
                )
            );
        }

        $product->load('ingredients');

        return response()->json(
            [
                'success' => true,
                'message' => 'Produit créé avec succès',
                'data' => ProductResource::make($product)

            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json(
            ProductResource::make($product)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        if ($request->has('ingredients')) {
            $product->ingredients()->sync(
                collect($request->input('ingredients'))->mapWithKeys(
                    fn($ingredient) => [$ingredient['id'] => ['quantity' => $ingredient['quantity']]]
                )
            );
        }

        $product->load('ingredients');

        return response()->json(
            [
                'success' => true,
                'message' => 'Produit modifié avec succès',
                'data' => ProductResource::make($product)
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
