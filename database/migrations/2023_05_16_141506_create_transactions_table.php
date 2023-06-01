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
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('quantity');
            $table->integer('sub_price');
            $table->integer('price');
            $table->string('payment_proof')->nullable();
            $table->foreignId('partner_id')->references('id')->on('partners')->onDelete('cascade');
            $table->integer('status')->nullable();
            $table->foreignId('admin_id')->references('id')->on('admins')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
