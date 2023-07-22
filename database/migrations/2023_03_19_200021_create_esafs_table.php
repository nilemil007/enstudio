<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('esafs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dd_house_id');
            $table->foreignId('supervisor_id');
            $table->foreignId('rso_id');
            $table->foreignId('retailer_id');
            $table->string('customer_name');
            $table->string('customer_number');
            $table->string('alternate_number')->nullable();
            $table->string('email')->nullable();
            $table->string('gender');
            $table->string('reason');
            $table->string('address');
            $table->date('date');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('esafs');
    }
};
