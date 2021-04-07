<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


require app_path() . '/start/constants.php';

class ControladorWebConfirmacion extends Controller
{
    public function index()
    {
        return view('web.confirmacion');
    }

  
}