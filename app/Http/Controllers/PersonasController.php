<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use DataTables;
use App\Persona;
use App\Matrimonio;
use App\Nacionalidad;
use App\Departamento;
use App\Municipio;

class PersonasController extends Controller
{
    public function listar(){
    	$personas = Persona::withCount(['bautismos', 'confirmas'])->get();
    	foreach ($personas as $persona) {
    		$conteoMatrimonios = Matrimonio::where('esposo_id', $persona->id)->orWhere('esposa_id', $persona->id)->count();
    		$persona->casada = $conteoMatrimonios > 0;
    	}
    	return view('pages.lista_personas', compact("personas"));
    }

    public function create(){
    	$paises = Nacionalidad::all();
    	$departamentos = Departamento::all();
    	//pk = 6 corresponde a San Salvador, podria dar error si las tablas catalogo no están llenas
    	$municipios = Departamento::find(6)->municipios()->get();
        return view('pages.crear_persona', compact("paises", "departamentos", "municipios"));
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
}
