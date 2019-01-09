<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Padre extends Model
{
    public $timestamps = false;
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