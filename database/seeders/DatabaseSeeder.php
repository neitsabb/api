<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Création d'un utilisateur de test
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $products = Product::factory(50)->create();

        $ingredients = Ingredient::factory(20)->create();

        foreach ($products as $product) {
            if (rand(0, 1)) {
                $randomIngredients = $ingredients->random(rand(1, 5));

                foreach ($randomIngredients as $ingredient) {
                    $product->ingredients()->attach($ingredient->id, [
                        'quantity' => rand(1, 100) / 10
                    ]);
                }
            }
        }
    }
}
