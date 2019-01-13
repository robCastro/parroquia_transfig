<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('create', 'UsuariosController@create');
Route::get('index', 'UsuariosController@index');


//Roberto
Route::get('lista_personas', 'PersonasController@listar')->name('lista_personas');
Route::get('crear_persona', 'PersonasController@create')->name('crear_persona');
Route::get('filtrar_municipios', 'PersonasController@filtrarMunicipios')->name('filtrar_municipios');

// Get Data
Route::get('datatable/getdata', 'UsuariosController@getPosts')->name('datatable/getdata');


Route::prefix('admin')->group(function()
{
	//Marisol
	Route::get('asistentes', 'UsuariosController@index')->name('asistentes');
	Route::get('asistente/crear', 'UsuariosController@create')->name('asistentes_crear');
	//Route::post('edificios_eliminar', 'EdificiosController@eliminar')->name('edificios_eliminar');
	//Route::post('edificios_editar', 'EdificiosController@editar')->name('edificios_editar');

	/*Route::get('confirmacion', 'UsuariosController@index')->name('aspirantes');
	Route::post('edificios_guardar', 'EdificiosController@guardar')->name('edificios_guardar');
	Route::post('edificios_eliminar', 'EdificiosController@eliminar')->name('edificios_eliminar');
	Route::post('edificios_editar', 'EdificiosController@editar')->name('edificios_editar');*/

});