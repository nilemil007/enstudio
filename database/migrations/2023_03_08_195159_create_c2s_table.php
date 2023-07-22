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
    public function up()
    {
        Schema::create('c2s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dd_house_id');
            $table->foreignId('supervisor_id');
            $table->foreignId('rso_id');
            $table->foreignId('retailer_id');
            $table->date('date');
            $table->string('amount');
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
        Schema::dropIfExists('c2_s');
    }
};
