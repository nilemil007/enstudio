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
        Schema::create('rsos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dd_house_id')->constrained();
            $table->foreignId('user_id')->unique()->constrained();
            $table->foreignId('supervisor_id')->constrained();
            $table->enum('residential_rso', ['yes','no']);

            $table->string('rso_code')->unique();
            $table->string('itop_number', 11)->unique();
            $table->string('pool_number', 11)->unique();
            $table->string('rid')->unique();
            $table->string('sr_no')->unique();
            $table->string('salary')->default(7000);

            $table->string('name', 11);
            $table->string('tmp_name', 11)->nullable();
            $table->string('personal_number', 11)->unique();
            $table->string('tmp_personal_number', 11)->nullable();
            $table->string('father_name', 50);
            $table->string('tmp_father_name', 50)->nullable();
            $table->string('mother_name', 50);
            $table->string('tmp_mother_name', 50)->nullable();
            $table->string('division', 20);
            $table->string('district', 20);
            $table->string('thana', 20);
            $table->longText('present_address');
            $table->longText('tmp_present_address')->nullable();
            $table->longText('permanent_address');
            $table->longText('tmp_permanent_address')->nullable();
            $table->enum('blood_group', ['a+','ab+','a-','ab-','b+','b-','o+','o-']);
            $table->string('tmp_blood_group')->nullable();
            $table->string('marital_status');
            $table->string('tmp_marital_status')->nullable();
            $table->string('gender');
            $table->date('dob');
            $table->date('tmp_dob')->nullable();
            $table->string('nid')->unique();
            $table->string('tmp_nid')->nullable()->unique();
            $table->string('employee_signature');

            $table->string('bank_name');
            $table->string('tmp_bank_name')->nullable();
            $table->string('brunch_name');
            $table->string('tmp_brunch_name')->nullable();
            $table->string('routing_number');
            $table->string('tmp_routing_number')->nullable();
            $table->string('account_number', 20)->nullable()->unique();
            $table->string('tmp_account_number', 20)->nullable();

            $table->string('education');
            $table->string('dbjsc')->nullable();
            $table->string('dbcsc')->nullable();
            $table->string('dbchc')->nullable();
            $table->string('mbcd')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('student_id')->nullable();
            $table->string('examination')->nullable();
            $table->string('board')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('session')->nullable();
            $table->string('institute_name')->nullable();
            $table->string('certificate_thana')->nullable();
            $table->string('roll_no')->nullable();
            $table->string('subject')->nullable();
            $table->string('division')->nullable();
            $table->string('gpa')->nullable();
            $table->string('dob_in_reg_card')->nullable();
            $table->string('month_of')->nullable();
            $table->string('issue_date')->nullable();
            $table->string('publish_date')->nullable();

            $table->string('status')->default(1);
            $table->string('remarks')->nullable();
            $table->string('document')->nullable();

            $table->date('joining_date');
            $table->date('resigning_date')->nullable();
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
        Schema::dropIfExists('rsos');
    }
};
