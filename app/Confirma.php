<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirma extends Model
{
    public $timestamps = false;

	public function persona(){
		return $this->belongsTo('App\Persona');
	}

	public function padrinos(){
		return $this->hasMany('App\PadrinoConfirma');
	}

	public function padre(){
		return $this->belongsTo('App\Padre');
	}

}
