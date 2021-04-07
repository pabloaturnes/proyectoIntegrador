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

Route::group(array('domain' => '127.0.0.1'), function () {

    Route::get('/', 'ControladorWebHome@index');
    Route::get('/nosotros', 'ControladorWebNosotros@index');
    Route::get('/contacto', 'ControladorWebContacto@index');
    Route::post('/contacto', 'ControladorWebContacto@guardar');
    Route::get('/confirmacion', 'ControladorWebConfirmacion@index');
    Route::get('/seminarios', 'ControladorWebSeminario@index');
    Route::get('/tienda', 'ControladorWebTienda@index');
    Route::post('/tienda', 'ControladorWebTienda@index');
    Route::get('/producto/agregarAlCarrito', 'ControladorWebTienda@agregarAlCarrito');

    Route::get('/faq', 'ControladorWebFaq@index');
    Route::get('/producto/{id}', 'ControladorWebProducto@index');



    Route::get('/admin/home', 'ControladorHome@index');
    Route::get('/admin', 'ControladorHome@index');
    /* --------------------------------------------- */
    /* CONTROLADOR LOGIN                           */
    /* --------------------------------------------- */
    Route::get('/admin/login', 'ControladorLogin@index');
    Route::get('/admin/logout', 'ControladorLogin@logout');
    Route::post('/admin/logout', 'ControladorLogin@entrar');
    Route::post('/admin/login', 'ControladorLogin@entrar');

    /* --------------------------------------------- */
    /* CONTROLADOR RECUPERO CLAVE                    */
    /* --------------------------------------------- */
    Route::get('/admin/recupero-clave', 'ControladorRecuperoClave@index');
    Route::post('/admin/recupero-clave', 'ControladorRecuperoClave@recuperar');

    /* --------------------------------------------- */
    /* CONTROLADOR PERMISO                           */
    /* --------------------------------------------- */
    Route::get('/admin/usuarios/cargarGrillaFamiliaDisponibles', 'ControladorPermiso@cargarGrillaFamiliaDisponibles')->name('usuarios.cargarGrillaFamiliaDisponibles');
    Route::get('/admin/usuarios/cargarGrillaFamiliasDelUsuario', 'ControladorPermiso@cargarGrillaFamiliasDelUsuario')->name('usuarios.cargarGrillaFamiliasDelUsuario');
    Route::get('/admin/permisos', 'ControladorPermiso@index');
    Route::get('/admin/permisos/cargarGrilla', 'ControladorPermiso@cargarGrilla')->name('permiso.cargarGrilla');
    Route::get('/admin/permiso/nuevo', 'ControladorPermiso@nuevo');
    Route::get('/admin/permiso/cargarGrillaPatentesPorFamilia', 'ControladorPermiso@cargarGrillaPatentesPorFamilia')->name('permiso.cargarGrillaPatentesPorFamilia');
    Route::get('/admin/permiso/cargarGrillaPatentesDisponibles', 'ControladorPermiso@cargarGrillaPatentesDisponibles')->name('permiso.cargarGrillaPatentesDisponibles');
    Route::get('/admin/permiso/{idpermiso}', 'ControladorPermiso@editar');
    Route::post('/admin/permiso/{idpermiso}', 'ControladorPermiso@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR GRUPO                             */
    /* --------------------------------------------- */
    Route::get('/admin/grupos', 'ControladorGrupo@index');
    Route::get('/admin/usuarios/cargarGrillaGruposDelUsuario', 'ControladorGrupo@cargarGrillaGruposDelUsuario')->name('usuarios.cargarGrillaGruposDelUsuario'); //otra cosa
    Route::get('/admin/usuarios/cargarGrillaGruposDisponibles', 'ControladorGrupo@cargarGrillaGruposDisponibles')->name('usuarios.cargarGrillaGruposDisponibles'); //otra cosa
    Route::get('/admin/grupos/cargarGrilla', 'ControladorGrupo@cargarGrilla')->name('grupo.cargarGrilla');
    Route::get('/admin/grupo/nuevo', 'ControladorGrupo@nuevo');
    Route::get('/admin/grupo/setearGrupo', 'ControladorGrupo@setearGrupo');
    Route::post('/admin/grupo/nuevo', 'ControladorGrupo@guardar');
    Route::get('/admin/grupo/{idgrupo}', 'ControladorGrupo@editar');
    Route::post('/admin/grupo/{idgrupo}', 'ControladorGrupo@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR USUARIO                           */
    /* --------------------------------------------- */
    Route::get('/admin/usuarios', 'ControladorUsuario@index');
    Route::get('/admin/usuarios/nuevo', 'ControladorUsuario@nuevo');
    Route::post('/admin/usuarios/nuevo', 'ControladorUsuario@guardar');
    Route::post('/admin/usuarios/{usuario}', 'ControladorUsuario@guardar');
    Route::get('/admin/usuarios/cargarGrilla', 'ControladorUsuario@cargarGrilla')->name('usuarios.cargarGrilla');
    Route::get('/admin/usuarios/buscarUsuario', 'ControladorUsuario@buscarUsuario');
    Route::get('/admin/usuarios/{usuario}', 'ControladorUsuario@editar');

    /* --------------------------------------------- */
    /* CONTROLADOR MENU                             */
    /* --------------------------------------------- */
    Route::get('/admin/sistema/menu', 'ControladorMenu@index');
    Route::get('/admin/sistema/menu/nuevo', 'ControladorMenu@nuevo');
    Route::post('/admin/sistema/menu/nuevo', 'ControladorMenu@guardar');
    Route::get('/admin/sistema/menu/cargarGrilla', 'ControladorMenu@cargarGrilla')->name('menu.cargarGrilla');
    Route::get('/admin/sistema/menu/eliminar', 'ControladorMenu@eliminar');
    Route::get('/admin/sistema/menu/{id}', 'ControladorMenu@editar');
    Route::post('/admin/sistema/menu/{id}', 'ControladorMenu@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR PATENTES                          */
    /* --------------------------------------------- */
    Route::get('/admin/patentes', 'ControladorPatente@index');
    Route::get('/admin/patente/nuevo', 'ControladorPatente@nuevo');
    Route::post('/admin/patente/nuevo', 'ControladorPatente@guardar');
    Route::get('/admin/patente/cargarGrilla', 'ControladorPatente@cargarGrilla')->name('patente.cargarGrilla');
    Route::get('/admin/patente/eliminar', 'ControladorPatente@eliminar');
    Route::get('/admin/patente/nuevo/{id}', 'ControladorPatente@editar');
    Route::post('/admin/patente/nuevo/{id}', 'ControladorPatente@guardar');


    /* --------------------------------------------- */
    /* CONTROLADOR CLIENTES                          */
    /* --------------------------------------------- */
    Route::get('/admin/clientes', 'ControladorCliente@index');
    Route::get('/admin/cliente/nuevo', 'ControladorCliente@nuevo');
    Route::post('/admin/cliente/nuevo', 'ControladorCliente@guardar');
    Route::get('/admin/clientes/cargarGrilla', 'ControladorCliente@cargarGrilla')->name('clientes.cargarGrilla');
    Route::get('/admin/cliente/eliminar', 'ControladorCliente@eliminar');
    Route::get('/admin/cliente/{id}', 'ControladorCliente@editar');
    Route::post('/admin/cliente/{id}', 'ControladorCliente@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR PRODUCTOS                          */
    /* --------------------------------------------- */
    Route::get('/admin/productos', 'ControladorProducto@index');
    Route::get('/admin/producto/nuevo', 'ControladorProducto@nuevo');
    Route::post('/admin/producto/nuevo', 'ControladorProducto@guardar');
    Route::get('/admin/producto/buscarPrecio', 'ControladorProducto@buscarPrecio');
    Route::get('/admin/producto/cargarGrilla', 'ControladorProducto@cargarGrilla')->name('producto.cargarGrilla');
    Route::get('/admin/producto/eliminar', 'ControladorProducto@eliminar');
    Route::get('/admin/producto/{id}', 'ControladorProducto@editar');
    Route::post('/admin/producto/{id}', 'ControladorProducto@guardar');
    

    /* --------------------------------------------- */
    /* CONTROLADOR CATEGORIAS                          */
    /* --------------------------------------------- */
    Route::get('/admin/categorias', 'ControladorCategoria@index');
    Route::get('/admin/categoria/nuevo', 'ControladorCategoria@nuevo');
    Route::post('/admin/categoria/nuevo', 'ControladorCategoria@guardar');
    Route::get('/admin/categoria/cargarGrilla', 'ControladorCategoria@cargarGrilla')->name('categoria.cargarGrilla');
    Route::get('/admin/categoria/eliminar', 'ControladorCategoria@eliminar');
    Route::get('/admin/categoria/{id}', 'ControladorCategoria@editar');
    Route::post('/admin/categoria/{id}', 'Controladorcategoria@guardar');

    /* --------------------------------------------- */
    /* CONTROLADOR PEDIDOS                          */
    /* --------------------------------------------- */
    Route::get('/admin/pedidos', 'ControladorPedido@index');
    Route::get('/admin/pedido/nuevo', 'ControladorPedido@nuevo');
    Route::post('/admin/pedido/nuevo', 'ControladorPedido@guardar');
    Route::get('/admin/pedido/cargarGrilla', 'ControladorPedido@cargarGrilla')->name('pedido.cargarGrilla');
    Route::get('admin/pedido/eliminar', 'ControladorPedido@eliminar');
    Route::get('/admin/pedido/pedido-presupuesto', 'ControladorPedidoPresupuesto@nuevo');
    Route::post('/admin/pedido/pedido-presupuesto', 'ControladorPedidoPresupuesto@guardar');
    Route::get('/admin/pedido/{id}', 'ControladorPedido@editar');


    /* --------------------------------------------- */
    /* CONTROLADOR SEMINIARIO                          */
    /* --------------------------------------------- */
    Route::get('/admin/seminarios', 'ControladorSeminario@index');
    Route::get('/admin/seminario/nuevo', 'ControladorSeminario@nuevo');
    Route::post('/admin/seminario/nuevo', 'ControladorSeminario@guardar');
    Route::post('/admin/seminario/{id}', 'ControladorSeminario@guardar');
    Route::get('/admin/seminario/{id}', 'ControladorSeminario@editar');
    Route::get('/admin/seminarios/cargarGrilla', 'ControladorSeminario@cargarGrilla')->name('seminarios.cargarGrilla');
    /* --------------------------------------------- */
    /* CONTROLADOR CONSULTAS                          */
    /* --------------------------------------------- */
    Route::get('/admin/consultas', 'ControladorConsulta@index');
    Route::get('/admin/consulta/nuevo', 'ControladorConsulta@nuevo');
    Route::post('/admin/consulta/nuevo', 'ControladorConsulta@guardar');
    Route::get('/admin/consulta/cargarGrilla', 'ControladorConsulta@cargarGrilla')->name('consulta.cargarGrilla');
    Route::get('/admin/consulta/eliminar', 'ControladorConsulta@eliminar');
    Route::get('/admin/consulta/{id}', 'ControladorConsulta@editar');
    Route::post('/admin/consulta/{id}', 'ControladorConsulta@guardar');


/* --------------------------------------------- */
    /* CONTROLADOR CARRITO                         */
    /* --------------------------------------------- */
    Route::get('/admin/carrito', 'ControladorCarrito@index');
    Route::get('/admin/carrito/nuevo', 'ControladorCarrito@nuevo');
    Route::post('/admin/carrito/nuevo', 'ControladorCarrito@guardar');
    Route::get('/admin/carrito/{id}', 'ControladorCarrito@editar');
});
