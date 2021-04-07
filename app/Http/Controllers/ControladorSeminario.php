<?php

namespace App\Http\Controllers;

use App\Entidades\Seminario;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorSeminario extends Controller
{
    public function index()
    {
        $titulo = "Seminarios";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MENUCONSULTA")) {
                $codigo = "MENUCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('seminario.seminario-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }


    public function nuevo()
    {
        $titulo = "Nuevo Seminario";

        $seminario = new Seminario();
        $aSeminarios = $seminario->obtenerTodos();


        return view('seminario.seminario-nuevo', compact('titulo', 'aSeminarios'));

    }

    public function guardar(Request $request)
    {   $idseminario=$request['id'];
        try {
            //Define la entidad servicio
            $titulo = "Modificar seminario";
            $entidad = new Seminario();
            $entidad->cargarDesdeRequest($request);
            $idseminario=$_REQUEST['id'];

            if($_FILES["archivo"]["error"] === UPLOAD_ERR_OK){
                $nombre = date("Ymdhmsi") . ".jpg"; 
                $archivo = $_FILES["archivo"]["tmp_name"];
                move_uploaded_file($archivo, env('APP_PATH') . "../public/web/img/$nombre");//guardaelarchivo
                $entidad->imagen =$nombre;
                }   
    

            //validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {

                if ($_POST["id"] > 0) {
                    $seminariAnt = new Seminario();
                    $seminariAnt->obtenerPorId($entidad->idseminario);
           
                    if(isset($_FILES["archivo"]) && $_FILES["archivo"]["name"] != ""){
                        $archivoAnterior =$_FILES["archivo"]["name"];
                        if($archivoAnterior !=""){
                            @unlink (env('APP_PATH') . "../public/web/img/$archivoAnterior");
                        }
                    } else {
                        $entidad->imagen = $seminariAnt->imagen;
                    }


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

                $_POST["id"] = $entidad->idseminario;
                return view('seminario.seminario-nuevo', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idseminario;
        $seminario = new Seminario();
        $seminario->obtenerPorId($id);

        return view('seminario.seminario-nuevo', compact('msg', 'seminario')) . '?id=' . $seminario->idseminario;

    }

        public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("SEMINIARIOELIMINAR")) {

                $seminario = new Seminario();
                $seminario->cargarDesdeRequest($request);
                $seminario->eliminar();

                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            } else {
                $codigo = "ELIMINARSEMINARIO";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/login');
        }
    }
    
    public function editar($id)
    {
        $titulo = "Modificar Seminario";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("MENUMODIFICACION")) {
                $codigo = "MENUMODIFICACION";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $seminario = new Seminario();
                $seminario->obtenerPorId($id);

                return view('seminario.seminario-nuevo', compact('titulo', 'seminario'));
            }
        } else {
            return redirect('admin/login');
        }
    }

      public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Seminario();
        $aSeminarios = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aSeminarios) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/seminario/' . $aSeminarios[$i]->idseminario . '">' . $aSeminarios[$i]->nombre . '</a>';
            $row[] = $aSeminarios[$i]->fecha_curso;
            $row[] = $aSeminarios[$i]->contenido;
            $row[] = $aSeminarios[$i]->horario;
            $row[] = $aSeminarios[$i]->descripcion;
            $row[] = $aSeminarios[$i]->observacion;
            $row[] = '<img src="../web/img/' .  $aSeminarios[$i]->imagen . ' " class="img-thumbnail">';
            $row[] = $aSeminarios[$i]->direccion;
            $row[] = $aSeminarios[$i]->fecha_carga;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aSeminarios), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aSeminarios), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }
}
