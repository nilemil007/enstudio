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
        Schema::create('product_and_types', function (Blueprint $table) {
            $table->id();
            $table->string('product_type');
            $table->string('product');
            $table->string('price');
            $table->string('lifting_price');
            $table->string('retailer_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_and_types');
    }
};
