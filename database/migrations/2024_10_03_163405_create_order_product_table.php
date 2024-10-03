<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key of the pivot table
            $table->unsignedBigInteger('order_orderId'); // Foreign key to orders
            $table->unsignedBigInteger('products_productId'); // Foreign key to products
            $table->integer('quantity'); // Quantity of each product in the order
            $table->timestamps();

            // Set foreign keys
            $table->foreign('order_orderId')->references('orderId')->on('orders')->onDelete('cascade');
            $table->foreign('products_productId')->references('productId')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_product');
    }
}

