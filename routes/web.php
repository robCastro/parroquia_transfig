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

Route::get('nuevo_matrimonio/{id?}', 'MatrimoniosController@nuevo')->where('id', '[0-9]+')->name('nuevo_matrimonio')->middleware('auth');
Route::get('hombres_no_casados', 'PersonasController@hombresNoCasados')->name('hombres_no_casados')->middleware('auth');
Route::post('guardar_nuevo_matrimonio', 'MatrimoniosController@guardar')->name('guardar_nuevo_matrimonio')->middleware('auth');
Route::get('detalle_matrimonio/{id}', 'MatrimoniosController@detalle')->where('id', '[0-9]+')->name('detalle_matrimonio')->middleware('auth');
Route::post('eliminar_matrimonio', 'MatrimoniosController@eliminar')->name('eliminar_matrimonio')->middleware('auth');
Route::get('editar_matrimonio/{id}', 'MatrimoniosController@ver_editar')->where('id', '[0-9]+')->name('editar_matrimonio')->middleware('auth');
Route::post('guardar_editar_matrimonio/{id}', 'MatrimoniosController@guardar_editar')->where('id', '[0-9]+')->name('guardar_editar_matrimonio')->middleware('auth');

Route::get('pdf_matrimonio/{id}', 'MatrimoniosController@pdfMatrimonio')->where('id', '[0-9]+')->name('pdf_matrimonio')->middleware('auth');
Route::get('pdf_confirma/{id}', 'MatrimoniosController@pdfConfirma')->where('id', '[0-9]+')->name('pdf_confirma')->middleware('auth');
Route::get('pdf_bautismo/{id}', 'MatrimoniosController@pdfBautismo')->where('id', '[0-9]+')->name('pdf_bautismo')->middleware('auth');
Route::get('comuniones', 'MatrimoniosController@comuniones')->name('comuniones')->middleware('auth');
Route::get('pdf_comunion', 'MatrimoniosController@pdfComunion')->name('pdf_comunion')->middleware('auth');

//Marisol
Route::get('asistentes', 'UsuariosController@index')->name('asistentes')->middleware('auth', 'is_admin');
Route::post('asistente_crear', 'UsuariosController@create')->name('asistente_crear')->middleware('auth', 'is_admin');
Route::post('asistente_editar', 'UsuariosController@editar')->name('asistente_editar')->middleware('auth', 'is_admin');
Route::post('asistente_editPass', 'UsuariosController@edit')->name('asistente_editPass')->middleware('auth', 'is_admin');
Route::post('asistente_eliminar', 'UsuariosController@eliminar')->name('asistente_eliminar')->middleware('auth', 'is_admin');

Route::get('crear_confirma/{id}', 'ConfirmaController@create')->where('id', '[0-9]+')->name('crear_confirma')->middleware('auth');
Route::get('registrar_confirma/{id}', 'ConfirmaController@store')->where('id', '[0-9]+')->name('registrar_confirma')->middleware('auth');
Route::get('detalle_confirma/{id}', 'ConfirmaController@detalleConfirma')->where('id', '[0-9]+')->name('detalle_confirma')->middleware('auth');
Route::post('eliminar_confirma', 'ConfirmaController@destroy')->name('eliminar_confirma')->middleware('auth');
Route::get('editar_confirma/{id}', 'ConfirmaController@edit')->where('id', '[0-9]+')->name('editar_confirma')->middleware('auth');
Route::get('guardar_confirma/{id}', 'ConfirmaController@update')->where('id', '[0-9]+')->name('guardar_confirma')->middleware('auth');

// Get Data
Route::get('datatable/getdata', 'UsuariosController@getPosts')->name('datatable/getdata');

//Patricia
Route::get('padres', 'PadresController@index')->name('padres')->middleware('auth');
Route::post('padres_crear', 'PadresController@crear')->name('padres_crear')->middleware('auth');
Route::post('padres_editar', 'PadresController@editar')->name('padres_editar')->middleware('auth');
Route::post('padres_eliminar', 'PadresController@eliminar')->name('padres_eliminar')->middleware('auth');

Route::get('bautismo_crear/{id}', 'BautismoController@crear')->where('id', '[0-9]+')->name('bautismo_crear')->middleware('auth');
Route::post('bautismo_guardar', 'BautismoController@guardar')->name('bautismo_guardar')->middleware('auth');
Route::get('bautismo_detalle/{id}', 'BautismoController@detalle')->where('id', '[0-9]+')->name('bautismo_detalle')->middleware('auth');
Route::post('bautismo_eliminar', 'BautismoController@eliminar')->name('bautismo_eliminar')->middleware('auth');
Route::get('bautismo_editar/{id}', 'BautismoController@editar')->where('id', '[0-9]+')->name('bautismo_editar')->middleware('auth');
Route::post('bautismo_modificar', 'BautismoController@modificar')->name('bautismo_modificar')->middleware('auth');

Route::get('miusuario', 'UsuarioPropioController@index')->name('miusuario')->middleware('auth');
Route::post('miusuario_editarNombre', 'UsuarioPropioController@cambiarNombre')->name('miusuario_editarNombre')->middleware('auth');
Route::post('miusuario_editarUsuario', 'UsuarioPropioController@cambiarUsuario')->name('miusuario_editarUsuario')->middleware('auth');
Route::post('miusuario_editarContrasenia', 'UsuarioPropioController@cambiarContraseña')->name('miusuario_editarContrasenia')->middleware('auth');

Route::post('bautismo_eliminarRob/', 'BautismoController@eliminarBautismoRob')->name('bautismo_eliminarRob')->middleware('auth');