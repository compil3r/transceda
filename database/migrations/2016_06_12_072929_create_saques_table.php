<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idHistoria')->unsigned();
            $table->foreign('idHistoria')->references('id')->on('historias');
            $table->string('titular');
            $table->string('conta');
            $table->string('banco');
            $table->decimal('valor');
            $table->string('agencia');
            $table->integer('status');
            $table->string('operacao');
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
        Schema::drop('saques');    
    }
}
