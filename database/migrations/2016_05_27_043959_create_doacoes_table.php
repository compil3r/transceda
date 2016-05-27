<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('doacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idDoador')->unsigned();
            $table->foreign('idDoador')->references('id')->on('users');
            $table->integer('idHistoria')->unsigned();
            $table->foreign('idHistoria')->references('id')->on('historias');
            $table->integer('idRecebedor')->unsigned();
            $table->foreign('idRecebedor')->references('id')->on('users');
            $table->string('valor');
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
        //
    }
}
