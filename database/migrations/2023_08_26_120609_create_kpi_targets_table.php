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
        Schema::create('kpi_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('dd_house_id')->constrained();
            $table->foreignId('rso_id')->constrained();
            $table->foreignId('supervisor_id')->constrained();
            $table->string('ga');
            $table->string('recharge');
            $table->string('data');
            $table->string('mixed');
            $table->string('voice');
            $table->string('total_bundle');
            $table->string('lso');
            $table->string('sso');
            $table->string('bso');
            $table->string('dsso');
            $table->string('ddso');
            $table->string('dso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_targets');
    }
};
