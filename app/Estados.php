<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $table = 'estado';

    public function cidades() {

    	return $this->hasMany('App\Cidades', 'idEstado');
    }
}
