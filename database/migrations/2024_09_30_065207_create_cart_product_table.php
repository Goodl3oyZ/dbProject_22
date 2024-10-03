<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->foreignId('cart_id')->constrained('carts', 'cartId')->onDelete('cascade');
            $table->foreignId('products_id')->constrained('products', 'productId')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->timestamps();

            // Composite key for uniqueness
            $table->primary(['cart_id', 'products_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_product');
    }
};
