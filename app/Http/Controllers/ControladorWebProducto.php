<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Producto;

require app_path() . '/start/constants.php';

class ControladorWebProducto extends Controller
{
    public function index($idProducto)
    {
        $producto = new Producto();
        $producto->obtenerPorId($idProducto);
        return view('web.producto', compact('producto'));
    }
}