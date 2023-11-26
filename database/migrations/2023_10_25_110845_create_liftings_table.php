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
        Schema::create('liftings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dd_house_id')->constrained();
            $table->string('mmst')->nullable();
            $table->string('mmst_lifting_price')->nullable();
            $table->string('mmst_amount')->nullable();
            $table->string('mmst_remarks')->nullable();
            $table->string('mmsts')->nullable();
            $table->string('mmsts_lifting_price')->nullable();
            $table->string('mmsts_amount')->nullable();
            $table->string('mmsts_remarks')->nullable();
            $table->string('sim_swap')->nullable();
            $table->string('sim_swap_lifting_price')->nullable();
            $table->string('sim_swap_amount')->nullable();
            $table->string('sim_swap_remarks')->nullable();
            $table->string('sim_swap_ev')->nullable();
            $table->string('sim_swap_ev_lifting_price')->nullable();
            $table->string('sim_swap_ev_amount')->nullable();
            $table->string('sim_swap_ev_remarks')->nullable();
            $table->string('total_sim_amount')->nullable();
            $table->string('sc_10')->nullable();
            $table->string('sc_10_lifting_price')->nullable();
            $table->string('sc_10_amount')->nullable();
            $table->string('sc_10_lifting_amount')->nullable();
            $table->string('sc_10_remarks')->nullable();
            $table->string('sc_14')->nullable();
            $table->string('sc_14_lifting_price')->nullable();
            $table->string('sc_14_amount')->nullable();
            $table->string('sc_14_lifting_amount')->nullable();
            $table->string('sc_14_remarks')->nullable();
            $table->string('scd_14')->nullable();
            $table->string('scd_14_lifting_price')->nullable();
            $table->string('scd_14_amount')->nullable();
            $table->string('scd_14_lifting_amount')->nullable();
            $table->string('scd_14_remarks')->nullable();
            $table->string('sc_19')->nullable();
            $table->string('sc_19_lifting_price')->nullable();
            $table->string('sc_19_amount')->nullable();
            $table->string('sc_19_lifting_amount')->nullable();
            $table->string('sc_19_remarks')->nullable();
            $table->string('scd_19')->nullable();
            $table->string('scd_19_lifting_price')->nullable();
            $table->string('scd_19_amount')->nullable();
            $table->string('scd_19_lifting_amount')->nullable();
            $table->string('scd_19_remarks')->nullable();
            $table->string('sc_20')->nullable();
            $table->string('sc_20_lifting_price')->nullable();
            $table->string('sc_20_amount')->nullable();
            $table->string('sc_20_lifting_amount')->nullable();
            $table->string('sc_20_remarks')->nullable();
            $table->string('scd_29')->nullable();
            $table->string('scd_29_lifting_price')->nullable();
            $table->string('scd_29_amount')->nullable();
            $table->string('scd_29_lifting_amount')->nullable();
            $table->string('scd_29_remarks')->nullable();
            $table->string('total_sc_amount')->nullable();
            $table->string('total_sc_lifting_amount')->nullable();
            $table->string('router')->nullable();
            $table->string('router_price')->nullable();
            $table->string('router_lifting_price')->nullable();
            $table->string('router_amount')->nullable();
            $table->string('router_lifting_amount')->nullable();
            $table->string('router_remarks')->nullable();
            $table->string('total_device_amount')->nullable();
            $table->string('total_device_lifting_amount')->nullable();
            $table->string('itopup')->nullable();
            $table->string('itopup_remarks')->nullable();
            $table->integer('bank_deposit');
            $table->timestamp('lifting_date')->useCurrent()->default(now());
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liftings');
    }
};
