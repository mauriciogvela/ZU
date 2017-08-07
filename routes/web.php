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
	    return view('home');
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
	*Rutas para modulos del usuario
	*/
	Route::group(['namespace' => 'Usuario'], function(){ 

		/*Rutas para modulo perfil*/
		Route::group(['prefix' => 'perfil'], function(){

			Route::get('/', 'Perfil@index')->name('perfil');
		});
	});

	/*
	*Rutas para modulos de comunicacion del proveedor
	*/
	Route::group(['namespace' => 'Comunicacion'], function(){ 

		/*Rutas para modulo notificaciones*/
		Route::group(['prefix' => 'notificaciones',], function(){ 
			Route::get('/', 'Notificaciones@index')->name('notificaciones');
		});

		/*Rutas para modulo comentarios*/
		Route::group(['prefix' => 'comentarios',], function(){ 
			Route::get('/', 'Comentarios@index')->name('comentarios');
		});

	});

	/*
	*Rutas para modulos de administracion del proveedor
	*/
	Route::group(['namespace' => 'Administracion'], function(){ 

		/*Rutas para modulo pagos*/
		Route::group(['prefix' => 'pagos',], function(){ 
			Route::get('/', 'Pagos@index')->name('pagos');
		});

		/*Rutas para modulo reportes*/
		Route::group(['prefix' => 'reportes',], function(){ 
			Route::get('/', 'Reportes@index')->name('reportes');
		});

	});
	
	/*
	*Rutas para modulos de inventario del proveedor
	*/
	Route::group(['namespace' => 'Inventario'], function(){ 

		/*Rutas para modulo productos*/
		Route::group(['prefix' => 'productos'], function(){

			Route::get('/', 'Productos@index')->name('productos');

			Route::get('listar', 'Productos@consultarProductos');

			Route::get('agregar', 'Productos@add')->name('agregarProducto');

			Route::get('editar/{id}', 'Productos@add');

			Route::delete('eliminar', 'Productos@delete');

			Route::post('guardar', 'Productos@create');

			Route::post('subirImagen', 'Productos@uploadImage');

			Route::delete('eliminarImagen', 'Productos@deleteImage');

		});
		
		/*Rutas para modulo servicios*/
		Route::group(['prefix' => 'servicios'], function(){ 
			Route::get('/', 'Servicios@index')->name('servicios');

			Route::get('listar', 'Servicios@consultarServicios');

			Route::get('agregar', 'Servicios@add')->name('agregarServicio');

			Route::get('editar/{id}', 'Servicios@add');

			Route::delete('eliminar', 'Servicios@delete');

			Route::post('guardar', 'Servicios@create');

			Route::post('subirImagen', 'Servicios@uploadImage');

			Route::delete('eliminarImagen', 'Servicios@deleteImage');
		});

		/*Rutas para modulo paquetes*/
		Route::group(['prefix' => 'paquetes'], function(){ 
			Route::get('/', 'Paquetes@index')->name('paquetes');
		});
	});
});