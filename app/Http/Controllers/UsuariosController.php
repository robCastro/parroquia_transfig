<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use DataTables;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
    	$users = User::where('type', 'user')->get();
    	return view('pages.usuario')->with('users', $users);
    }
    
    protected function create()
    {	
    	$data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'user',
            'activo' => 'true',
        ]);

        return redirect("admin/asistentes")->with('success','Registro creado satisfactoriamente');;
    }

    public function editar(Request $request){
        try{
            $rules=([
                'nameEdit' => ['required', 'string', 'max:255'],
                'usernameEdit' => ['required', 'string', 'max:50'],
                'emailEdit' => ['required', 'string', 'email', 'max:255'],
            ]);
            $this->validate($request,$rules);
            }
        catch (ValidationException $e) { 
            return response($content = 'Datos erroneos, reintentar.', $status = 500); 
        }
        if ($request->isMethod('post')){
            if($request->has('nameEdit') && $request->has('usernameEdit') && $request->has('emailEdit') && $request->nameEdit != "" && $request->usernameEdit != "" && $request->emailEdit != ""){
                $mensaje="Cambios realizados.";

                $user = User::find($request->idEdit);
                $user->name = $request->nameEdit;
                $user->username = $request->usernameEdit;
                $user->email = $request->emailEdit;
                
                $user->save();
                return redirect("admin/asistentes")->with('success','Registro actualizado satisfactoriamente');;
            }
            else{
                return response($content = 'Faltan datos.', $status = 500);
            }
        }
        else{
            //redireccionar
            return redirect('admin/asistentes');
        }
    }

    public function edit(Request $request){
        try{
            $rules=([
                'passwordEdit' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
            $this->validate($request,$rules);
            }
        catch (ValidationException $e) { 
            return response($content = 'Datos erroneos, reintentar.', $status = 500); 
        }

        if ($request->isMethod('post')){
            if($request->has('passwordEdit') && $request->passwordEdit != ""){
                $mensaje="Cambios realizados.";

                $user = User::find($request->idEditPass);
                $user->password = Hash::make($request->passwordEdit);
                
                $user->save();
                return redirect("admin/asistentes")->with('success','Contraseña actualizada satisfactoriamente');;
            }
            else{
                return redirect("admin/asistentes")->with('error','No se pudo cambiar la Contraseña por favor intente nuevamente');;
            }
        }
        else{
            //redireccionar
            return redirect('admin/asistentes');
        }
    }

    public function eliminar(Request $request){
        if ($request->isMethod('post')){
            $user = User::find($request->idDelete);
            $id=$request->idDelete;
            $user->delete();
            return redirect("admin/asistentes")->with('success','Registro eliminado satisfactoriamente');;

        }
        else{
            //redireccionar
            return redirect("admin/asistentes");
        }
    }

}
