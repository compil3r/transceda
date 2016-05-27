<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doacoes extends Model
{
    protected $table = 'doacoes';

    public function doador() {
    	return $this->belongsTo('App\User', 'idDoador');
    }

    public function recebedor() {
    	return $this->belongsTo('App\User', 'idRecebedor');
    }

    public function historia() {
    	return $this->belongsTo('App\Historias', 'idHistoria');
    }
}
