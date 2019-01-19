<?php

namespace App\Http\Controllers;

use App\Confirma;
use App\Persona;
use App\Padre;
use App\PadrinosConfirma;

use Illuminate\Http\Request;

class ConfirmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        if(Confirma::where('persona_id', '=', $id)->exists()){
            return redirect('detalle_persona/$id')->with('error','La persona ya cuenta con un registro de Confirma');;
        }
        else{
            $obispos = Padre::where('esObispo', True)->get();
            $persona = Persona::find($id);
            return view('pages.crear_confirma', compact('obispos', 'persona'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Confirma  $confirma
     * @return \Illuminate\Http\Response
     */
    public function show(Confirma $confirma)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Confirma  $confirma
     * @return \Illuminate\Http\Response
     */
    public function edit(Confirma $confirma)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Confirma  $confirma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Confirma $confirma)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Confirma  $confirma
     * @return \Illuminate\Http\Response
     */
    public function destroy(Confirma $confirma)
    {
        //
    }

    public function addPadrino(Request $request){
        if($request->isMethod('POST')){
            $mensaje = 'Errores encontrados';
            $nombreValido = False;
            $apellidoValido = False;
            $sexoValido = False;
            if($request->has('nombre') && $request->nombre!="")
                $nombreValido = True;
            else
                $mensaje = $mensaje . " Nombre no especificado.";
            
            if($request->has('apellido') && $request->apellido!="")
                $apellidoValido = True;
            else
                $mensaje = $mensaje . " Apellido no especificado.";
            
            if($request->has('sexo'))
                $sexoValido = True;
            else
                $mensaje = $mensaje . " Sexo no especificado.";
            
            if ($nombreValido && $apellidoValido && $sexoValido){
                
                $nombrePadrino = $request->nombre;
                $apellidoPadrino = $request->apellido;
                $sexoPadrino = $request->sexo == "true";
                //ARRAY
                $resultado = compact("nombrePadrino", "apellidoPadrino", "sexoPadrino");

                dd($resultado->all());

                return response($content = 'Nuevo id:'.$persona->id, $status=200)->with('resultado', $resultado);
            }
            else{
                return response($content = $mensaje, $status = 500);
            }
        }
        else{
            //Redirigir a crear persona
            return redirect('detalle_persona/$persona->id');
        }
    }
}
