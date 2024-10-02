<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('review_product', function (Blueprint $table) {
            $table->foreignId('reviewId')->constrained('reviews', 'reviewId')->onDelete('cascade'); // Reference 'cartId'
            $table->foreignId('productId')->constrained('products', 'productId')->onDelete('cascade'); // Reference 'productId'
            $table->integer('rating')->default(0);
            $table->timestamps();

            // Composite key for uniqueness
            $table->primary(['reviewId', 'productId']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('review_product');
    }
};
