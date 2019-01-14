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
    return redirect('login');
});

Route::get('home', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


Route::get('index', 'UsuariosController@index');


//Roberto
Route::any('lista_personas', 'PersonasController@listar')->name('lista_personas');
Route::any('crear_persona', 'PersonasController@create')->name('crear_persona');
Route::post('guardar_persona', 'PersonasController@guardarPersona')->name('guardar_persona');
Route::get('filtrar_municipios', 'PersonasController@filtrarMunicipios')->name('filtrar_municipios');
Route::get('consultar_sacramentos', 'PersonasController@consultarSacramentos')->name('consultar_sacramentos');
Route::post('eliminar_persona', 'PersonasController@eliminar')->name('eliminar_persona');

// Get Data
Route::get('datatable/getdata', 'UsuariosController@getPosts')->name('datatable/getdata');

Route::prefix('admin')->group(function()
{
	//Marisol
	Route::get('asistentes', 'UsuariosController@index')->name('asistentes')->middleware('auth');
	Route::post('asistente_crear', 'UsuariosController@create')->name('asistente_crear')->middleware('auth');
	//Route::post('edificios_eliminar', 'EdificiosController@eliminar')->name('edificios_eliminar');
	//Route::post('edificios_editar', 'EdificiosController@editar')->name('edificios_editar');

	/*Route::get('confirmacion', 'UsuariosController@index')->name('aspirantes');
	Route::post('edificios_guardar', 'EdificiosController@guardar')->name('edificios_guardar');
	Route::post('edificios_eliminar', 'EdificiosController@eliminar')->name('edificios_eliminar');
	Route::post('edificios_editar', 'EdificiosController@editar')->name('edificios_editar');*/

});