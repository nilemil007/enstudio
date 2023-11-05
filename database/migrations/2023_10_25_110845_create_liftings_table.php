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
        Schema::create('liftings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dd_house_id')->constrained();
            $table->string('product_type');
            $table->string('product');
            $table->string('qty')->nullable();
            $table->string('price')->nullable();
            $table->string('lifting_price')->nullable();
            $table->string('itopup')->nullable();
            $table->string('total_amount')->nullable();
            $table->date('lifting_date');
            $table->string('remarks')->default('Cash');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liftings');
    }
};
