<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Cart extends Model
{
    use HasFactory; // Use the HasFactory trait

    protected $table = 'carts'; // Correct table name to plural form

    protected $fillable = ['userId', 'amount']; // Removed productId; it should not be here

    // A cart belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    // A cart can contain many products
    public function products()
    {
        return $this->belongsToMany(Products::class, 'cart_product')
            ->withPivot('quantity') // Include the quantity column from the pivot table
            ->withTimestamps(); // Automatically manage created_at and updated_at
    }
    protected static function booted()
    {
        static::created(function ($carts) {
            // Automatically create a cart for the newly registered user
            $carts->cart_product()->create();
        });
    }
}
