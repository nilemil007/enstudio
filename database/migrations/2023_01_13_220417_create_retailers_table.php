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
        Schema::create('retailers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('dd_house_id')->constrained();
            $table->foreignId('supervisor_id')->constrained();
            $table->foreignId('rso_id')->constrained();
            $table->foreignId('bts_id')->nullable()->constrained();
            $table->foreignId('route_id')->constrained();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('tmp_name')->nullable();
            $table->string('type');
            $table->string('tmp_type')->nullable();
            $table->string('enabled');
            $table->string('sim_seller');
            $table->string('tmp_sim_seller')->nullable();
            $table->string('itop_number')->unique();
            $table->string('service_point');
            $table->string('owner_name');
            $table->string('tmp_owner_name')->nullable();
            $table->string('contact_no')->unique();
            $table->string('tmp_contact_no')->nullable()->unique();
            $table->string('own_shop');
            $table->string('district');
            $table->string('thana');
            $table->string('tmp_thana')->nullable();
            $table->string('address');
            $table->string('tmp_address')->nullable();
            $table->enum('blood_group', ['a+','ab+','a-','ab-','b+','b-','o+','o-']);
            $table->string('nid')->unique();
            $table->string('tmp_nid')->nullable()->unique();
            $table->string('trade_license_no')->nullable();
            $table->string('tmp_trade_license_no')->nullable();
            $table->json('others_operator')->nullable();
            $table->json('tmp_others_operator')->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->string('tmp_longitude')->nullable();
            $table->decimal('latitude', 10, 6)->nullable();
            $table->string('tmp_latitude')->nullable();
            $table->string('device_name')->nullable();
            $table->string('tmp_device_name')->nullable();
            $table->string('device_sn')->nullable()->unique();
            $table->string('tmp_device_sn')->nullable()->unique();
            $table->string('scanner_sn')->nullable()->unique();
            $table->string('tmp_scanner_sn')->nullable()->unique();
            $table->string('image')->nullable();
            $table->string('nid_upload')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->default(1);
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('retailers');
    }
};
