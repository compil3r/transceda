<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historias extends Model
{
    protected $table = 'historias';
  
    protected $rules = [
    'idUser' => 'unique:historia'
    ];
    
    public function autor()
    {
    	return $this->belongsTo('App\User', 'idUser');
    }
    

}
 