<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class Products extends Model
{

    use HasFactory;

    protected $table = 'products'; // Correct table name to plural form
    protected $primaryKey = 'productId'; // Specify the correct primary key
    protected $fillable = [
        'productName',
        'price',
        'stockQuantity',
    ];

    // Many-to-Many: A product can be in many carts
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product', 'products_Id', 'cart_Id')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    // Uncomment and define this method if you have a Review model
    public function reviews()
    {
        return $this->belongsToMany(Cart::class, 'review_product')
            ->withPivot('rating')
            ->withTimestamps();
    }
}
