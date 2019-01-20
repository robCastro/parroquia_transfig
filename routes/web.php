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
Route::any('lista_personas', 'PersonasController@listar')->name('lista_personas')->middleware('auth', 'cors');
Route::any('crear_persona', 'PersonasController@create')->name('crear_persona')->middleware('auth', 'cors');
Route::post('guardar_persona', 'PersonasController@guardarPersona')->name('guardar_persona')->middleware('auth', 'cors');
Route::get('filtrar_municipios', 'PersonasController@filtrarMunicipios')->name('filtrar_municipios')->middleware('auth', 'cors');
Route::get('consultar_sacramentos', 'PersonasController@consultarSacramentos')->name('consultar_sacramentos')->middleware('auth', 'cors');
Route::post('eliminar_persona', 'PersonasController@eliminar')->name('eliminar_persona')->middleware('auth', 'cors');
Route::get('detalle_persona/{id}', 'PersonasController@detalle')->where('id', '[0-9]+')->name('detalle_persona')->middleware('auth', 'cors');
Route::get('editar_persona/{id}', 'PersonasController@edit')->where('id', '[0-9]+')->name('editar_persona')->middleware('auth', 'cors');
Route::post('guardar_editar_persona', 'PersonasController@guardarEdit')->name('guardar_editar_persona')->middleware('auth', 'cors');


//Marisol
Route::get('asistentes', 'UsuariosController@index')->name('asistentes')->middleware('auth', 'is_admin', 'cors');
Route::post('asistente_crear', 'UsuariosController@create')->name('asistente_crear')->middleware('auth', 'is_admin', 'cors');
Route::post('asistente_editar', 'UsuariosController@editar')->name('asistente_editar')->middleware('auth', 'is_admin', 'cors');
Route::post('asistente_editPass', 'UsuariosController@edit')->name('asistente_editPass')->middleware('auth', 'is_admin', 'cors');
Route::post('asistente_eliminar', 'UsuariosController@eliminar')->name('asistente_eliminar')->middleware('auth', 'is_admin', 'cors');

Route::get('crear_confirma/{id}', 'ConfirmaController@create')->where('id', '[0-9]+')->name('crear_confirma')->middleware('auth', 'cors');
Route::post('padrinos_confirma', 'ConfirmaController@addPadrino')->name('padrinos_confirma')->middleware('auth', 'cors');

//Patricia
Route::get('padres', 'PadresController@index')->name('padres')->middleware('auth', 'cors');
Route::post('padres_crear', 'PadresController@crear')->name('padres_crear')->middleware('auth', 'cors');
Route::post('padres_editar', 'PadresController@editar')->name('padres_editar')->middleware('auth', 'cors');
Route::post('padres_eliminar', 'PadresController@eliminar')->name('padres_eliminar')->middleware('auth', 'cors');
