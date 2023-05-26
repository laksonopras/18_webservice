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
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address');
            $table->string('avatar')->nullable();
            $table->float('coordinate');
            $table->string('description');
            $table->integer('count_order')->default(0);
            $table->integer('account_status')->default(0);     // Status 0 karena belum aktivasi akun (belum bayar) 
            $table->integer('operational_status')->default(0); // Status 0 karena toko sedang tutup
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->string('token')->unique()->nullable();
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
