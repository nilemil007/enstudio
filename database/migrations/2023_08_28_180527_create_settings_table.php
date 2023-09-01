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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('shera_partner_day')->nullable();
            $table->string('shera_partner_percentage')->nullable();
            $table->string('drc_code')->nullable();
            $table->string('exclude_from_rso_act')->nullable();
            $table->string('exclude_from_live_act')->nullable();
            $table->json('product_code')->nullable();
            $table->json('dd_house')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
