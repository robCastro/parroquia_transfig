<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Bautismo;
use App\Padre;
use App\PadrinoBautismo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class BautismoController extends Controller
{
    public function crear(Request $request, $id)
    {
        try{
            $persona = Persona::findOrFail((int)$id);
        }
        catch(ModelNotFoundException $e){
            return redirect(route('lista_personas'));
        }
        $bautismo = Bautismo::where('persona_id', '=', $persona->id)->count();
        if($bautismo==1){
            return redirect(route('detalle_persona',$persona->id));
        }

        $padres=Padre::all();

        return view('pages.bautismo_crear',compact("persona","padres"));
    }

    public function guardar(Request $request){
        try{
            $rules=([
                'txtCodigoPersona' => ['required', 'integer'],
                'txtFecha' => ['required', 'date'],
                'selectPadre' => ['required', 'integer'],
                'txtLibro' => ['required', 'integer'],
                'txtActa' => ['required', 'integer'],
            ]);
            $this->validate($request,$rules);
            }
            catch (ValidationException $e) { 
                if($request->has('txtFecha') && $request->txtFecha!=""){
                    $mensaje='Datos erroneos, reintentar.';
                }
                else{
                    $mensaje='Ingresar la fecha.';
                }
                return response($content = $mensaje, $status = 500); 
            }

        if ($request->isMethod('post')){
            $bautismo= new Bautismo;
            $bautismo->fecha=$request->txtFecha;
            $bautismo->libro=$request->txtLibro;
            $bautismo->acta=$request->txtActa;
            $bautismo->persona_id=$request->txtCodigoPersona;
            $bautismo->padre_id=$request->selectPadre;
            $bautismo->save();
            $listaPadrinos=json_decode($request->listaPadrinos,true);
            foreach ($listaPadrinos as $padrino){
                $padrinoNuevo=new PadrinoBautismo;
                for ($i=0;$i<=2;$i++){
                    if($i==0){
                        $padrinoNuevo->nombre=$padrino[$i];
                    }
                    if($i==1){
                        $padrinoNuevo->apellido=$padrino[$i];
                    }
                    if($i==2){
                        if($padrino[$i]=='Masculino'){
                            $padrinoNuevo->sexo=true;
                        }
                        if($padrino[$i]=='Femenino'){
                            $padrinoNuevo->sexo=false;
                        }
                    }
                }
                $padrinoNuevo->bautismo_id=$bautismo->id;
                $padrinoNuevo->save();
            }
            return response()->json([
                'mensaje' => 'Bautismo Guardado.'
            ]);
        }
        else{
            return redirect(route('lista_personas'));
        }
    }

    public function detalle($idPersona)
    {
        try{
            $persona = Persona::findOrFail((int)$idPersona);
        }
        catch(ModelNotFoundException $e){
            return redirect(route('lista_personas'));
        }
        $bautismo = Bautismo::where('persona_id', '=', $idPersona)->first();
        if($bautismo==null){
            return redirect(route('detalle_persona',$idPersona));
        }

        return view('pages.bautismo_detalle',compact("bautismo"));
    }

    public function eliminar(Request $request){
		if ($request->isMethod('post')){
            $idPersona=$request->txtIdPersona;
            $bautismo = Bautismo::find($request->txtIdBautismo);
            $bautismo->delete();
            //Padrinos se eliminan en cascada
            return redirect(route('detalle_persona',$idPersona));
		}
		else{
			return redirect(route('lista_personas'));
		}
	}

    public function editar(Request $request, $idPersona)
    {
        try{
            $persona = Persona::findOrFail((int)$idPersona);
        }
        catch(ModelNotFoundException $e){
            return redirect(route('lista_personas'));
        }
        $bautismo = Bautismo::where('persona_id', '=', $idPersona)->first();
        if($bautismo==null){
            return redirect(route('detalle_persona',$idPersona));
        }

        $padres=Padre::all();

        return view('pages.bautismo_editar',compact("persona","padres","bautismo"));
    }

    public function modificar(Request $request){
        try{
            $rules=([
                'txtCodigoBautismo' => ['required', 'integer'],
                'txtFecha' => ['required', 'date'],
                'selectPadre' => ['required', 'integer'],
                'txtLibro' => ['required', 'integer'],
                'txtActa' => ['required', 'integer'],
            ]);
            $this->validate($request,$rules);
            }
            catch (ValidationException $e) { 
                if($request->has('txtFecha') && $request->txtFecha!=""){
                    $mensaje='Datos erroneos, reintentar.';
                }
                else{
                    $mensaje='Ingresar la fecha.';
                }
                return response($content = $mensaje, $status = 500); 
            }

        if ($request->isMethod('post')){
            $bautismo= Bautismo::find($request->txtCodigoBautismo);
            $bautismo->fecha=$request->txtFecha;
            $bautismo->libro=$request->txtLibro;
            $bautismo->acta=$request->txtActa;
            $bautismo->padre_id=$request->selectPadre;
            $bautismo->save();
            $listaPadrinos=json_decode($request->listaPadrinos,true);
            $listaPadrinosEliminar=json_decode($request->listaPadrinosEliminar,true);
            foreach ($listaPadrinos as $padrino){
                $padrinoNuevo=new PadrinoBautismo;
                for ($i=0;$i<=2;$i++){
                    if($i==0){
                        $padrinoNuevo->nombre=$padrino[$i];
                    }
                    if($i==1){
                        $padrinoNuevo->apellido=$padrino[$i];
                    }
                    if($i==2){
                        if($padrino[$i]=='Masculino'){
                            $padrinoNuevo->sexo=true;
                        }
                        if($padrino[$i]=='Femenino'){
                            $padrinoNuevo->sexo=false;
                        }
                    }
                }
                $padrinoNuevo->bautismo_id=$bautismo->id;
                $padrinoNuevo->save();
            }
            foreach ($listaPadrinosEliminar as $padrinoId){
                   PadrinoBautismo::find($padrinoId)->delete(); 
            }
            return response()->json([
                'mensaje' => 'Bautismo Actualizado.'
            ]);
        }
        else{
            return redirect(route('lista_personas'));
        }
    }

    public function eliminarBautismoRob(Request $request){
        if($request->has("idPersona")){
            $idPersona = $request->idPersona;
        }
        else{
            return redirect('lista_personas');
        }
        $cantEliminados = Bautismo::where('persona_id', $idPersona)->delete();
        return response($content = "Eliminado", $status=200);
    }
}
