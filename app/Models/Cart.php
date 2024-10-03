<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory; // Use the HasFactory trait
    protected $table = 'carts'; // Correct table name to plural form
    protected $primaryKey = 'cartId';
    protected $fillable = ['userId', 'amount']; // Removed productId; it should not be here
    // A cart belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    // A cart can contain many products
    public function products()
    {
        return $this->belongsToMany(Products::class, 'cart_product', 'cart_id', 'products_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }

}
