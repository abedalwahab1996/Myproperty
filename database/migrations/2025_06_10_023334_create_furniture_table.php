<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('furniture', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('price', 10, 2);
            $table->boolean('is_deleted')->default(false);
            $table->unsignedBigInteger('user_id'); // Add this line

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    public function down()
    {
        Schema::dropIfExists('furniture');
    }
};
