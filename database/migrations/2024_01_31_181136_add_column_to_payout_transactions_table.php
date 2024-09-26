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
        Schema::table('payout_transactions', function (Blueprint $table) {
            //$table->string('message')->nullable();
            $table->string('bankrrn')->nullable();
            $table->string('upitranlog_id')->nullable();
            $table->string('seq_no')->nullable();
            $table->string('mobileappdata')->nullable();

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
