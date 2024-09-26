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
        Schema::create('coupon_requests', function (Blueprint $table) {
            $table->id();
            $table->double('amount', 10, 2)->default(0.00);
            $table->integer('no_of_coupons');           
            $table->foreignId('product_id')->nullable()->references('id')->on('products');
            $table->foreignId('company_id')->nullable()->references('id')->on('companies');
            $table->text('description');
            $table->enum('status',['active', 'inactive'])->default('active'); 
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
        Schema::dropIfExists('coupon_requests');
    }
};
