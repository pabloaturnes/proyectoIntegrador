<?php

namespace App\Http\Controllers;

use App\Entidades\Sistema\Menu;
use App\Entidades\Sistema\MenuArea;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorWebHome extends Controller
{
    public function index()
    { 
        return view('web.index');
    }
}