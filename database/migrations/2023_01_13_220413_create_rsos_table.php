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
        Schema::create('rsos',
            function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('nominee_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('dd_house');
            $table->string('supervisor');
            $table->json('routes')->nullable();
            $table->string('rso_code', 10)->unique();
            $table->string('itop_number', 11)->unique();
            $table->string('pool_number', 11)->unique();
            $table->string('personal_number', 11)->unique();
            $table->string('tmp_personal_number', 11)->nullable();
            $table->string('rid', 10)->unique();
            $table->string('father_name', 50);
            $table->string('tmp_father_name', 50)->nullable();
            $table->string('mother_name', 50);
            $table->string('tmp_mother_name', 50)->nullable();
            $table->string('division', 20);
            $table->string('district', 20);
            $table->string('thana', 20);
            $table->longText('address');
            $table->longText('tmp_address')->nullable();
            $table->enum('blood_group', ['a+','ab+','a-','ab-','b+','b-','o+','o-']);
            $table->string('tmp_blood_group')->nullable();
            $table->string('sr_no', 5)->unique();
            $table->string('account_number', 20)->nullable()->unique();
            $table->string('tmp_account_number', 20)->nullable();
            $table->string('bank_name');
            $table->string('tmp_bank_name')->nullable();
            $table->string('brunch_name');
            $table->string('tmp_brunch_name')->nullable();
            $table->string('routing_number');
            $table->string('tmp_routing_number')->nullable();
            $table->string('salary');
            $table->string('education');
            $table->string('tmp_education')->nullable();
            $table->string('marital_status');
            $table->string('tmp_marital_status')->nullable();
            $table->string('gender');
            $table->date('dob');
            $table->date('tmp_dob')->nullable();
            $table->string('nid')->unique();
            $table->string('tmp_nid')->nullable()->unique();
            $table->string('status')->default(1);
            $table->string('remarks')->nullable();
            $table->string('document')->nullable();
            $table->enum('residential_rso', ['Yes','No']);
            $table->date('joining_date');
            $table->date('resigning_date')->nullable();
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
        Schema::dropIfExists('rsos');
    }
};
