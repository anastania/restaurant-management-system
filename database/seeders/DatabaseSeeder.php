<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]);
        }

        // Run other seeders
        $this->call([
            CategorySeeder::class,
            IngredientSeeder::class,
            PromoCodeSeeder::class,
        ]);
    }
}
