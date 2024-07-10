<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->string('product_image')->nullable();
            $table->string('product_name');
            $table->integer('product_quantity');
            $table->decimal('product_price', 8, 2);
            $table->decimal('total_price', 8, 2);

            $table->string('name');
            $table->string('email');
            $table->string('phoneNo');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('state');
            $table->integer('zipcode');
            $table->string('payment_method');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
