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
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers')->nullable();
            $table->string('whatsapp_availability')->default('0')->nullable();
            $table->string('last_login')->nullable();
            $table->string('mobile_id')->nullable();
            $table->string('app_version')->nullable();
            $table->string('language')->nullable();
            $table->enum('notification_setting',['on','off'])->default('on');
            $table->enum('location_setting',['on','off'])->default('on');
            $table->enum('theme_preference',['dark','light'])->default('light');
            $table->enum('apptour_status',['yes','no'])->nullable();
            $table->string('preffered_currancy')->nullable();
            $table->enum('biometric_auth',['enable','disable'])->nullable();
            $table->enum('mpin_auth',['enable','disable'])->nullable();
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
        Schema::dropIfExists('app_settings');
    }
};
