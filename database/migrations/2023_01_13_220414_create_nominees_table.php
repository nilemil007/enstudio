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
        Schema::create('nominees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rso_id')->constrained();
            $table->string('name', 100)->nullable();
            $table->string('tmp_name', 100)->nullable();
            $table->string('relation', 20)->nullable();
            $table->string('tmp_relation', 20)->nullable();
            $table->string('number', 11)->nullable()->unique();
            $table->string('tmp_number', 11)->nullable()->unique();
            $table->string('address')->nullable();
            $table->string('tmp_address')->nullable();
            $table->string('father_name', 100)->nullable();
            $table->string('tmp_father_name', 100)->nullable();
            $table->string('mother_name', 100)->nullable();
            $table->string('tmp_mother_name', 100)->nullable();
            $table->timestamp('dob')->nullable();
            $table->timestamp('tmp_dob')->nullable();
            $table->string('nid')->nullable()->unique();
            $table->string('tmp_nid')->nullable()->unique();
            $table->string('image')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('nominees');
    }
};
