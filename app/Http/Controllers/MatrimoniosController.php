<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Persona;
use App\Matrimonio;
use App\PadrinoMatrimonio;
use App\Padre;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MatrimoniosController extends Controller
{
    public function nuevo($id = ""){
    	$padres = Padre::all();
    	return view('pages.crear_matrimonio', compact("padres"));
    }

    public function eliminar(Request $request){
        if($request->has("idPersona")){
            $idPersona = $request->idPersona;
        }
        else{
            return redirect('lista_personas');
        }
        $cantEliminados = Matrimonio::where('esposo_id', $idPersona)->orWhere('esposa_id', $idPersona)->delete();
        return response($content = "Eliminado", $status=200);
    }

    public function detalle($idPersona){
    	$matrimonio = Matrimonio::where("esposo_id", $idPersona)->orWhere("esposa_id", $idPersona)->first();
        try{
            $esposo = Persona::find($matrimonio->esposo_id);
            $esposa = Persona::find($matrimonio->esposa_id);
        }
        catch(\ErrorException $e){
            //catch en caso que matrimonio sea null
            return redirect('lista_personas');
        }
        //se envia idPersona para hacer links a detalle persona
    	return view('pages.detalle_matrimonio', compact("matrimonio", "esposo", "esposa", "idPersona"));
    }

    public function guardar(Request $request){
    	if($request->isMethod('POST') ){
    		if ($request->has("idEsposo") && $request->has("idEsposa") && $request->has("fecha") && $request->has("fecha") && $request->has("padre") && $request->has("libro") && $request->has("folio")){
    			
    			$matrimonio = new Matrimonio;
    			$matrimonio->esposo_id = $request->idEsposo;
    			$matrimonio->esposa_id = $request->idEsposa;
    			$matrimonio->padre_id = $request->padre;


    			$matrimonio->fecha = $request->fecha;
    			$matrimonio->libro = $request->libro;
    			$matrimonio->folio = $request->folio;


    			$matrimonio->save();

    			$arrayPadrinos = explode("(&&)", $request->padrinos);

    			for ($i=0; $i < (int)$request->cantPadrinos; $i++) { 
    				$columnasPadrino = explode("(//)", $arrayPadrinos[$i]);
    				$padrino = new PadrinoMatrimonio;
    				$padrino->nombre = $columnasPadrino[0];
    				$padrino->apellido = $columnasPadrino[1];
    				$padrino->sexo = $columnasPadrino[2] == "Masculino";
    				$padrino->matrimonio_id = $matrimonio->id;
    				$padrino->save();
    			}
    			//Se retorna el id del esposo porque el matrimonio es obtenido en base a id de persona
    			return response($content = "". $matrimonio->esposo_id, $status = 200);
    		}
    		else{
    			return response($content = "Faltan datos, favor verificar", $status = 500);
    		}
    	}
    	else{
    		return redirect('lista_personas');
    	}
    }
}
