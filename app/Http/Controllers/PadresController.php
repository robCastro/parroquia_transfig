<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Padre;
use App\Bautismo;
use App\Confirma;
use App\Matrimonio;

class PadresController extends Controller
{
    public function index()
    {
    	$padres = Padre::all();
    	return view('pages.padres')->with('padres', $padres);
    }

    public function crear(Request $request){
		if ($request->isMethod('post')){
			if($request->has('txtNombre') && $request->has('txtApellido') && $request->txtNombre!="" && $request->txtApellido != ""){
				$padre = new Padre;
                $padre->nombre = $request->txtNombre;
                $padre->apellido = $request->txtApellido;
                if ($request->esObispoN == 'obispo'){
                    $padre->esObispo = true;
                }
                else{
                    $padre->esObispo = false;
                }
                if ($request->padreActualN){
                    $padre->padreActual = true;
                }
                else{
                    $padre->padreActual = false;
                }
                $padre->save();
				return response()->json([
					'codigo' => $padre->id,
                    'nombre' => $padre->nombre,
                    'apellido'=> $padre->apellido,
                    'tipo' => $padre->esObispo,
                    'actual' => $padre->padreActual,
					'mensaje' => 'Padre Guardado'
				]);
			}
			else{
				return response($content = 'Error, faltan datos', $status = 500);
			}
		}
		else{
			//Redirigir
			return redirect('padres');
		}
	}

    public function editar(Request $request){
		if ($request->isMethod('post')){
			if($request->has('txtEditarNombre') && $request->has('txtEditarApellido') && $request->txtEditarNombre != "" && $request->txtEditarApellido != ""){
				$padre = Padre::find($request->txtEditarCodigo);
                $padre->nombre = $request->txtEditarNombre;
                $padre->apellido = $request->txtEditarApellido;
                if ($request->esObispo == 'obispo'){
                    $padre->esObispo = true;
                }
                else{
                    $padre->esObispo = false;
                }
                if ($request->padreActual){
                    $padre->padreActual = true;
                }
                else{
                    $padre->padreActual = false;
                }
                $padre->save();
				return response()->json([
					'codigo' => $padre->id,
                    'nombre' => $padre->nombre,
                    'apellido'=> $padre->apellido,
                    'tipo' => $padre->esObispo,
                    'actual' => $padre->padreActual,
					'mensaje' => 'Cambios realizados'
				]);
			}
			else{
				return response($content = 'Error en datos, reintentar', $status = 500);
			}
		}
		else{
			//redireccionar
			return redirect('padres');
		}
    }
    
    public function eliminar(Request $request){
		if ($request->isMethod('post')){
			$padre = Padre::find($request->txtEliminarCodigo);
			$codigo=$request->txtEliminarCodigo;
			$cantBautismos = Bautismo::where('padre_id', '=', $padre->id)->count();
			$cantConfirmas = Confirma::where('padre_id', '=', $padre->id)->count();
			$cantMatrimonios = Matrimonio::where('padre_id', '=', $padre->id)->count();
			if($cantBautismos==0 && $cantConfirmas==0 && $cantMatrimonios==0){
				$valido=true;
			}
			else{
				$valido=false;
			}
			if($valido){
				$padre->delete();
				return response()->json([
					'codigo' => $codigo,
					'mensaje' => 'Padre Eliminado'
				]);
			}
			else{
				return response($content = 'Existen sacramentos realizados por este padre, no se puede eliminar ', $status = 500);
			}
		}
		else{
			//redireccionar
			return redirect('padres');
		}
	}
}
