<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PadrinoBautismo extends Model
{
    public $timestamps = false;
    protected $table = 'padrino_bautismos';
}

public function bautismo(){
	return $this->belongsTo('App\Bautismo');
}