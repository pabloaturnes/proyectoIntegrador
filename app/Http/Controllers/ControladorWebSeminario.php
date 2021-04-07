<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Seminario;

require app_path() . '/start/constants.php';

class ControladorWebSeminario extends Controller
{
    public function index()
    {
        $seminario = new Seminario();
        $aSeminarios = $seminario->obtenerTodos();
        return view('web.seminarios', compact('aSeminarios'));
    }
}