<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Persona;
use App\Matrimonio;
use App\PadrinoMatrimonio;
use App\Padre;
use App\Confirma;
use App\Bautismo;
use Barryvdh\DomPDF\Facade as PDF;
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
    		if ($request->has("idEsposo") && $request->has("idEsposa") && $request->has("fecha") && $request->has("padre") && $request->has("libro") && $request->has("folio")){

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

    public function ver_editar($idPersona){
        $matrimonio = Matrimonio::where("esposo_id", $idPersona)->orWhere("esposa_id", $idPersona)->first();
        try{
            $esposo = Persona::find($matrimonio->esposo_id);
            $esposa = Persona::find($matrimonio->esposa_id);
        }
        catch(\ErrorException $e){
            //catch en caso que matrimonio sea null
            return redirect('lista_personas');
        }
        $padres = Padre::all();
        Log::debug($matrimonio->padrinos()->get());
        //se envia idPersona para hacer links a detalle persona
        return view('pages.editar_matrimonio', compact("matrimonio", "esposo", "esposa", "idPersona", "padres"));
    }


    public function guardar_editar(Request $request, $idPersona){
        $matrimonio = Matrimonio::where("esposo_id", $idPersona)->orWhere("esposa_id", $idPersona)->first();
        try{
            $matrimonio->esposo_id;
        }
        catch(\ErrorException $e){
            //catch en caso que matrimonio sea null
            return redirect('lista_personas');
        }
        if($request->has("fecha") && $request->has("padre") && $request->has("libro") && $request->has("folio")){
            $matrimonio->padre_id = $request->padre;
            $matrimonio->fecha = $request->fecha;
            $matrimonio->libro = $request->libro;
            $matrimonio->folio = $request->folio;
            $matrimonio->save();
            
            $matrimonio->padrinos()->delete();

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
            return response($content = "", $status = 200);
        }
    }

    public function pdfMatrimonio($idPersona){
        $matrimonio = Matrimonio::where("esposo_id", $idPersona)->orWhere("esposa_id", $idPersona)->first();
        try{
            $esposo = Persona::find($matrimonio->esposo_id);
            $esposa = Persona::find($matrimonio->esposa_id);
        }
        catch(\ErrorException $e){
            //catch en caso que matrimonio sea null
            return response($content = "Error, matrimonio no existe, refrescar e intente de nuevo.", $status = 500);
        }
        $esposoSalv = True;
        $esposaSalv = True;
        try{
            $esposo->municipio->nombre;
        }
        catch(\ErrorException $e){
            $esposoSalv = False;
        }
        try{
            $esposa->municipio->nombre;
        }
        catch(\ErrorException $e){
            $esposaSalv = False;
        }
        $padreActual = Padre::where('padreActual', true)->first();
        $arrayFecha = $this->convertidorFecha($matrimonio->fecha);
        $edadEsposo = $this->calcularEdad($esposo->fechanac);
        $edadEsposa = $this->calcularEdad($esposa->fechanac);
        $hoy = getdate();
        $arrayHoy = $this->convertidorFecha('1970-'. $hoy['mon'].'-01');
        Log::debug($matrimonio->fecha);
        $pdf = PDF::loadView('pages.pdfs.acta_matrimonios', compact(
            'matrimonio', 
            'esposo', 
            'esposa', 
            'esposoSalv', 
            'esposaSalv', 
            'padreActual',
            'arrayFecha',
            'edadEsposo',
            'edadEsposa',
            'hoy',
            'arrayHoy'
        ));
        return $pdf->download('Matr ' . $esposo->nombre . ' y ' . $esposa->nombre . '.pdf');
    }

    public function pdfConfirma($idPersona){
        $confirma = Confirma::where('persona_id', $idPersona)->first();
        try{
            $confirma->persona->nombre;
        }
        catch(\ErrorException $e){
            //catch en caso que confirma sea null
            return response($content = "Error, confirma no existe, refrescar e intente de nuevo.", $status = 500);
        }
        $padreActual = Padre::where('padreActual', true)->first();
        $arrayFecha = $this->convertidorFecha($confirma->fecha);
        $hoy = getdate();
        $arrayHoy = $this->convertidorFecha('1970-'. $hoy['mon'].'-01');
        $pdf = PDF::loadView('pages.pdfs.acta_confirmas', compact(
            'confirma',  
            'padreActual',
            'arrayFecha',
            'hoy',
            'arrayHoy'
        ));
        return $pdf->download('confirma ' . $confirma->persona->nombre.'.pdf');
    }

    public function pdfBautismo($idPersona){
        $bautismo = Bautismo::where('persona_id', $idPersona)->first();
        try{
            $bautismo->persona->nombre;
        }
        catch(\ErrorException $e){
            //catch en caso que bautismo sea null
            return response($content = "Error, bautismo no existe, refrescar e intente de nuevo.", $status = 500);
        }
        $padreActual = Padre::where('padreActual', true)->first();
        //bautismo convierte tambien el año
        $arrayFecha = $this->convertidorFecha($bautismo->fecha, 'bautismo');
        $arrayFechaNac = $this->convertidorFecha($bautismo->persona->fechanac, 'bautismo');
        $hoy = getdate();
        $arrayHoy = $this->convertidorFecha('1970-'. $hoy['mon'].'-01');
        $pdf = PDF::loadView('pages.pdfs.acta_bautismos', compact(
            'bautismo',  
            'padreActual',
            'arrayFecha',
            'hoy',
            'arrayHoy',
            'arrayFechaNac'
        ));
        return $pdf->download('bautismo ' . $bautismo->persona->nombre.'.pdf');
    }

    public function comuniones(){
        $padres = Padre::all();
        return view('pages.comunion', compact('padres'));
    }

    public function pdfComunion(Request $request){
        $nombre = $request->nombre;
        $apellido = $request->apellido;
        $sexo = $request->sexo == "true";
        $fecha = str_replace('/', '-', $request->fecha);
        $arrayFecha = $this->convertidorFecha($fecha);
        $hoy = getdate();
        $arrayHoy = $this->convertidorFecha($hoy['year'] . '-'. $hoy['mon'] . '-' . $hoy['mday'], "bautismo");
        Log::debug($fecha);
        try{
            $padre = Padre::find((int)$request->padre);
        }
        catch(ModelNotFoundException $e){
            return response($content = 'Error, padre escogido no existe, refrescar', $status = 500);
        }
        $padreActual = Padre::where('padreActual', true)->first();
        $pdf = PDF::loadView('pages.pdfs.acta_comuniones', compact(
            'nombre',
            'apellido',
            'sexo',
            'fecha',
            'arrayFecha',
            'hoy',
            'arrayHoy',
            'padre',
            'padreActual'
        ));
        return $pdf->download('comunion ' . $nombre.'.pdf');
    }

    public function calcularEdad($fechaNac){
        $hoy = getdate();
        $arrayFecha = explode('-', $fechaNac);
        $diaNac = (int)$arrayFecha[2];
        $mesNac = (int)$arrayFecha[1];
        $anioNac = (int)$arrayFecha[0];
        $edad = (int)$hoy['year'] - $anioNac - 1;
        if((int)$hoy['mon'] > $mesNac)
            $edad++;
        elseif ((int)$hoy['mon'] == $mesNac && (int)$hoy['mday'] >= $diaNac) {
            $edad++;
        }
        return $edad;
    }

    public function convertidorFecha($fecha, $tipo="no-bautismo"){
        $fechaArray = explode('-', $fecha);
        $strDia = "";
        switch ($fechaArray[2]) {
            case '1':
                $strDia = "uno";
            break;
            case '2':
                $strDia = "dos";
            break;
            case '3':
                $strDia = "tres";
            break;
            case '4':
                $strDia = "cuatro";
            break;
            case '5':
                $strDia = "cinco";
            break;
            case '6':
                $strDia = "seis";
            break;
            case '7':
                $strDia = "siete";
            break;
            case '8':
                $strDia = "ocho";
            break;
            case '9':
                $strDia = "nueve";
            break;
            case '10':
                $strDia = "diez";
            break;
            case '11':
                $strDia = "once";
            break;
            case '12':
                $strDia = "doce";
            break;
            case '13':
                $strDia = "trece";
            break;
            case '14':
                $strDia = "catorce";
            break;
            case '15':
                $strDia = "quince";
            break;
            case '16':
                $strDia = "dieciseis";
            break;
            case '17':
                $strDia = "diecisiete";
            break;
            case '18':
                $strDia = "dieciocho";
            break;
            case '19':
                $strDia = "diecinueve";
            break;
            case '20':
                $strDia = "veinte";
            break;
            case '21':
                $strDia = "veintiún";
            break;
            case '22':
                $strDia = "veintidos";
            break;
            case '23':
                $strDia = "veintitre";
            break;
            case '24':
                $strDia = "veinticuatro";
            break;
            case '25':
                $strDia = "veinticinco";
            break;
            case '26':
                $strDia = "veintiseis";
            break;
            case '27':
                $strDia = "veintisiete";
            break;
            case '28':
                $strDia = "veintiocho";
            break;
            case '29':
                $strDia = "veintinueve";
            break;
            case '30':
                $strDia = "treinta";
            break;
            case '31':
                $strDia = "treintaiún";
            break;
        }
        $strMes = "";
        switch ($fechaArray[1]) {
            case '1':
                $strMes = "enero";
            break;
            case '2':
                $strMes = "febrero";
            break;
            case '3':
                $strMes = "marzo";
            break;
            case '4':
                $strMes = "abril";
            break;
            case '5':
                $strMes = "mayo";
            break;
            case '6':
                $strMes = "junio";
            break;
            case '7':
                $strMes = "julio";
            break;
            case '8':
                $strMes = "agosto";
            break;
            case '9':
                $strMes = "septiembre";
            break;
            case '10':
                $strMes = "octubre";
            break;
            case '11':
                $strMes = "noviembre";
            break;
            case '12':
                $strMes = "diciembre";
            break;   
        }
        $strAnio = "";
        //Solo bautismo requiere de transformar el mes
        if($tipo == "no-bautismo")
            $strAnio = $fechaArray[0];
        else{
            switch ($fechaArray[0]) {
                case '1970':
                    $strAnio = "mil novecientos setenta";
                break;
                case '1971':
                    $strAnio = "mil novecientos setenta y uno";
                break;
                case '1972':
                    $strAnio = "mil novecientos setenta y dos";
                break;
                case '1973':
                    $strAnio = "mil novecientos setenta y tres";
                break;
                case '1974':
                    $strAnio = "mil novecientos setenta y cuatro";
                break;
                case '1975':
                    $strAnio = "mil novecientos setenta y cinco";
                break;
                case '1976':
                    $strAnio = "mil novecientos setenta y seis";
                break;
                case '1977':
                    $strAnio = "mil novecientos setenta y siete";
                break;
                case '1978':
                    $strAnio = "mil novecientos setenta y ocho";
                break;
                case '1979':
                    $strAnio = "mil novecientos setenta y nueve";
                break;
                case '1980':
                    $strAnio = "mil novecientos ochenta";
                break;
                case '1981':
                    $strAnio = "mil novecientos ochenta y uno";
                break;
                case '1982':
                    $strAnio = "mil novecientos ochenta y dos";
                break;
                case '1983':
                    $strAnio = "mil novecientos ochenta y tres";
                break;
                case '1984':
                    $strAnio = "mil novecientos ochenta y cuatro";
                break;
                case '1985':
                    $strAnio = "mil novecientos ochenta y cinco";
                break;
                case '1986':
                    $strAnio = "mil novecientos ochenta y seis";
                break;
                case '1987':
                    $strAnio = "mil novecientos ochenta y siete";
                break;
                case '1988':
                    $strAnio = "mil novecientos ochenta y ocho";
                break;
                case '1989':
                    $strAnio = "mil novecientos ochenta y nueve";
                break;
                case '1990':
                    $strAnio = "mil novecientos noventa";
                break;
                case '1991':
                    $strAnio = "mil novecientos noventa y uno";
                break;
                case '1992':
                    $strAnio = "mil novecientos noventa y dos";
                break;
                case '1993':
                    $strAnio = "mil novecientos noventa y tres";
                break;
                case '1994':
                    $strAnio = "mil novecientos noventa y cuatro";
                break;
                case '1995':
                    $strAnio = "mil novecientos noventa y cinco";
                break;
                case '1996':
                    $strAnio = "mil novecientos noventa y seis";
                break;
                case '1997':
                    $strAnio = "mil novecientos noventa y siete";
                break;
                case '1998':
                    $strAnio = "mil novecientos noventa y ocho";
                break;
                case '1999':
                    $strAnio = "mil novecientos noventa y nueve";
                break;
                case '2000':
                    $strAnio = "dos mil";
                break;
                case '2001':
                    $strAnio = "dos mil uno";
                break;
                case '2002':
                    $strAnio = "dos mil dos";
                break;
                case '2003':
                    $strAnio = "dos mil tres";
                break;
                case '2004':
                    $strAnio = "dos mil cuatro";
                break;
                case '2005':
                    $strAnio = "dos mil cinco";
                break;
                case '2006':
                    $strAnio = "dos mil seis";
                break;
                case '2007':
                    $strAnio = "dos mil siete";
                break;
                case '2008':
                    $strAnio = "dos mil ocho";
                break;
                case '2009':
                    $strAnio = "dos mil nueve";
                break;
                case '2010':
                    $strAnio = "dos mil diez";
                break;
                case '2011':
                    $strAnio = "dos mil once";
                break;
                case '2012':
                    $strAnio = "dos mil doce";
                break;
                case '2013':
                    $strAnio = "dos mil trece";
                break;
                case '2014':
                    $strAnio = "dos mil catorce";
                break;
                case '2015':
                    $strAnio = "dos mil quince";
                break;
                case '2016':
                    $strAnio = "dos mil dieciseis";
                break;
                case '2017':
                    $strAnio = "dos mil diecisiete";
                break;
                case '2018':
                    $strAnio = "dos mil dieciocho";
                break;
                case '2019':
                    $strAnio = "dos mil diecinueve";
                break;
                case '2020':
                    $strAnio = "dos mil veinte";
                break;
                case '2021':
                    $strAnio = "dos mil veintiuno";
                break;
                case '2022':
                    $strAnio = "dos mil veintidos";
                break;
                case '2023':
                    $strAnio = "dos mil veintitres";
                break;
                case '2024':
                    $strAnio = "dos mil veinticuatro";
                break;
                case '2025':
                    $strAnio = "dos mil veinticinco";
                break;
                case '2026':
                    $strAnio = "dos mil veintiseis";
                break;
                case '2027':
                    $strAnio = "dos mil veintisiete";
                break;
                case '2028':
                    $strAnio = "dos mil veintiocho";
                break;
                case '2029':
                    $strAnio = "dos mil veintinueve";
                break;
                case '2030':
                    $strAnio = "dos mil treinta";
                break;
                case '2031':
                    $strAnio = "dos mil treinta y uno";
                break;
                default:
                    $strAnio = "Año fuera de rango, notificar a programador, verificar MatrimoniosController. Capacidad desde 1970 a 2031";
                break;
            }
        }
        return array(
            'dia' => $strDia,
            'mes' => $strMes,
            'anio' => $strAnio
        );
    }
}
