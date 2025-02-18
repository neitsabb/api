<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrUpdateIngredientResource;
use App\Http\Resources\IngredientResource;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        return response()->json(
            IngredientResource::collection(
                Ingredient::query()
                    ->withCount('products')
                    ->get()
            )
        );
    }

    public function show(Ingredient $ingredient)
    {
        return response()->json(
            IngredientResource::make($ingredient)
        );
    }

    public function store(StoreOrUpdateIngredientResource $request)
    {
        $ingredient = Ingredient::create($request->validated());

        return response()->json(
            [
                'success' => true,
                'message' => 'Ingredient created successfully',
                'data' => IngredientResource::make($ingredient),
            ],
            201
        );
    }

    public function update(StoreOrUpdateIngredientResource $request, Ingredient $ingredient)
    {
        $ingredient->update($request->validated());

        return response()->json(
            [
                'success' => true,
                'message' => 'Ingredient modifié avec succès',
                'data' => IngredientResource::make($ingredient)
            ]
        );
    }
}
