<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\PromoCode;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'active'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function promoCodes()
    {
        return $this->hasMany(PromoCode::class);
    }
}
