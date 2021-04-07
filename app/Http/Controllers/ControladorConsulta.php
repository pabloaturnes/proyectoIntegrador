<?php

namespace App\Http\Controllers;

use App\Entidades\Cliente;
use App\Entidades\Consulta;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorConsulta extends Controller
{
    public function index()
    {
        $titulo = "Consultas";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("CONSULTACONSULTA")) {
                $codigo = "CONSULTACONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view("consulta.consulta-listar", compact("titulo"));

            }
        } else {
            return redirect('admin/login');
        }
    }

    public function nuevo()
    {
        $titulo = "Nueva consulta";
        $consulta = new Consulta();
        $aConsultas = $consulta->obtenerTodos();

        return view('consulta.consulta-nuevo', compact('titulo'));
    }

    public function editar($id)
    {
        $titulo = "Modificar Consulta";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("CONSULTAMODIFICACION")) {
                $codigo = "CONSULTAMODIFICACION";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $consulta = new Consulta();
                $consulta->obtenerPorId($id);

                return view('consulta.consulta-nuevo', compact('consulta', 'titulo', 'consulta'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("CONSULTAELIMINAR")) {

                $consulta = new Consulta();
                $consulta->cargarDesdeRequest($request);
                $consulta->eliminar();

                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            } else {
                $codigo = "CONSULTAELIMINAR";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/login');
        }
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar Consulta";
            $entidad = new Consulta();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->nombre == "" || $entidad->consulta == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion
                    $entidad->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //Es nuevo
                    $entidad->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                }

                $_POST["id"] = $entidad->idconsulta;
                return view('consulta.consulta-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idconsulta;
        $consulta = new Consulta();
        $consulta->obtenerPorId($id);

        return view('consulta.consulta-nuevo', compact('titulo', 'consulta', 'msg')) . '?id=' . $consulta->idconsulta;

    }
    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Consulta();
        $aConsultas = $entidad->obtenerFiltrado();

        $data = array();

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        if (count($aConsultas) > 0) {
            $cont = 0;
        }

        for ($i = $inicio; $i < count($aConsultas) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/consulta/' . $aConsultas[$i]->idconsulta . '">' . $aConsultas[$i]->fecha . '</a>';
            $row[] = $aConsultas[$i]->nombre;
            $row[] = $aConsultas[$i]->email;
            $row[] = $aConsultas[$i]->telefono;
            $row[] = $aConsultas[$i]->consulta;
            $cont++;
            $data[] = $row;
        }
        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aConsultas), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aConsultas), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);

    }

}
