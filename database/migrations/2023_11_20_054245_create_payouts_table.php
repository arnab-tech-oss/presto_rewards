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
    public function up()
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no')->nullable();
            $table->unsignedBigInteger('cus_id')->nullable();
            $table->foreign('cus_id')->references('id')->on('customers');
            $table->double('amount', 8,2);
            $table->enum('payment_type',['upi','bank']);
            $table->string('upi_id')->nullable();
            $table->string('bank_ac')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('phone')->nullable();
            $table->string('customer_name')->nullable();
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
        Schema::dropIfExists('payouts');
    }
};
