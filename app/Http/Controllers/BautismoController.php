<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Bautismo;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BautismoController extends Controller
{
    public function crear(Request $request, $id)
    {
        try{
            $persona = Persona::findOrFail((int)$id);
        }
        catch(ModelNotFoundException $e){
            //Redireccionar a detalle de persona
            return redirect(route('bautismo_crear',28));
        }
        $bautismo = Bautismo::where('persona_id', '=', $persona->id)->count();
        if($bautismo==1){
            //Redireccionar a detalle de persona
            return redirect(route('bautismo_crear',28));
        }

        return view('pages.bautismo_crear',compact("persona"));
    }
}
