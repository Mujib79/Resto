<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id')->sign();
            $table->string("NIP",6)->unique();
            $table->string("nama",30);
            $table->string("jabatan",7);
            $table->enum('kelamin',['P','W']);
            $table->date('masuk');
            $table->string('telepon',13)->nullable();
            $table->text('alamat')->nullable();
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
