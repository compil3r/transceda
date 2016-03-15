<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidades extends Model
{
    protected $table = 'cidade';

    public function estado() {
    	$this->belongsTo('App\Estados', 'idEstado');
    }
}
