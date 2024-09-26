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
        Schema::table('customer_enquires', function (Blueprint $table) {
            $table->dropColumn('message');
            $table->dropColumn('date');
            $table->dropColumn('reply');
            $table->dropColumn('reply_date');
            $table->dropColumn('status');
            $table->dropColumn('ticket_number');
            //$table->string('type')->nullable();
            //$table->enum('status',['open','close'])->default('open');
            $table->string('ticket_no')->unique();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_enquires', function (Blueprint $table) {
            //
        });
    }
};
