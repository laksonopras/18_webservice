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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('partner_name');
            $table->string('address');
            $table->string('avatar')->nullable();
            $table->float('coordinate');
            $table->string('description');
            $table->integer('count_order')->default(0);
            $table->integer('account_status')->default(0);     // Status 0 karena belum aktivasi akun (belum bayar) 
            $table->integer('operational_status')->default(0); // Status 0 karena toko sedang tutup
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('partners');
    }
};
