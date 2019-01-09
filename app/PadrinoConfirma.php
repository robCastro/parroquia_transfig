<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PadrinoConfirma extends Model
{
    public $timestamps = false;
    protected $table = 'padrino_confirmas';
}

public function confirma(){
	return $this->belongsTo('App\Confirma');
}
