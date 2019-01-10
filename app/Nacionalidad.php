<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    public $timestamps = false;

    public function personas(){
        return $this->hasMany('App\Persona');
    }

}
