<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Redirect;
use DataTables;
use App\Persona;
use App\Matrimonio;
use App\Bautismo;
use App\Confirma;
use App\Nacionalidad;
use App\Departamento;
use App\Municipio;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class PersonasController extends Controller
{
    public function listar(){
    	/*$personas = Persona::withCount(['bautismos', 'confirmas'])->get();
    	foreach ($personas as $persona) {
    		$conteoMatrimonios = Matrimonio::where('esposo_id', $persona->id)->orWhere('esposa_id', $persona->id)->count();
    		$persona->casada = $conteoMatrimonios > 0;
    	}*/
    	$personas = Persona::all();
    	return view('pages.lista_personas', compact("personas"));
    }

    public function hombresNoCasados(Request $request){
        if($request->has('term')){
            $nombre = $request->term;
        }
        else{
            $nombre = "";
        }
        if (!$request->has("sexo") || $request->sexo == ""){
            $request->sexo = "M";
        }
        $codigosCasadas = DB::table('matrimonios')->select('esposa_id as persona_id');
        $codigosCasados = DB::table('matrimonios')->select('esposo_id as persona_id')->union($codigosCasadas)->get();
        if ($nombre != ""){
            //$personas = Persona::all()->where('sexo', true)->where('nombre', 'like', '%' . $nombre . '%');
            //$personas = DB::table('personas')->where('sexo', $request->sexo == "M")->where('nombre', 'ilike', '%' . $nombre . '%')->orWhere('apellido', 'ilike', '%' . $nombre . '%');
            $personas = DB::table('personas')->where('sexo', $request->sexo == "M")->where(function ($query) use($nombre){
                $query->where('nombre', 'ilike', '%' . $nombre . '%')->orWhere('apellido', 'ilike', '%' . $nombre . '%');
            });
        }
        else{
            //$personas = Persona::all()->where('sexo', true);
            $personas = DB::table('personas')->where('sexo', $request->sexo == "M");
        }
        if ($codigosCasados->isNotEmpty()){
            $personas = $personas->get()->whereNotIn('id', array_column($codigosCasados->toArray(), 'persona_id'));
        }
        /*

        El plugin de autocomplete requiere de cierto formato especifico para mostrar el autocompletado
        El formato que se está dando acá está basado en 

        https://stackoverflow.com/questions/5905560/jquery-autocomplete-remote-example

        Consiste en un array de 2 dimensiones que posteriormente es transformado a JSON.

        */
        $arrayPersonas = array();
        //Dentro del for each algunas veces requiere $personas->get() y otras veces solo $personas
        foreach ($personas->get() as $persona) {

            array_push($arrayPersonas, array(
                'label' => $persona->nombre . " " . $persona->apellido,
                'value' => $persona->id,
            ));
        }
        return response()->json($arrayPersonas);
    }

    public function create(){
    	$paises = Nacionalidad::all();
    	$departamentos = Departamento::all();
    	//pk = 6 corresponde a San Salvador, podria dar error si las tablas catalogo no están llenas
    	$municipios = Departamento::find(6)->municipios()->get();
        return view('pages.crear_persona', compact("paises", "departamentos", "municipios"));
    }

    public function consultarSacramentos(Request $request){
    	if($request->has('codPersona') && $request->codPersona != ""){
    		try{
    			$persona = Persona::findOrFail((int)$request->codPersona);
    		}
    		catch(ModelNotFoundException $e){
    			return response($content = "Error en consulta de persona, refresque e intente de nuevo", $status = 500);
    		}
    		$cantBautismos = $persona->bautismos()->count();
    		$cantConfirmas = $persona->confirmas()->count();
    		$cantMatrimonios = Matrimonio::where('esposo_id', $persona->id)->orWhere('esposa_id', $persona->id)->count();
    		return response()->json([
				'cantBautismos' => $cantBautismos,
				'cantConfirmas' => $cantConfirmas,
				'cantMatrimonios' => $cantMatrimonios,
			]);
    	}
    	else
    		return response($content = "Error en consulta de persona, refresque e intente de nuevo", $status = 500);
    }

    public function filtrarMunicipios(Request $request){
    	if($request->has('codDepartamento') && $request->codDepartamento != ""){
    		$municipios = Municipio::where('departamento_id', $request->codDepartamento)->get();
    		return response()->json([
				'municipios' => $municipios
			]);
    	}
    	else{
    		return response($content = "Error en especificacion de departamento, intente de nuevo", $status = 500);
    	}
    }

    public function guardarPersona(Request $request){
    	if ($request->isMethod('POST')){
    		$mensaje = "Errores encontrados:";
    		$nombreValido = False;
    		$apellidoValido = False;
    		$fechaValida = False;
    		$papaValido = False;
    		$mamaValida = False;
    		$sexoValido = False;
    		$paisValido = False;
    		$muniValido = False;
			if($request->has('nombre') && $request->nombre!="")
				$nombreValido = True;
			else
				$mensaje = $mensaje . " Nombre no especificado.";
			if($request->has('apellido') && $request->apellido!="")
				$apellidoValido = True;
			else
				$mensaje = $mensaje . " Apellido no especificado.";
			if($request->has('fechaNac') && $request->fechaNac!="")
				$fechaValida = True;
			else
				$mensaje = $mensaje . " Fecha de nacimiento no especificada.";
			if($request->has('papa') && $request->papa!="")
				$papaValido = True;
			else
				$mensaje = $mensaje . " Nombre de Papá no especificado.";
			if($request->has('mama') && $request->mama!="")
				$mamaValida = True;
			else
				$mensaje = $mensaje . " Nombre de Mamá no especificado.";
			if($request->has('sexo'))
				$sexoValido = True;
			else
				$mensaje = $mensaje . " Sexo no especificado.";
			if($request->has('pais') && $request->pais!="")
				$paisValido = True;
			else
				$mensaje = $mensaje . " Pais no especificado.";
			if($request->has('municipio') && $request->municipio!="")
				$muniValido = True;
			else
				$mensaje = $mensaje . " Municipio no especificado.";

			if ($nombreValido && $apellidoValido && $fechaValida && $papaValido && $mamaValida && $sexoValido && $paisValido && $muniValido){
				$persona = new Persona;
				$persona->nombre = $request->nombre;
				$persona->apellido = $request->apellido;
				$persona->fechanac = $request->fechaNac;
				$persona->papa = $request->papa;
				$persona->mama = $request->mama;
				$persona->sexo = $request->sexo == "true";
				//AJAX envia los booleans como texto
				$persona->id_nacionalidad = $request->pais;
				if($request->pais == 54){
					$persona->id_municipio = $request->municipio;
				}
				$persona->save();
				if($request->tipoGuardado == "btnGuardarR"){
					return response($content = 'Registro guardado correctamente.', $status = 200);
				}
				else{
					//Reemplazar con redireccionar a detalle
					//return response($content = "Registro guardado correctamente. (Reemplazar con redireccionar a detalle).", $status = 200);
                    //return redirect()->route('detalle_persona', ['id' => $persona->id]);
                    return response($content = 'Nuevo id:'.$persona->id, $status=200);
                    //se revisa el string en front, se hace un split para sacar el id y redireccionar a 
                    //detalle de persona
				}
			}
			else{
				return response($content = $mensaje, $status = 500);
			}
		}
		else{
			//Redirigir a crear persona
			return redirect('crear_persona');
		}
    }

    public function eliminar(Request $request){
    	if($request->isMethod("POST")){
    		if($request->has('codPersona') && $request->codPersona != ""){
    			$bauEliminados = Bautismo::where('persona_id', $request->codPersona)->delete();
    			$confEliminadas = Confirma::where('persona_id', $request->codPersona)->delete();
    			$matrEliminados = Matrimonio::where('esposo_id', $request->codPersona)->orWhere('esposa_id', $request->codPersona)->delete();
    			//Padrinos se eliminan en cascada
    			$persona = Persona::destroy($request->codPersona);
    			return response($content = "Eliminado correctamente", $status = 200);
    		}
    		else{
    			return response($content = "Error en consulta de persona, refresque e intente de nuevo", $status = 500);
    		}
    	}
    	else{
    		return redirect('lista_personas');
    	}
    }

    public function detalle(Request $request, $id){
        if($id != ""){
            try{
                $persona = Persona::findOrFail((int)$id);
            }
            catch(ModelNotFoundException $e){
                return redirect('lista_personas');
            }
            $salvadorenio = True;
            try{
                $persona->municipio->nombre;
                //probando acceso para verificar y no ser llamado en vista
            }
            catch(\ErrorException $e){
                //Pleca invertida para que no busque clase en mi namespace
                $salvadorenio = False;
            }
            $matrimonio = Matrimonio::where('esposo_id', $persona->id)->orWhere('esposa_id', $persona->id)->first();
            return view('pages.detalle_persona', compact("persona", "salvadorenio", "matrimonio"));
        }
        else{
            return redirect('lista_personas');
        }
    }

    public function edit(Request $request, $id){
        if($id != ""){
            try{
                $persona = Persona::findOrFail((int)$id);
            }
            catch(ModelNotFoundException $e){
                return redirect('lista_personas');
            }
            $salvadorenio = True;
            try{
                //probando acceso para verificar y no ser llamado en vista
                $persona->municipio->nombre;
            }
            catch(\ErrorException $e){
                //Pleca invertida para que no busque clase en mi namespace
                $salvadorenio = False;
            }
            $paises = Nacionalidad::all();
            $departamentos = Departamento::all();
            if($salvadorenio){
                $municipios = Departamento::find($persona->municipio->departamento->id)->municipios()->get();
            }
            else{
                $municipios = Departamento::find(6)->municipios()->get();
            }
            
            return view('pages.editar_persona', compact("persona", "salvadorenio", "paises", "departamentos", "municipios"));
        }
        else{
            return redirect('lista_personas');
        }
    }

    public function guardarEdit(Request $request){
        if ($request->isMethod('POST') && $request->has('id') && $request->id != ""){
            try{
                $persona = Persona::findOrFail((int)$request->id);
            }
            catch(ModelNotFoundException $e){
                return redirect('lista_personas');
            }
            $mensaje = "Errores encontrados:";
            $nombreValido = False;
            $apellidoValido = False;
            $fechaValida = False;
            $papaValido = False;
            $mamaValida = False;
            $sexoValido = False;
            $paisValido = False;
            $muniValido = False;
            if($request->has('nombre') && $request->nombre!="")
                $nombreValido = True;
            else
                $mensaje = $mensaje . " Nombre no especificado.";
            if($request->has('apellido') && $request->apellido!="")
                $apellidoValido = True;
            else
                $mensaje = $mensaje . " Apellido no especificado.";
            if($request->has('fechaNac') && $request->fechaNac!="")
                $fechaValida = True;
            else
                $mensaje = $mensaje . " Fecha de nacimiento no especificada.";
            if($request->has('papa') && $request->papa!="")
                $papaValido = True;
            else
                $mensaje = $mensaje . " Nombre de Papá no especificado.";
            if($request->has('mama') && $request->mama!="")
                $mamaValida = True;
            else
                $mensaje = $mensaje . " Nombre de Mamá no especificado.";
            if($request->has('sexo'))
                $sexoValido = True;
            else
                $mensaje = $mensaje . " Sexo no especificado.";
            if($request->has('pais') && $request->pais!="")
                $paisValido = True;
            else
                $mensaje = $mensaje . " Pais no especificado.";
            if($request->has('municipio') && $request->municipio!="")
                $muniValido = True;
            else
                $mensaje = $mensaje . " Municipio no especificado.";

            if ($nombreValido && $apellidoValido && $fechaValida && $papaValido && $mamaValida && $sexoValido && $paisValido && $muniValido){
                $persona->nombre = $request->nombre;
                $persona->apellido = $request->apellido;
                $persona->fechanac = $request->fechaNac;
                $persona->papa = $request->papa;
                $persona->mama = $request->mama;
                $persona->sexo = $request->sexo == "true";
                //AJAX envia los booleans como texto
                $persona->id_nacionalidad = $request->pais;
                if($request->pais == 54){
                    $persona->id_municipio = $request->municipio;
                }
                else{
                    $persona->id_municipio = NULL;
                }
                $persona->save();
                return response($content = 'Registro guardado correctamente.', $status = 200);
            }
            else{
                return response($content = $mensaje, $status = 500);
            }
        }
        else{
            return redirect('lista_personas');
        }
    }
}
