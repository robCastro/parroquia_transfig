<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    public $timestamps = false;
    protected $table = 'nacionalidades';

    public function personas(){
        return $this->hasMany('App\Persona');
    }

}
