<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('productId'); // Primary key
            $table->string('productName');
            $table->decimal('price', 10, 2); // Consider changing from integer to decimal for price
            $table->integer('stockQuantity');
            $table->string('products_photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
