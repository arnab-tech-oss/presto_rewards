<?php

use Doctrine\DBAL\Schema\Table;
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
        Schema::table('payout_transactions', function (Blueprint $table) {
            $table->dropColumn('cus_id');
            $table->foreignId('payout_id')->references('id')->on('payouts');
            $table->string('transaction_no')->nullable();
            $table->string('message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payout_transactions', function (Blueprint $table) {
            //
        });
    }
};
