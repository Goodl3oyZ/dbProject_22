<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews'; // Specify the table name

    protected $fillable = ['userId', 'comment', 'rating']; // Fillable attributes

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    // A cart can contain many products
    public function products()
    {
        return $this->belongsToMany(Products::class, 'review_product')
                    ->withPivot('rating')
                    ->withTimestamps(); // Automatically manage created_at and updated_at
    }
}
