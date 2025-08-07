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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->enum('availability', ['In Stock', 'Out of Stock'])->default('In Stock');
            $table->enum('madewith', ['Edible Vegetable Oil (Refined Palmolein Oil)', 'Clarified Butter (Desi Ghee)']);
            $table->string('ingredients');
            $table->string('shelflife');
            $table->float('weight');
            $table->enum('weight_type',['gm','kg'])->default('gm');
            $table->integer('price');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
