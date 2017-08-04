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

/*
*Rutas publicas
*/

Auth::routes(); //rutas de autenticacion

Route::group(['namespace' => 'Publico'], function(){

	//busqueda, contacto, etc
	Route::get('/', function () {
	    return view('welcome');
	});

});

/*
*Rutas privadas (requieren login)
*/
Route::group(['middleware' => 'auth'], function(){ 
	Route::get('/logout', function(){
		Auth::logout();
        return Redirect::to('/')->with('msg', 'Gracias por visitarnos!.');
	})->name('logout');
	/*
	*Rutas para inventario del proveedor
	*/	
	Route::group(['prefix' => 'productos', 'namespace' => 'Inventario'], function(){ 

		Route::get('/', 'Productos@index')->name('productos');

		Route::get('listar', 'Productos@productosProveedor');

		Route::get('agregar', 'Productos@add')->name('agregarProducto');

		Route::get('editar/{id}', 'Productos@add');

		Route::delete('eliminar', 'Productos@delete');

		Route::post('guardar', 'Productos@create');

		Route::post('subirImagen', 'Productos@uploadImage');

		Route::delete('eliminarImagen', 'Productos@deleteImage');

		Route::get('mostrar/{id}', 'Productos@show');//no se utiliza

		Route::get('filtrar/{campos}/{valores}', 'Productos@find');//no se utiliza

	});
});