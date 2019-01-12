<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use DataTables;
use App\User;

class UsuariosController extends Controller
{
    public function index()
    {
    	$users = User::all();
    	return view('pages.usuario')->with('users', $users);
    }

    public function create()
    {
        return view('pages.usuario-crear');
    }
}
