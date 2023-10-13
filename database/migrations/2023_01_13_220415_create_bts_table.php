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
        Schema::create('bts', function (Blueprint $table) {
            $table->id();
            $table->string('dd_house');
            $table->string('site_id')->unique();
            $table->string('bts_code')->unique();
            $table->string('division');
            $table->string('district');
            $table->string('thana');
            $table->string('network_mode')->nullable();
            $table->string('address')->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->decimal('latitude', 10, 6)->nullable();
            $table->date('two_g_on_air_date')->nullable();
            $table->date('three_g_on_air_date')->nullable();
            $table->date('four_g_on_air_date')->nullable();
            $table->string('urban_rural')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bts');
    }
};
