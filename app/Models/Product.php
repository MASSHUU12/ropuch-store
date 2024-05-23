<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'currency',
        'quantity'
    ];

    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
