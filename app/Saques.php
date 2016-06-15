<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saques extends Model
{
    protected $table = 'saques';

     public function historia()
    {
    	return $this->belongsTo('App\Historias', 'idHistoria');
    }
}
