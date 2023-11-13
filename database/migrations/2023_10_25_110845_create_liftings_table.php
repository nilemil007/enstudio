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
            $table->integer('mmst')->nullable();
            $table->integer('mmst_lifting_price')->nullable();
            $table->integer('mmst_amount')->nullable();
            $table->integer('mmst_remarks')->nullable();
            $table->integer('mmsts')->nullable();
            $table->integer('mmsts_lifting_price')->nullable();
            $table->integer('mmsts_amount')->nullable();
            $table->integer('mmsts_remarks')->nullable();
            $table->integer('sim_swap')->nullable();
            $table->integer('sim_swap_lifting_price')->nullable();
            $table->integer('sim_swap_amount')->nullable();
            $table->integer('sim_swap_remarks')->nullable();
            $table->integer('sim_swap_ev')->nullable();
            $table->integer('sim_swap_ev_lifting_price')->nullable();
            $table->integer('sim_swap_ev_amount')->nullable();
            $table->integer('sim_swap_ev_remarks')->nullable();
            $table->integer('total_sim_amount')->nullable();
            $table->integer('sc_10')->nullable();
            $table->integer('sc_10_lifting_price')->nullable();
            $table->integer('sc_10_amount')->nullable();
            $table->integer('sc_10_lifting_amount')->nullable();
            $table->integer('sc_10_remarks')->nullable();
            $table->integer('sc_14')->nullable();
            $table->integer('sc_14_lifting_price')->nullable();
            $table->integer('sc_14_amount')->nullable();
            $table->integer('sc_14_lifting_amount')->nullable();
            $table->integer('sc_14_remarks')->nullable();
            $table->integer('scd_14')->nullable();
            $table->integer('scd_14_lifting_price')->nullable();
            $table->integer('scd_14_amount')->nullable();
            $table->integer('scd_14_lifting_amount')->nullable();
            $table->integer('scd_14_remarks')->nullable();
            $table->integer('sc_19')->nullable();
            $table->integer('sc_19_lifting_price')->nullable();
            $table->integer('sc_19_amount')->nullable();
            $table->integer('sc_19_lifting_amount')->nullable();
            $table->integer('sc_19_remarks')->nullable();
            $table->integer('scd_19')->nullable();
            $table->integer('scd_19_lifting_price')->nullable();
            $table->integer('scd_19_amount')->nullable();
            $table->integer('scd_19_lifting_amount')->nullable();
            $table->integer('scd_19_remarks')->nullable();
            $table->integer('sc_20')->nullable();
            $table->integer('sc_20_lifting_price')->nullable();
            $table->integer('sc_20_amount')->nullable();
            $table->integer('sc_20_lifting_amount')->nullable();
            $table->integer('sc_20_remarks')->nullable();
            $table->integer('scd_29')->nullable();
            $table->integer('scd_29_lifting_price')->nullable();
            $table->integer('scd_29_amount')->nullable();
            $table->integer('scd_29_lifting_amount')->nullable();
            $table->integer('scd_29_remarks')->nullable();
            $table->integer('total_sc_amount')->nullable();
            $table->integer('router')->nullable();
            $table->integer('router_lifting_price')->nullable();
            $table->integer('router_amount')->nullable();
            $table->integer('router_remarks')->nullable();
            $table->integer('itopup')->nullable();
            $table->integer('bank_deposit')->nullable();

//            $table->string('product_type');
//            $table->string('product');
//            $table->string('qty')->nullable();
//            $table->string('price')->nullable();
//            $table->string('lifting_price')->nullable();
//            $table->string('product_lifting_price')->nullable();
//            $table->string('itopup')->nullable();
//            $table->string('bank_deposit')->nullable();
//            $table->date('lifting_date');
//            $table->string('remarks')->default('Cash');
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
