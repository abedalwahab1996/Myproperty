<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('address');
            $table->decimal('price', 12, 2);
            $table->decimal('area', 10, 2)->nullable()->comment('Square footage/meters');
            $table->string('number')->nullable()->comment('Property number/unit');
            $table->boolean('is_publish')->default(false);
            $table->boolean('is_approved')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
