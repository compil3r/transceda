<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    protected $table = 'comentarios';

   	public function autor(){
   		return $this->belongsTo('App\User', 'idUsuario');
   	}

   	public function historia() {
   		return $this->belongsTo('App\Historia', 'idHistoria');
   	}
}
