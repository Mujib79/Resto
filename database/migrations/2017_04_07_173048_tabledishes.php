<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tabledishes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->increments('no_hidangan')->sign();
            $table->string('nama_hidangan',25);
            $table->string('kode_tipe',3);
            $table->integer('harga');
            $table->binary('image')->nullable();
            $table->boolean('status');
            $table->string('NIP',6)->nullable();
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
        Schema::dropIfExists('dishes');
    }
}
