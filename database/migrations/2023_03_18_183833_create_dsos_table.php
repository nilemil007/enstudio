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
        Schema::create('dsos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dd_house_id');
            $table->foreignId('supervisor_id');
            $table->foreignId('rso_id');
            $table->foreignId('retailer_id');
            $table->string('day');
            $table->string('amount');
            $table->string('eligibility');
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
        Schema::dropIfExists('dsos');
    }
};
