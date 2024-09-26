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
        Schema::table('conversations', function (Blueprint $table) {
            $table->string('ticket_no');
            $table->foreign('ticket_no')->references('ticket_no')->on('customer_enquires')->after('id');
            $table->text('message')->nullable();
            $table->enum('status',['read','unread','reply'])->default('unread');
            $table->unsignedBigInteger('reply_by')->nullable();
            $table->foreign('reply_by')->references('id')->on('users');
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
        Schema::table('conversations', function (Blueprint $table) {
            //
        });
    }
};
