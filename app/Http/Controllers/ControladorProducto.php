<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;
use App\Entidades\Categoria;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorProducto extends Controller
{
    public function index()
    {
        $titulo = "Productos";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PRODUCTOCONSULTA")) {
                $codigo = "PRODUCTOCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('producto.producto-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }


    public function nuevo()
    {
        $titulo = "Nuevo Producto";

        $entidad = new Categoria();
        $array_categorias = $entidad->obtenerTodos();

        return view('producto.producto-nuevo', compact('titulo', 'array_categorias'));

    }

    public function guardar(Request $request)
    {   $idproducto=$request['id'];
        try {
            //Define la entidad servicio
            $titulo = "Guardar Producto";
            $entidad = new Producto();
            $entidad->cargarDesdeRequest($request);
            $idproducto=$_REQUEST['id'];

            if($_FILES["archivo"]["error"] === UPLOAD_ERR_OK){
            $nombre = date("Ymdhmsi") . ".jpg"; 
            $archivo = $_FILES["archivo"]["tmp_name"];
            move_uploaded_file($archivo, env('APP_PATH') . "/public/web/img/$nombre");//guardaelarchivo
            $entidad->imagen =$nombre;
            }   

            $categoria = new Categoria();
            $array_categorias = $categoria->obtenerTodos();

            //validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {

                if ($_POST["id"] > 0) {
                    $productAnt = new Producto();
                    $productAnt->obtenerPorId($entidad->idproducto);
           
                    if(isset($_FILES["archivo"]) && $_FILES["archivo"]["name"] != ""){
                        $archivoAnterior =$_FILES["archivo"]["name"];
                        if($archivoAnterior !=""){
                            @unlink (env('APP_PATH') . "/public/web/img/$archivoAnterior");
                        }
                    } else {
                        $entidad->imagen = $productAnt->imagen;
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

                $_POST["id"] = $entidad->idproducto;
                return view('producto.producto-nuevo', compact('titulo', 'msg', 'array_categorias'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idproducto;
        $producto = new Producto();
        $producto->obtenerPorId($id);

        return view('producto.producto-nuevo', compact('msg', 'producto', 'titulo')) . '?id=' . $producto->idproducto;

    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Producto();
        $aProductos = $entidad->obtenerFiltrado();

        $data = array();

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        if (count($aProductos) > 0) {
            $cont = 0;
        }

        for ($i = $inicio; $i < count($aProductos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/producto/' . $aProductos[$i]->idproducto . '">' . $aProductos[$i]->nombre . '</a>';
            $row[] = $aProductos[$i]->stock;
            $row[] = $aProductos[$i]->precio;
            $row[] = $aProductos[$i]->descripcion;
            $row[] = '<img src="/web/img/' . $aProductos[$i]->imagen . '" class="img-thumbnail">';
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aProductos), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aProductos), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function editar($id)
    {
        $titulo = "Modificar Producto";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PRODUCTOEDITAR")) {
                $codigo = "PRODUCTOEDITAR";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $producto = new Producto();
                $producto->obtenerPorId($id);

                $categoria = new Categoria();
                $array_categorias = $categoria->obtenerTodos();

                return view('producto.producto-nuevo', compact('producto', 'titulo', 'array_categorias'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("PRODUCTOBAJA")) {

                $producto = new Producto();
                $producto->cargarDesdeRequest($request);
                $producto->eliminar();

                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            } else {
                $codigo = "ELIMINARPROFESIONAL";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/login');
        }
    }

    public function buscarPrecio(Request $request) {
        $idProducto = $request->input('id');

        $producto = new Producto();
        $producto->obtenerPorId($idProducto);

        $aResultado["err"] = EXIT_SUCCESS;
        $aResultado["precio"] = $producto->precio;
        echo json_encode($aResultado);
    }

}
