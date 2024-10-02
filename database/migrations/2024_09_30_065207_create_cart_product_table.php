<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->foreignId('cartId')->constrained('carts', 'cartId')->onDelete('cascade'); // Reference 'cartId'
            $table->foreignId('productId')->constrained('products', 'productId')->onDelete('cascade'); // Reference 'productId'
            $table->integer('quantity')->default(0); // Quantity of the product in the cart
            $table->timestamps();

            // Composite key for uniqueness
            $table->primary(['cartId', 'productId']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_product');
    }
};
