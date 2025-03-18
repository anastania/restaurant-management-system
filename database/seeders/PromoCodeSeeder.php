<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PromoCode;
use Carbon\Carbon;

class PromoCodeSeeder extends Seeder
{
    public function run(): void
    {
        $promoCodes = [
            [
                'code' => 'WELCOME20',
                'discount' => 20,
                'type' => 'percentage',
                'valid_until' => Carbon::now()->addMonths(3),
                'is_active' => true
            ],
            [
                'code' => 'SAVE50',
                'discount' => 50,
                'type' => 'fixed',
                'valid_until' => Carbon::now()->addMonths(1),
                'is_active' => true
            ],
            [
                'code' => 'SUMMER2025',
                'discount' => 15,
                'type' => 'percentage',
                'valid_until' => Carbon::now()->addMonths(6),
                'is_active' => true
            ],
            [
                'code' => 'SPECIAL25',
                'discount' => 25,
                'type' => 'fixed',
                'valid_until' => Carbon::now()->addWeeks(2),
                'is_active' => true
            ],
            [
                'code' => 'WEEKEND10',
                'discount' => 10,
                'type' => 'percentage',
                'valid_until' => Carbon::now()->addDays(10),
                'is_active' => true
            ]
        ];

        foreach ($promoCodes as $promoCode) {
            PromoCode::create($promoCode);
        }
    }
}
