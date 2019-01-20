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
        print("entra al metodo");
        if ($request::isMethod('post')) {
            //$confirma = json_decode($request);
           

            $conf = new Confirma;
            $conf->persona_id = $persona->id;
            $conf->fecha = $request->fecha;
            $conf->padre_id = $request->obispo;
            $conf->libro = $request->libro;
            $conf->acta = $request->acta;
            $conf->pagina = $request->pagina;
            $conf->save();
            
            $padrinos = json_decode($request->padrinos);
            
            for ($i=0; $i < (int)$request->cantPad; $i++) {
                $padrino = new PadrinosConfirma;
                $padrino->confirma_id = $conf->id;
                $padrino->nombre = $padrinos[0];
                $padrino->apellido = $padrinos[1];
                $sex = $padrinos[2];
                if ($sex == 'Masculino') {
                    $padrino->sexo = True; 
                }
                else{
                    $padrino->sexo = False;
                }
                //dd($padrino);
                $padrino->save();    
            }
            /*try {
                $em->flush();
            } catch (\Exception $e) {
                $response->setData([
                    'status' => 'error',
                    'message' => 'No se pudieron guardar los datos',
                    'exception' => $e->getMessage(),
                ]);
                return $response;
            }


            $response->setData([
                'status' => 'success',
                'message' => 'Registros actualizados exitosamente',
            ]);*/
            return redirect('detalle_persona/$persona->id');
        }
    }
}
