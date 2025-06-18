<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_type'); // Will store 'App\Models\Property' or 'App\Models\Furniture'
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2)->comment('Snapshot at time of addition');
            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->index(['product_id', 'product_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
