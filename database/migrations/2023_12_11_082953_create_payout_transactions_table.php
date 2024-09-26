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
        Schema::create('payout_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('cus_id')->nullable();
            $table->string('ref_no')->nullable();
            $table->string('bank_ref')->nullable();
            $table->string('amount')->nullable();
            $table->enum('status',['approved','pending','rejected'])->default('pending');
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
        Schema::dropIfExists('payout_transactions');
    }
};
