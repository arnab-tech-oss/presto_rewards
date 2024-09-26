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
        Schema::create('customer_enquires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers')->nullable();
            $table->string('subject')->nullable();
            $table->string('message')->nullable();
            $table->timestamp('date')->nullable();
            $table->enum('status',['read','unread','close'])->default('unread')->nullable();
            $table->longText('reply')->nullable();
            $table->date('reply_date')->nullable();
            $table->uuid('ticket_number')->nullable();
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
        Schema::dropIfExists('customer_enquires');
    }
};
