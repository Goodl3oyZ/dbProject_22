<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    
    use HasFactory;

    protected $table = 'products'; // Correct table name to plural form

    protected $fillable = [
        'productName',
        'price',
        'stockQuantity',
    ];

    // Many-to-Many: A product can be in many carts
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product')
            ->withPivot('quantity') // Include the quantity column from the pivot table
            ->withTimestamps(); // Automatically manage created_at and updated_at
    }
    // Uncomment and define this method if you have a Review model
    public function reviews()
    {
        return $this->belongsToMany(Cart::class, 'review_product')
            ->withPivot('rating')
            ->withTimestamps();
    }
}
