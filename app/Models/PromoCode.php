<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount',
        'type',
        'valid_until',
        'is_active'
    ];

    protected $casts = [
        'valid_until' => 'datetime',
        'discount' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isValid()
    {
        return $this->is_active && 
            ($this->valid_until === null || now()->lessThanOrEqualTo($this->valid_until));
    }
}
