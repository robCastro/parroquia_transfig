<?php

namespace App\Http\Controllers;

use App\Confirma;
use App\Persona;
use App\Padre;
use App\PadrinoConfirma;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
            return redirect()->route('detalle_persona', [$id])->with('error','La persona ya cuenta con un registro de Confirma');;
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
    public function store(Request $request, $id)
    {
        //Obtenemos la variable de la petición y la decodificamos ya que viene en json
        $data=json_decode($request->data);


        //El objeto data posee la misma estructura del json enviado pero ya es un objeto php 
        $conf = new Confirma;
        $conf->fecha = $data->fecha;
        $conf->padre_id = $data->obispo;
        $conf->libro = $data->libro;
        $conf->acta = $data->acta;
        $conf->pagina = $data->pagina;
        $conf->persona_id = $id; //recibido de la url
        $conf->save();
        //Una vez almacenada la confirma ya tenemos un id que usaremos para registrar los padrinos

        //Recorremos el array de padrinos y vamos almacenando cada uno de ellos
        foreach ($data->padrinos as $pad){
            //0 nombre 1 apellidos 3 sexo

            $padrino = new PadrinoConfirma;
            $padrino->confirma_id = $conf->id;
            $padrino->nombre = $pad[0];
            $padrino->apellido = $pad[1];
            //Evalúa el resultado de $pad[2]=='Masculino' y los asigna al sexo
            $padrino->sexo = $pad[2] == "Masculino";
            //echo("padrino");
            $padrino->save();   
        }
        
        //Se retorna el id de la persona
        return redirect()->route('detalle_confirma', [$id]);
        //return redirect()->route('detalle_confirma', [$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Confirma  $confirma
     * @return \Illuminate\Http\Response
     */
    public function detalleConfirma($idPersona)
    {
        $confirma = Confirma::where("persona_id", $idPersona)->first();
        try{
            $persona = Persona::find($confirma->persona_id);
        }
        catch(\ErrorException $e){
            //catch en caso que confirma sea null
            return redirect('lista_personas');
        }
        //se envia idPersona para hacer links a detalle persona
        return view('pages.detalle_confirma', compact("confirma", "persona", "idPersona"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Confirma  $confirma
     * @return \Illuminate\Http\Response
     */
    public function edit($idPersona)
    {
        $confirma = Confirma::where("persona_id", $idPersona)->first();
        try{
            $persona = Persona::find($confirma->persona_id);
        }
        catch(\ErrorException $e){
            //catch en caso que confirma sea null
            return redirect('lista_personas');
        }
        $padres = Padre::where('esObispo', True)->get();
        Log::debug($confirma->padrinos()->get());
        //se envia idPersona para hacer links a detalle persona
        return view('pages.editar_confirma', compact("confirma", "persona", "padres"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Confirma  $confirma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $confirma = Confirma::find($id);
        //Obtenemos la variable de la petición y la decodificamos ya que viene en json

        try{
            $confirma->persona_id;
        }
        catch(\ErrorException $e){
            //catch en caso que confirma sea null
            return redirect('lista_personas');
        }
        echo json_encode($confirma);
        $data=json_decode($request->data);

        //El objeto daecho json_encode($confirma);ta posee la misma estructura del json enviado pero ya es un objeto php 
        $confirma->fecha = $data->fecha;
        $confirma->padre_id = $data->obispo;
        $confirma->libro = $data->libro;
        $confirma->acta = $data->acta;
        $confirma->pagina = $data->pagina;
        $confirma->save();
        echo json_encode($confirma);

        $confirma->padrinos()->delete();

        //Recorremos el array de padrinos y vamos almacenando cada uno de ellos
        foreach ($data->padrinos as $pad){
            //0 nombre 1 apellidos 2sexo

            $padrino = new PadrinoConfirma;

            $padrino->confirma_id = $confirma->id;
            $padrino->nombre = $pad[0];
            $padrino->apellido = $pad[1];
            //Evalúa el resultado de $pad[2]=='Masculino' y los asigna al sexo
            $padrino->sexo = $pad[2] == "Masculino";
            //echo("padrino");
            echo json_encode($padrino);
            $padrino->save();   
        }
        
        //Se retorna el id de la persona
        //return response($content = "", $status = 200);
        //return redirect()->route('detalle_confirma', [$confirma->persona_id]);
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Confirma  $confirma
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->has("idPersona")){
            $idPersona = $request->idPersona;
        }
        else{
            return redirect('lista_personas');
        }
        $cantEliminados = Confirma::where('persona_id', $idPersona)->delete();
        return response($content = "Eliminado", $status=200);
    }

    public function addConfirma(Request $request, $id){
       if($request->data != ""){
            //Obtenemos la variable de la petición y la decodificamos ya que viene en json
            $data=json_decode($request->data);


            //El objeto data posee la misma estructura del json enviado pero ya es un objeto php 
            $conf = new Confirma;
            $conf->fecha = $data->fecha;
            $conf->padre_id = $data->obispo;
            $conf->libro = $data->libro;
            $conf->acta = $data->acta;
            $conf->pagina = $data->pagina;
            $conf->persona_id = $id; //recibido de la url
            $conf->save();
            //Una vez almacenada la confirma ya tenemos un id que usaremos para registrar los padrinos

            //Recorremos el array de padrinos y vamos almacenando cada uno de ellos
            foreach ($data->padrinos as $pad){
                //0 nombre 1 apellidos 3 sexo

                $padrino = new PadrinoConfirma;
                $padrino->confirma_id = $conf->id;
                $padrino->nombre = $pad[0];
                $padrino->apellido = $pad[1];
                //Evalúa el resultado de $pad[2]=='Masculino' y los asigna al sexo
                $padrino->sexo = $pad[2] == "Masculino";
                //echo("padrino");
                $padrino->save();   
            }
            
            //Se retorna el id de la persona
            return response($content = "". $conf->persona_id, $status = 200);
            //return redirect()->route('detalle_confirma', [$id]);
        }
        else{
            return response($content = "Faltan datos, favor verificar", $status = 500);
        }
    }
}
