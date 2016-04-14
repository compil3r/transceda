 <?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cpf')->unique();
            $table->string('password', 60);
            $table->date('aniversario');
            $table->string('endereco', 100);
            $table->string('bairro', 50);
            $table->string('cep', 50);
            $table->integer('idCidade')->unsigned();
            $table->foreign('idCidade')->references('id')->on('cidade');
            $table->integer('idEstado')->unsigned();
            $table->foreign('idEstado')->references('id')->on('estado');
            $table->string('imagem');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
