<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('orderId');
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->timestamp('orderDate');
            $table->decimal('totalAmount', 20, 2);
            $table->string('shipping'); // 'online' or 'delivery'
            $table->string('shippingAddress');
            $table->string('customerName');
            $table->string('customerPhone');
            $table->string('customerEmail');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }

};
