<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias', function(Blueprint $table){
            $table->increments('id');
            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users');
            $table->string('nomeSocial');
            $table->date('aniversario');
            $table->string('endereco', 100);
            $table->string('bairro', 50);
            $table->string('cep', 50);
            $table->integer('idCidade')->unsigned();
            $table->foreign('idCidade')->references('id')->on('cidade');
            $table->integer('idEstado')->unsigned();
            $table->foreign('idEstado')->references('id')->on('estado');
            $table->string('meta');
            $table->string('objetivo');
            $table->longText('descricao');
            $table->string('imagem');
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
        Schema::drop('historias');
    }
}
