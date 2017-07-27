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

/*
*Rutas para controlador layout
*/
Route::group(['prefix' => 'usuario'], function(){

	Route::post('agregar', 'Usuarios@create');

});


/*
*Rutas para inventario del proveedor
*/


Route::group(['prefix' => 'inventario'], function(){ 

	Route::get('/', 'Inventario@index');

	Route::get('listar', 'Productos@productosProveedor');

	Route::get('agregar', 'Productos@add');

	Route::get('editar/{id}', 'Productos@add');

	Route::delete('eliminar', 'Productos@delete');

	Route::post('guardar', 'Productos@create');

	Route::post('subirImagen', 'Productos@uploadImage');

	Route::delete('eliminarImagen', 'Productos@deleteImage');

	Route::get('mostrar/{id}', 'Productos@show');//no se utiliza

	Route::get('filtrar/{campos}/{valores}', 'Productos@find');//no se utiliza

});

Auth::routes();
