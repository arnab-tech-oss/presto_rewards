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
            $table->string('beta_url')->nullable();
            $table->string('playstore_url')->nullable();
            $table->string('appstore_url')->nullable();
            $table->string('dark_logo')->nullable();
            $table->string('favicon_logo')->nullable();
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
