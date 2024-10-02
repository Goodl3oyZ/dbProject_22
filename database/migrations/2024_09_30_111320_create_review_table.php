<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('reviewId'); // Primary key with the name 'cartId'
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->integer('rating');
            $table->string('comment');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
