<?php

namespace App\Http\Controllers;

use App\Entidades\Cliente;
use App\Entidades\Localidad;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorCliente extends Controller
{
    public function index()
    {
        $titulo = "Clientes";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("CLIENTECONSULTA")) {
                $codigo = "CLIENTECONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('cliente.cliente-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }


    public function nuevo()
    {
        $titulo = "Nuevo Cliente";

        $cliente = new Cliente();
        $aClientes = $cliente->obtenerTodos();

        $localidad = new Localidad();
        $array_localidades = $localidad->obtenerTodos();

        return view('cliente.cliente-nuevo', compact('titulo', 'aClientes','array_localidades'));

    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("CLIENTEELIMINAR")) {

                $cliente = new Cliente();
                $cliente->cargarDesdeRequest($request);
                $cliente->eliminar();

                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            } else {
                $codigo = "ELIMINARCLIENTE";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/login');
        }
    }
    
    public function editar($id)
    {
        $titulo = "Modificar Cliente";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MENUMODIFICACION")) {
                $codigo = "MENUMODIFICACION";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $cliente = new Cliente();
                $cliente->obtenerPorId($id);

                $entidad = new Localidad();
                $array_localidades = $entidad->obtenerTodos();


                return view('cliente.cliente-nuevo', compact('cliente', 'titulo', 'array_localidades'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad cliente
            $titulo = "Guardar Cliente";

            $cliente = new Cliente();
            $cliente->cargarDesdeRequest($request);

            //validaciones
            if ($cliente->nombre == "" || $cliente->direccion == "" || $cliente->telefono == "" )  {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion
                    $cliente->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //Es nuevo
                    $cliente->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                }
       
                $_POST["id"] = $cliente->idcliente;
                return view('cliente.cliente-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $cliente = new Cliente();
        $aClientes = $cliente->obtenerPorId();

        $localidad = new Localidad();
        $array_localidades = $localidad->obtenerTodos();


        return view('sistema.cliente-nuevo', compact('msg', 'titulo', 'aClientes','array_localidades')) . '?id=' . $cliente->idcliente;

    }

      public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Cliente();
        $aClientes = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aClientes) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/cliente/' . $aClientes[$i]->idcliente . '">' . $aClientes[$i]->nombre . '</a>';
            $row[] = $aClientes[$i]->dni;
            $row[] = $aClientes[$i]->telefono;
            $row[] = $aClientes[$i]->localidad;
            $row[] = $aClientes[$i]->direccion;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aClientes), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aClientes), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }
}
