<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $timestamps = false;

	public function municipio(){
		return $this->belongsTo('App\Municipio', 'id_municipio');
	}

	public function nacionalidad(){
		return $this->belongsTo('App\Nacionalidad', 'id_nacionalidad');
	}

	public function bautismos(){
		return $this->hasMany('App\Bautismo');
	}

	public function matrimonios(){
		return $this->hasMany('App\Matrimonio');
	}

	public function confirmas(){
		return $this->hasMany('App\Confirma');
	}

}