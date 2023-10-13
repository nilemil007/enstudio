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
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dd_house_id')->constrained();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('pool_number', 11)->unique();
            $table->string('father_name', 50);
            $table->string('tmp_father_name', 50)->nullable();
            $table->string('mother_name', 50);
            $table->string('tmp_mother_name', 50)->nullable();
            $table->string('division', 20);
            $table->string('district', 20);
            $table->string('thana', 20);
            $table->text('address');
            $table->text('tmp_address')->nullable();
            $table->bigInteger('nid')->unique();
            $table->bigInteger('tmp_nid')->nullable()->unique();
            $table->string('document')->nullable();
            $table->string('status')->default(1);
            $table->date('dob');
            $table->date('tmp_dob')->nullable();
            $table->timestamp('joining_date')->nullable();
            $table->timestamp('resigning_date')->nullable();
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
        Schema::dropIfExists('supervisors');
    }
};
