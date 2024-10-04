<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('reviewId'); // Primary key for reviews
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('productId'); // Foreign key to products table
            $table->text('comment')->nullable();
            $table->tinyInteger('rating')->unsigned()->default(1); // Rating 1-5
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('productId')->references('productId')->on('products')->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
