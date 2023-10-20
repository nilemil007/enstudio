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
        Schema::create('cms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dd_house_id')->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('type')->nullable();
            $table->string('pool_number')->unique();
            $table->string('personal_number')->nullable()->unique();
            $table->string('tmp_personal_number')->nullable()->unique();
            $table->string('nid_number')->nullable()->unique();
            $table->string('tmp_nid_number')->nullable()->unique();
            $table->string('father_name')->nullable();
            $table->string('tmp_father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('tmp_mother_name')->nullable();
            $table->string('division')->nullable();
            $table->string('tmp_division')->nullable();
            $table->string('district')->nullable();
            $table->string('tmp_district')->nullable();
            $table->string('thana')->nullable();
            $table->string('tmp_thana')->nullable();
            $table->longText('address')->nullable();
            $table->longText('tmp_address')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('tmp_bank_name')->nullable();
            $table->string('account_number')->nullable()->unique();
            $table->string('tmp_account_number')->nullable()->unique();
            $table->string('account_type')->nullable();
            $table->string('tmp_account_type')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('tmp_branch_name')->nullable();
            $table->string('salary')->nullable();
            $table->string('education')->nullable();
            $table->string('gender')->nullable();
            $table->enum('blood_group', ['a+','ab+','a-','ab-','b+','b-','o+','o-']);
            $table->date('dob')->nullable();
            $table->date('tmp_dob')->nullable();
            $table->date('joining_date')->nullable();
            $table->date('resigning_date')->nullable();
            $table->string('documents')->nullable();
            $table->string('status')->default(1);
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms');
    }
};
