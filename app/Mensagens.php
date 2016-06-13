<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensagens extends Model
{
    protected $table = 'mensagens';

      public function recebedor()
    {
        return $this->belongsTo('App\Users', 'idRecebedor');
    }
}
