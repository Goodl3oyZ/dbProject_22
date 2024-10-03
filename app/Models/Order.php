<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders'; // Specify the table name

    protected $fillable = ['userId', 'orderDate', 'totalAmount']; // Fillable attributes

    // An order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

}
