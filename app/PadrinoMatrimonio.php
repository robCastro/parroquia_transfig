<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PadrinoMatrimonio extends Model
{
    public $timestamps = false;
    protected $table = 'padrino_matrimonios';

    public function matrimonio(){
        return $this->belongsTo('App\Matrimonio');
    }

}