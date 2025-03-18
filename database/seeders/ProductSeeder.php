<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $hotDishesCategory = Category::where('name', 'Hot Dishes')->first();
        $coldDishesCategory = Category::where('name', 'Cold Dishes')->first();
        $soupCategory = Category::where('name', 'Soup')->first();

        $products = [
            [
                'name' => 'Poulet Frit',
                'description' => 'Délicieux poulet frit croustillant',
                'price' => 15.00,
                'stock' => 50,
                'category_id' => $hotDishesCategory->id,
                'variants' => json_encode([
                    'sizes' => ['Normal', 'Large'],
                    'sauces' => ['BBQ', 'Piquante', 'Aigre-douce']
                ]),
                'active' => true
            ],
            [
                'name' => 'Salade César',
                'description' => 'Salade fraîche avec poulet grillé',
                'price' => 12.00,
                'stock' => 30,
                'category_id' => $coldDishesCategory->id,
                'variants' => json_encode([
                    'sizes' => ['Normal', 'Large'],
                    'dressings' => ['César', 'Ranch', 'Vinaigrette']
                ]),
                'active' => true
            ],
            [
                'name' => 'Soupe à l\'oignon',
                'description' => 'Soupe à l\'oignon traditionnelle',
                'price' => 8.00,
                'stock' => 40,
                'category_id' => $soupCategory->id,
                'variants' => json_encode([
                    'sizes' => ['Normal', 'Large'],
                    'extras' => ['Fromage', 'Croûtons']
                ]),
                'active' => true
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
