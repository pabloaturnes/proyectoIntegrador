<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Categoria;
use App\Entidades\Producto;

require app_path() . '/start/constants.php';

class ControladorWebTienda extends Controller
{
    public function index(Request $request)
    {
        
        $idcategoria = $request->input("cat"); 
        $txtBusqueda = $request->input("txtBusqueda"); 


        $categoria = new Categoria();
        $aCategorias = $categoria->obtenerTodos();

        $producto = new Producto();

        if($idcategoria>0){
            $aProductos = $producto->obtenerProductoPorCategoria($idcategoria,$txtBusqueda);
        }else {
            $aProductos = $producto->obtenerTodos($txtBusqueda);
        }


        return view('web.tienda', compact('aProductos','aCategorias'));

    }

    public function agregarAlCarrito(Request $request){
        $idProducto= $request->input("idproducto");
        //Agrego un elemento en la primer posicion libre del carrito
        if(!Session::get('array_carrito')){
            Session::put('array_carrito', array());
        }
        $array_carrito= Session::get('array_carrito');
        $array_carrito[] = $idProducto;
        Session::put('array_carrito', $array_carrito);
        $aResultado["err"] = EXIT_SUCCESS; 
        $aResultado["cantidad"] = count($array_carrito);
        echo json_encode($aResultado); 
    }


}


