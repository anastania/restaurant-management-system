<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            [
                'name' => 'Chicken Breast',
                'stock' => 50,
                'unit' => 'kg'
            ],
            [
                'name' => 'Rice',
                'stock' => 100,
                'unit' => 'kg'
            ],
            [
                'name' => 'Tomatoes',
                'stock' => 30,
                'unit' => 'kg'
            ],
            [
                'name' => 'Onions',
                'stock' => 40,
                'unit' => 'kg'
            ],
            [
                'name' => 'Garlic',
                'stock' => 10,
                'unit' => 'kg'
            ],
            [
                'name' => 'Olive Oil',
                'stock' => 20,
                'unit' => 'L'
            ],
            [
                'name' => 'Salt',
                'stock' => 15,
                'unit' => 'kg'
            ],
            [
                'name' => 'Black Pepper',
                'stock' => 5,
                'unit' => 'kg'
            ],
            [
                'name' => 'Flour',
                'stock' => 75,
                'unit' => 'kg'
            ],
            [
                'name' => 'Sugar',
                'stock' => 45,
                'unit' => 'kg'
            ],
            [
                'name' => 'Milk',
                'stock' => 30,
                'unit' => 'L'
            ],
            [
                'name' => 'Eggs',
                'stock' => 200,
                'unit' => 'pcs'
            ]
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create($ingredient);
        }
    }
}
