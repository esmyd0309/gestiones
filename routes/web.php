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

Route::group(['middleware' => ['guest']], function () {
	//User guest
	Route::get('/','Auth\LoginController@formLogin');
	//Route::get('/','HomeController@inicio');
    Route::get('/login','Auth\LoginController@formLogin');
    Route::post('/login','Auth\LoginController@login')->name('login');
});

Route::get('/users/create', 'UserController@create')->name('users.create');
	



Route::group(['middleware' => ['auth']], function () {
	// User auth
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

	Route::get('/inicio', 'HomeController@index')->name('inicio');

	Route::get('/perfil/edit', 'PerfilController@edit')->name('perfil.edit');
	Route::post('/perfil/{user}', 'PerfilController@update')->name('perfil.update');


	/*Route::get('/api/roles/{id}', function ($id){
		$rol = App\Models\Admin\Role::with('usuarioRoles')->with('usuarioRoles.user')->findOrFail($id);
		return response()->json($rol);
	});*/


	/*
	*
	*
	Permission routes
	*/

	/**
		Usuario
	*/
	Route::group(['middleware' => ['perfil']], function () {

		Route::group(['middleware' => ['permission:users.store']], function () {
			Route::post('/users/store', 'UserController@store')->name('users.store');
		});

		Route::group(['middleware' => ['permission:users.index']], function () {
			Route::get('/users/index', 'UserController@index')->name('users.index');
		});

	
			
		Route::group(['middleware' => ['permission:users.update']], function () {
			Route::put('/users/{user}', 'UserController@update')->name('users.update');
		});

		Route::group(['middleware' => ['permission:users.destroy']], function () {
			Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');
		});

		Route::group(['middleware' => ['permission:users.show']], function () {
			Route::get('/users/{id}', 'UserController@show')->name('users.show');
		});

		Route::group(['middleware' => ['permission:users.edit']], function () {
			Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
		});

		Route::group(['middleware' => ['permission:users.position']], function () {
			Route::get('/users/{id}/position', 'UserController@position')->name('users.position');
		});

		Route::group(['middleware' => ['permission:users.assign']], function () {
			Route::put('/users/assign/{user}', 'UserController@assign')->name('users.assign');
		});




		/**
			Rol
		*/
		Route::group(['middleware' => ['permission:roles.store']], function () {
			Route::post('/roles/store', 'RolController@store')->name('roles.store');
		});

		Route::group(['middleware' => ['permission:roles.index']], function () {
			Route::get('/roles/index', 'RolController@index')->name('roles.index');
		});

		Route::group(['middleware' => ['permission:roles.create']], function () {
			Route::get('/roles/create', 'RolController@create')->name('roles.create');
		});

		Route::group(['middleware' => ['permission:roles.update']], function () {
			Route::put('/roles/{role}', 'RolController@update')->name('roles.update');
		});

		Route::group(['middleware' => ['permission:roles.destroy']], function () {
			Route::delete('/roles/{id}', 'RolController@destroy')->name('roles.destroy');
		});

		Route::group(['middleware' => ['permission:roles.show']], function () {
			Route::get('/roles/{id}', 'RolController@show')->name('roles.show');
		});

		Route::group(['middleware' => ['permission:roles.edit']], function () {
			Route::get('/roles/{id}/edit', 'RolController@edit')->name('roles.edit');
		});



		/**
			Permisos
		*/
		Route::group(['middleware' => ['permission:permissions.store']], function () {
			Route::post('/permissions/store', 'PermisoController@store')->name('permissions.store');
		});

		Route::group(['middleware' => ['permission:permissions.index']], function () {
			Route::get('/permissions/index', 'PermisoController@index')->name('permissions.index');
		});

		Route::group(['middleware' => ['permission:permissions.create']], function () {
			Route::get('/permissions/create', 'PermisoController@create')->name('permissions.create');
		});

		Route::group(['middleware' => ['permission:permissions.update']], function () {
			Route::put('/permissions/{permission}', 'PermisoController@update')->name('permissions.update');
		});

		Route::group(['middleware' => ['permission:permissions.destroy']], function () {
			Route::delete('/permissions/{id}', 'PermisoController@destroy')->name('permissions.destroy');
		});

		Route::group(['middleware' => ['permission:permissions.show']], function () {
			Route::get('/permissions/{id}', 'PermisoController@show')->name('permissions.show');
		});

		Route::group(['middleware' => ['permission:permissions.edit']], function () {
			Route::get('/permissions/{id}/edit', 'PermisoController@edit')->name('permissions.edit');
		});



	});

});



