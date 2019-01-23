<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Padre;
use App\Bautismo;
use App\Confirma;
use App\Matrimonio;
use Illuminate\Validation\ValidationException;

class PadresController extends Controller
{
    public function index()
    {
    	$padres = Padre::all();
    	return view('pages.padres')->with('padres', $padres);
    }

    public function crear(Request $request){
		
		try{
		$rules=([
            'txtNombre' => ['required', 'string','max:255'],
            'txtApellido' => ['required', 'string', 'max:255'],
        ]);
		$this->validate($request,$rules);
		}
		catch (ValidationException $e) { 
			return response($content = 'Datos erroneos, reintentar.', $status = 500); 
		}
		
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
				$padreAnterior=Padre::where('padreActual', '=', true)->first();
				$padre->save();
				if ($padreAnterior->id != $padre->id && $padre->padreActual){
					$padreAnterior->padreActual=false;
				}
				$padreAnterior->save();
				return response()->json([
					'codigo' => $padre->id,
                    'nombre' => $padre->nombre,
                    'apellido'=> $padre->apellido,
                    'tipo' => $padre->esObispo,
                    'actual' => $padre->padreActual,
					'mensaje' => 'Padre Guardado.',
					'codigoAnterior' => $padreAnterior->id,
                    'nombreAnterior' => $padreAnterior->nombre,
                    'apellidoAnterior'=> $padreAnterior->apellido,
                    'tipoAnterior' => $padreAnterior->esObispo,
                    'actualAnterior' => $padreAnterior->padreActual
				]);
			}
			else{
				return response($content = 'Faltan datos', $status = 500);
			}
		}
		else{
			//Redirigir
			return redirect(route('padres'));
		}
	}

    public function editar(Request $request){
		try{
			$rules=([
				'txtEditarNombre' => ['required', 'string','max:255'],
				'txtEditarApellido' => ['required', 'string', 'max:255'],
			]);
			$this->validate($request,$rules);
			}
		catch (ValidationException $e) { 
			return response($content = 'Datos erroneos, reintentar.', $status = 500); 
		}
		if ($request->isMethod('post')){
			if($request->has('txtEditarNombre') && $request->has('txtEditarApellido') && $request->txtEditarNombre != "" && $request->txtEditarApellido != ""){
				$mensaje="Cambios realizados.";
				$padre = Padre::find($request->txtEditarCodigo);
                $padre->nombre = $request->txtEditarNombre;
				$padre->apellido = $request->txtEditarApellido;
				$actual=$padre->padreActual;
                if ($request->esObispo == 'obispo'){
                    $padre->esObispo = true;
                }
                else{
                    $padre->esObispo = false;
				}
				
				$cantActuales=Padre::where('padreActual', '=', true)->count();
				
			
				if ($request->padreActual){
						$padre->padreActual = true;
				}
				else{
						if($actual and $cantActuales==1){
							$padre->padreActual = true;
							$mensaje="Cambios realizados, para desmarcar el padre actual debe seleccionar otro.";
						}
						else{
							$padre->padreActual = false;
						}
				}

				$padreAnterior=Padre::where('padreActual', '=', true)->first();
				$padre->save();
				if ($padreAnterior->id != $padre->id && $padre->padreActual){
					$padreAnterior->padreActual=false;
				}
				$padreAnterior->save();
				return response()->json([
					'codigo' => $padre->id,
                    'nombre' => $padre->nombre,
                    'apellido'=> $padre->apellido,
                    'tipo' => $padre->esObispo,
                    'actual' => $padre->padreActual,
					'mensaje' => $mensaje,
					'codigoAnterior' => $padreAnterior->id,
                    'nombreAnterior' => $padreAnterior->nombre,
                    'apellidoAnterior'=> $padreAnterior->apellido,
                    'tipoAnterior' => $padreAnterior->esObispo,
                    'actualAnterior' => $padreAnterior->padreActual
				]);
			}
			else{
				return response($content = 'Faltan datos.', $status = 500);
			}
		}
		else{
			//redireccionar
			return redirect(route('padres'));
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
					'mensaje' => 'Padre Eliminado.'
				]);
			}
			else{
				return response($content = 'Existen sacramentos realizados por este padre, no se puede eliminar.', $status = 500);
			}
		}
		else{
			//redireccionar
			return redirect(route('padres'));
		}
	}
}
