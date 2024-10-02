<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id('cartId'); // Primary key with the name 'cartId'
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->integer('amount'); // Consider changing to $table->decimal('amount', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
};

