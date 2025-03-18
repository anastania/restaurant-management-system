<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Hot Dishes',
                'description' => 'Delicious hot dishes from our kitchen',
            ],
            [
                'name' => 'Cold Dishes',
                'description' => 'Refreshing cold dishes and salads',
            ],
            [
                'name' => 'Soups',
                'description' => 'Warm and comforting soups',
            ],
            [
                'name' => 'Grills',
                'description' => 'Fresh grilled meats and vegetables',
            ],
            [
                'name' => 'Appetizers',
                'description' => 'Starters and small bites',
            ],
            [
                'name' => 'Desserts',
                'description' => 'Sweet treats and pastries',
            ],
            [
                'name' => 'Beverages',
                'description' => 'Refreshing drinks and cocktails',
            ],
            [
                'name' => 'Specials',
                'description' => 'Chef\'s special dishes',
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
