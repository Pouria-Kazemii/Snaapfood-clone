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
        Schema::create('foods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('price');
            $table->string('raw_material')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('type_of_food_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
            $table->foreign('type_of_food_id')
                ->references('id')
                ->on('type_of_foods')
                ->onDelete('cascade');

            $table->foreign('restaurant_id')
                ->references('id')
                ->on('restaurants')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
