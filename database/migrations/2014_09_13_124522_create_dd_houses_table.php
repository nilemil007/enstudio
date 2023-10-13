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
        Schema::create('dd_houses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('cluster_name');
            $table->string('region');
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('district')->nullable();
            $table->text('address')->nullable();
            $table->string('proprietor_name')->nullable();
            $table->string('proprietor_number')->nullable();
            $table->string('poc_name')->nullable();
            $table->string('poc_number')->nullable();
            $table->string('tin_number')->nullable()->unique();
            $table->string('bin_number')->nullable()->unique();
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->string('bts_code')->nullable();
            $table->string('image')->nullable();
            $table->date('lifting_date')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('dd_houses');
    }
};
