<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews'; // Specify the table name

    protected $fillable = ['userId', 'productId', 'comment', 'rating']; // Fillable attributes

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    // A cart can contain many products
    public function product()
    {
        return $this->belongsTo(Products::class, 'productId');
    }

}
