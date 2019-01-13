<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/asistentes';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // Los inputs
        $this->validate($request, [
            'login'    => 'required',
            'password' => 'required',
        ]);
 
        /*
         * Si se valida como verdadero el email, $login_type es email,
         * de lo contrario, es username
         *
         * filter_var: Filtra una variable con el filtro que se indique
         * FILTER_VALIDATE_EMAIL: Valida un dirección de correo
         */
        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL )
            ? 'email'
            : 'username';
 
        /*
         * De forma predeterminada tenemos login como variable
         * Pero como nosotors necesitamos email o username,
         * realizamos merge
         */
        $request->merge([
            $login_type => $request->input('login')
        ]);
 
        // Validar login correcto
        if (Auth::attempt($request->only($login_type, 'password'))) {
            return redirect()->intended($this->redirectPath());
        }
 
        // Volver y mostrar errores
        return redirect()->back()
            ->withInput()
            ->withErrors([
                'login' => 'These credentials do not match our records.',
            ]);
    }
}
