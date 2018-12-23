<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use DataTables;
use App\User;

class DisplayDataController extends Controller
{
    public function datatable()
    {
        return view('pages.displaydata');
    }

    public function getPosts()
    {
        return \DataTables::of(User::query())->make(true);
    }
}
