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
        Schema::create('date_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->references('id')->on('partners')->onDelete('cascade');
            $table->string('transaction_id');
            $table->date('date_start');
            $table->date('date_end');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
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
        Schema::dropIfExists('date_status');
    }
};
