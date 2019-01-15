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


Auth::routes();


Route::prefix('admin')->group(function()
{
	//Marisol
	Route::get('asistentes', 'UsuariosController@index')->name('asistentes')->middleware('auth', 'is_admin');
	Route::post('asistente_crear', 'UsuariosController@create')->name('asistente_crear')->middleware('auth');
	Route::post('asistente_editar', 'UsuariosController@editar')->name('asistente_editar');
	Route::post('asistente_editPass', 'UsuariosController@edit')->name('asistente_editPass');
	Route::post('asistente_eliminar', 'UsuariosController@eliminar')->name('asistente_eliminar');


	/*Route::get('confirmacion', 'UsuariosController@index')->name('aspirantes');
	Route::post('edificios_guardar', 'EdificiosController@guardar')->name('edificios_guardar');
	Route::post('edificios_editar', 'EdificiosController@editar')->name('edificios_editar');*/

});