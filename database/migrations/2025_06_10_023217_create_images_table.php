<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('imageable_type'); // Will store 'App\Models\Property' or 'App\Models\Furniture'
            $table->unsignedBigInteger('imageable_id');
            $table->string('path');
            $table->boolean('is_primary')->default(false);
            $table->timestamps();

            $table->index(['imageable_type', 'imageable_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
};
