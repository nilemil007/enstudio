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

            $table->string('rso_code');
            $table->string('itop_number', 11);
            $table->string('pool_number', 11);
            $table->string('sr_no');
            $table->enum('residential_rso', ['yes','no']);

            $table->date('date');
            $table->string('rid')->unique();
            $table->string('name', 11);
            $table->string('father_name', 50);
            $table->string('mother_name', 50);
            $table->string('division', 20);
            $table->string('district', 20);
            $table->string('thana', 20);
            $table->longText('present_address');
            $table->longText('permanent_address');
            $table->string('witness_name');
            $table->string('witness_number', 11)->unique();
            $table->string('salary')->default(7000);
            $table->string('employee_signature');

            $table->string('personal_number', 11)->unique();
            $table->date('dob');
            $table->string('nid')->unique();
            $table->enum('blood_group', ['a+','ab+','a-','ab-','b+','b-','o+','o-']);
            $table->string('marital_status');
            $table->string('nationality');
            $table->string('religion');
            $table->string('gender');
            $table->string('place_of_birth');
            $table->string('rso_image');

            $table->string('education');
            $table->string('serial_number')->nullable();
            $table->string('dbjsc')->nullable();
            $table->string('dbcsc')->nullable();
            $table->string('dbchc')->nullable();
            $table->string('mbcd')->nullable();
            $table->string('student_id')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('board')->nullable();
            $table->string('session')->nullable();
            $table->string('examination')->nullable();
            $table->string('institute_name')->nullable();
            $table->string('certificate_thana')->nullable();
            $table->string('roll_no')->nullable();
            $table->string('subject')->nullable();
            $table->string('edu_division')->nullable();
            $table->string('gpa')->nullable();
            $table->string('dob_in_reg_card')->nullable();
            $table->string('month_of')->nullable();
            $table->string('issue_date')->nullable();
            $table->string('publish_date')->nullable();

            $table->string('bank_name');
            $table->string('brunch_name');
            $table->string('routing_number');
            $table->string('account_number', 20)->nullable()->unique();

            $table->string('nominee_name', 100);
            $table->string('nominee_relation', 20);
            $table->string('nominee_contact_no', 11)->unique();
            $table->string('nominee_address');
            $table->string('rso_name_bangla', 100);
            $table->date('nominee_dob');
            $table->string('nominee_nid')->unique();
            $table->string('nominee_image');
            $table->string('nominee_signature');
            $table->string('nominee_witness_name');
            $table->string('nominee_witness_designation');
            $table->string('nominee_witness_signature');

            $table->string('status')->default(1);
            $table->string('remarks')->nullable();
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
    public function down(): void
    {
        Schema::dropIfExists('rsos');
    }
};
