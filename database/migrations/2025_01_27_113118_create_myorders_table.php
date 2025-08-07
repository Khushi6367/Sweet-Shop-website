<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('myorders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billno_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('mobile');
            $table->longText('address');
            $table->string('product_name');
            $table->string('flavour');
            $table->enum('madewith', ['Edible Vegetable Oil (Refined Palmolein Oil)', 'Clarified Butter (Desi Ghee)']);
            $table->float('weight');
            $table->enum('weight_type', ['gm', 'kg'])->default('gm');
            $table->string('qty');
            $table->integer('mrp');
            $table->integer('price');
            $table->integer('finalprice');
            $table->float('discount');
            $table->enum('payment_method', ['COD', 'Bank']);
            $table->string('utr')->nullable()->unique();
            $table->string('screenshot')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('myorders');
    }
};
