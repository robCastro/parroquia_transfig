<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsuarioPropioController extends Controller
{
    public function index()
    {
    	$usuario = Auth::user();
    	return view('pages.usuario_datosPropios')->with('usuario', $usuario);
    }

     public function cambiarNombre(Request $request){
		
		try{
		$rules=([
            'txtNombre' => ['required', 'string','max:255'],
            'txtContraseniaNombre' => ['required'],
        ]);
		$this->validate($request,$rules);
		}
		catch (ValidationException $e) { 
			return response($content = 'Datos erroneos, reintentar.', $status = 500); 
		}

		if ($request->isMethod('post')){
			
			$usuario = Auth::user();
			if (Hash::check($request->txtContraseniaNombre, $usuario->password)) {
				$usuario->name=$request->txtNombre;
				$usuario->save();
				return response()->json([
					'mensaje' => 'Nombre actualizado.',
					'nombre'=>$usuario->name
				]);
			}
			else{
				return response($content = 'Contraseña incorrecta, reintentar.', $status = 500); 
			}
		}
		else{
			//redireccionar
			return redirect(route('miusuario'));
		}
	}
	 
	 public function cambiarUsuario(Request $request){
		
		try{
		$rules=([
            'txtUsuario' => ['required'],
            'txtContraseniaUsuario' => ['required'],
        ]);
		$this->validate($request,$rules);
		}
		catch (ValidationException $e) { 
			return response($content = 'Datos erroneos, reintentar.', $status = 500); 
		}

		if ($request->isMethod('post')){
			$usuario = Auth::user();
			if (Hash::check($request->txtContraseniaUsuario, $usuario->password)) {
				$username = User::where('username', '=', $request->txtUsuario)->count();
				if ($username==0){
					$usuario->username=$request->txtUsuario;
					$usuario->save();
					return response()->json([
						'mensaje' => 'Usuario actualizado.',
						'usuario'=>$usuario->username
					]);
				}
				else{
					if($usuario->username==$request->txtUsuario){
						return response()->json([
						'mensaje' => 'Usuario actualizado.',
						'usuario'=>$usuario->username
						]);
					}
					else{
						return response($content = 'El usuario ya existe, intente con otro.', $status = 500);
					}
				}
			}
			else{
				return response($content = 'Contraseña incorrecta, reintentar.', $status = 500); 
			}
		}
		else{
			//redireccionar
			return redirect(route('miusuario'));
		}
	}

	public function cambiarContraseña(Request $request){
		
		try{
		$rules=([
            'txtContraseniaActual' => ['required'],
            'txtContraseniaNueva' => ['required'],
            'txtContraseniaRepetir' => ['required'],
        ]);
		$this->validate($request,$rules);
		}
		catch (ValidationException $e) { 
			return response($content = 'Datos erroneos, reintentar.', $status = 500); 
		}

		if ($request->isMethod('post')){
			$usuario = Auth::user();
			if (Hash::check($request->txtContraseniaActual, $usuario->password)) {
				$usuario->password=Hash::make($request->txtContraseniaNueva);
				$usuario->save();
				return response()->json([
					'mensaje' => 'Contraseña actualizada.',
				]);
			}
			else{
				return response($content = 'Contraseña incorrecta, reintentar.', $status = 500); 
			}
		}
		else{
			//redireccionar
			return redirect(route('miusuario'));
		}
	}
}
