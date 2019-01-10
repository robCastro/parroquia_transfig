<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    public $timestamps = false;

	public function departamento(){
		return $this->belongsTo('App\Departamento');
	}

	public function personas(){
		return $this->hasMany('App\Persona');
	}

}