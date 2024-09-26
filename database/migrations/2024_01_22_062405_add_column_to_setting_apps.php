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
        Schema::table('setting_apps', function (Blueprint $table) {
            $table->string('header')->nullable();
            $table->string('footer_left')->nullable();
            $table->string('footer_right')->nullable();
            $table->string('cc')->nullable();
            $table->string('Bcc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting_apps', function (Blueprint $table) {
            //
        });
    }
};
