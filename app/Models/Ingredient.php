<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'stock',
        'cost',
        'unit',
        'minimum_stock',
        'active'
    ];

    protected $casts = [
        'cost' => 'decimal:2',
        'stock' => 'integer',
        'minimum_stock' => 'integer',
    ];

    public function isLowStock()
    {
        return $this->stock <= $this->minimum_stock;
    }
}
