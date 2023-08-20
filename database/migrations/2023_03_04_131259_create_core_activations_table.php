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
        Schema::create('core_activations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dd_house_id');
            $table->foreignId('supervisor_id');
            $table->foreignId('rso_id');
            $table->foreignId('retailer_id');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('sim_serial');
            $table->string('msisdn');
            $table->string('bp_flag');
            $table->string('bp_number');
            $table->string('selling_price');
            $table->date('activation_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core_activations');
    }
};
