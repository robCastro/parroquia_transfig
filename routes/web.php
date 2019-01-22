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

//Roberto
Route::any('lista_personas', 'PersonasController@listar')->name('lista_personas')->middleware('auth');
Route::any('crear_persona', 'PersonasController@create')->name('crear_persona')->middleware('auth');
Route::post('guardar_persona', 'PersonasController@guardarPersona')->name('guardar_persona')->middleware('auth');
Route::get('filtrar_municipios', 'PersonasController@filtrarMunicipios')->name('filtrar_municipios')->middleware('auth');
Route::get('consultar_sacramentos', 'PersonasController@consultarSacramentos')->name('consultar_sacramentos')->middleware('auth');
Route::post('eliminar_persona', 'PersonasController@eliminar')->name('eliminar_persona')->middleware('auth');
Route::get('detalle_persona/{id}', 'PersonasController@detalle')->where('id', '[0-9]+')->name('detalle_persona')->middleware('auth');
Route::get('editar_persona/{id}', 'PersonasController@edit')->where('id', '[0-9]+')->name('editar_persona')->middleware('auth');
Route::post('guardar_editar_persona', 'PersonasController@guardarEdit')->name('guardar_editar_persona')->middleware('auth');


//Marisol
Route::get('asistentes', 'UsuariosController@index')->name('asistentes')->middleware('auth', 'is_admin');
Route::post('asistente_crear', 'UsuariosController@create')->name('asistente_crear')->middleware('auth', 'is_admin');
Route::post('asistente_editar', 'UsuariosController@editar')->name('asistente_editar')->middleware('auth', 'is_admin');
Route::post('asistente_editPass', 'UsuariosController@edit')->name('asistente_editPass')->middleware('auth', 'is_admin');
Route::post('asistente_eliminar', 'UsuariosController@eliminar')->name('asistente_eliminar')->middleware('auth', 'is_admin');

Route::get('crear_confirma/{id}', 'ConfirmaController@create')->where('id', '[0-9]+')->name('crear_confirma')->middleware('auth');
Route::get('registrar_confirma/{id}', 'ConfirmaController@store')->where('id', '[0-9]+')->name('registrar_confirma')->middleware('auth');
Route::get('detalle_confirma/{id}', 'ConfirmaController@detalleConfirma')->where('id', '[0-9]+')->name('detalle_confirma')->middleware('auth');
Route::post('eliminar_confirma', 'ConfirmaController@destroy')->name('eliminar_confirma');
Route::get('editar_confirma/{id}', 'ConfirmaController@edit')->where('id', '[0-9]+')->name('editar_confirma');
Route::get('guardar_confirma/{id}', 'ConfirmaController@update')->where('id', '[0-9]+')->name('guardar_confirma');

//Patricia
Route::get('padres', 'PadresController@index')->name('padres')->middleware('auth');
Route::post('padres_crear', 'PadresController@crear')->name('padres_crear')->middleware('auth');
Route::post('padres_editar', 'PadresController@editar')->name('padres_editar')->middleware('auth');
Route::post('padres_eliminar', 'PadresController@eliminar')->name('padres_eliminar')->middleware('auth');
