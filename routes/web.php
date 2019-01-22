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

//Route::get('/home', 'HomeController@index')->name('home');


Route::get('index', 'UsuariosController@index');


//Roberto
Route::any('lista_personas', 'PersonasController@listar')->name('lista_personas');
Route::any('crear_persona', 'PersonasController@create')->name('crear_persona');
Route::post('guardar_persona', 'PersonasController@guardarPersona')->name('guardar_persona');
Route::get('filtrar_municipios', 'PersonasController@filtrarMunicipios')->name('filtrar_municipios');
Route::get('consultar_sacramentos', 'PersonasController@consultarSacramentos')->name('consultar_sacramentos');
Route::post('eliminar_persona', 'PersonasController@eliminar')->name('eliminar_persona');
Route::get('detalle_persona/{id}', 'PersonasController@detalle')->where('id', '[0-9]+')->name('detalle_persona');
Route::get('editar_persona/{id}', 'PersonasController@edit')->where('id', '[0-9]+')->name('editar_persona');
Route::post('guardar_editar_persona', 'PersonasController@guardarEdit')->name('guardar_editar_persona');

Route::get('nuevo_matrimonio/{id?}', 'MatrimoniosController@nuevo')->where('id', '[0-9]+')->name('nuevo_matrimonio');
Route::get('hombres_no_casados', 'PersonasController@hombresNoCasados')->name('hombres_no_casados');
Route::post('guardar_nuevo_matrimonio', 'MatrimoniosController@guardar')->name('guardar_nuevo_matrimonio');
Route::get('detalle_matrimonio/{id}', 'MatrimoniosController@detalle')->where('id', '[0-9]+')->name('detalle_matrimonio');
Route::post('eliminar_matrimonio', 'MatrimoniosController@eliminar')->name('eliminar_matrimonio');
Route::get('editar_matrimonio/{id}', 'MatrimoniosController@ver_editar')->where('id', '[0-9]+')->name('editar_matrimonio');
Route::post('guardar_editar_matrimonio/{id}', 'MatrimoniosController@guardar_editar')->where('id', '[0-9]+')->name('guardar_editar_matrimonio');

Route::get('pdf_matrimonio/{id}', 'MatrimoniosController@pdfMatrimonio')->where('id', '[0-9]+')->name('pdf_matrimonio');
Route::get('pdf_confirma/{id}', 'MatrimoniosController@pdfConfirma')->where('id', '[0-9]+')->name('pdf_confirma');
Route::get('pdf_bautismo/{id}', 'MatrimoniosController@pdfBautismo')->where('id', '[0-9]+')->name('pdf_bautismo');
Route::get('comuniones', 'MatrimoniosController@comuniones')->name('comuniones');
Route::get('pdf_comunion', 'MatrimoniosController@pdfComunion')->name('pdf_comunion');

// Get Data
Route::get('datatable/getdata', 'UsuariosController@getPosts')->name('datatable/getdata');

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

//Patricia
Route::get('padres', 'PadresController@index')->name('padres');
Route::post('padres_crear', 'PadresController@crear')->name('padres_crear');
Route::post('padres_editar', 'PadresController@editar')->name('padres_editar');
Route::post('padres_eliminar', 'PadresController@eliminar')->name('padres_eliminar');