Route::get('/cifrar/{pass}', function ($pass) {
	$opciones = [
    	'cost' => 12,
	];

	echo password_hash($pass, PASSWORD_BCRYPT, $opciones)."\n";
});
Route::group(['middleware' => ['cors']], function () {
	//Rutas a las que se permitirá acceso
	Route::post('usersdd', 'UserApiController@store');
	Route::get('usuariosActuales/{usuario}', 'UserApiController@usuariosActuales')->name('usuariosActuales');
	Route::get('crearUser/{parametros}', 'UserApiController@crearUser')->name('crearUser');

});

Route::get('password/reset', 'Auth\ForgotPasswordController@SendsPasswordResetEmails')->name('password.request');






Route::resource('contactos', 'DatatelefonoController');
Route::put('actualizar', 'DatatelefonoController@actualizar')->name('actualizar');


/***
 * lista de contactos
 */
Route::get('listacontactos', 'ApiController@listacontactos')->name('listacontactos');

Route::get('consultarcontacto/{id}', 'ApiController@consultarcontacto')->name('consultarcontacto');

Route::post('guardarcontacto', 'DatatelefonoController@guardarcontacto')->name('guardarcontacto');
Route::get('contactos/getcanton/{provincia}', 'ApiController@getcanton');
Route::get('contactos/getSector/{canton}', 'ApiController@getSector');

Route::get('getprovincia', 'ApiController@getprovincia');

		/***
		 * 
		 * CLIENTES 
		 * 
		 */

		 	/*** APIS */
			 Route::get('clientes', 'Clientes\ClientesController@clientes')->name('clientes');
			 Route::get('listaclientes', 'Clientes\ClientesController@listaclientes')->name('listaclientes');
			 Route::post('guardarcliente', 'Clientes\ClientesController@guardarcliente')->name('guardarcliente');
			 Route::post('inicio/guardarcliente', 'Clientes\ClientesController@guardarcliente')->name('guardarcliente');
			 Route::delete('deletecliente/{id}', 'Clientes\ClientesController@deletecliente')->name('deletecliente');
			 Route::put('actualizarcliente', 'Clientes\ClientesController@actualizarcliente')->name('actualizarcliente');
			 Route::get('dataclientes/{dato}', 'Clientes\ClientesController@dataclientes')->name('dataclientes');
			 Route::get('getclientesall', 'Clientes\ClientesController@getclientesall')->name('getclientesall');

			 
		/****
		 * 
		 * CATEGORIAS
		 * 
		 */
		Route::get('categorias', 'Categorias\ApiCategoriaController@all');
		Route::get('categorias/getproductos/{id}', 'Productos\ApiProductoController@getproductos');

		/***
		 * 
		 * 
		 */
		Route::post('guardarcarrito', 'Carrito\CarritoController@guardarcarrito')->name('guardarcarrito');
		Route::get('clientecarrito/{id}', 'Carrito\CarritoController@clientecarrito')->name('clientecarrito');
		Route::get('clientecarritodetalle/{id}', 'Carrito\CarritoController@clientecarritodetalle')->name('clientecarritodetalle');

		/***
		 * PRODUCTOS
		 * 
		 */

		 /*** APIS */
		 Route::get('productos', 'Productos\ApiProductoController@index')->name('productos');
		 Route::get('listaproductos', 'Productos\ApiProductoController@listaproductos')->name('listaproductos');
		 Route::get('productos/categorias/{id}', 'Categorias\ApiCategoriaController@categoria');
		 Route::post('productos/guardarproducto', 'Productos\ApiProductoController@guardarproducto')->name('guardarproducto');
	
		Route::put('productos/actualizarproducto', 'Productos\ApiProductoController@actualizarproducto')->name('actualizarproducto');
		Route::get('deleteproducto/{dato}', 'Productos\ApiProductoController@deleteproducto')->name('deleteproducto');
		
		/***
		 * 
		 * Reportes
		 * 
		 */

		Route::get('reportes', 'Reportes\ReportesController@index')->name('reportes');
		Route::get('reportes/clientes', 'Reportes\ApireportesController@clientes');
