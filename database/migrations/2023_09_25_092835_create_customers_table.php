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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email_id')->nullable();
            $table->string('phone_number',13)->unique();
            $table->string('passcode')->nullable();
            $table->string('password')->nullable();
            // $table->unsignedBigInteger('role_id')->nullable();
            // $table->foreign('role_id')->references('id')->on('roles');
            // $table->enum('role_type',['customer','shopkeeper','distributor','technician'])->default('customer');
            //$table->string('whatsapp_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
