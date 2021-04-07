<?php

namespace App\Http\Controllers;

use App\Entidades\Cliente;
use App\Entidades\Localidad;
use App\Entidades\Pedido;
use App\Entidades\Producto;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorPedido extends Controller
{
    public function index()
    {
        $titulo = "Pedidos";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PEDIDOCONSULTA")) {
                $codigo = "PEDIDOCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('pedido.pedido-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function nuevo()
    {
        $titulo = "Nuevo pedido";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PEDIDOALTA")) {
                $codigo = "PEDIDOALTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $titulo = "Nuevo pedido";

                $cliente = new Cliente();
                $array_clientes = $cliente->obtenerTodos();

                $producto = new Producto();
                $array_productos = $producto->obtenerTodos();

                $localidad = new Localidad();
                $array_localidades = $localidad->obtenerTodos();

                return view('pedido.pedido-nuevo', compact('titulo', 'array_clientes', 'array_productos', 'array_localidades'));
            }
        } else {
            return redirect('admin/login');
        }

    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("PEDIDOELIMINAR")) {

                $pedido = new Pedido();
                $pedido->cargarDesdeRequest($request);
                $pedido->eliminar();

                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            } else {
                $codigo = "PEDIDOELIMINAR";
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
            $titulo = "Modificar pedido";
            $entidad = new Pedido();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->fk_idcliente == "" || $entidad->fk_idproducto == "" || $entidad->fk_idlocalidad == "") {
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

                $_POST["id"] = $entidad->idpedido;
                return view('pedido.pedido-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idpedido;
        $pedido = new Pedido();
        $pedido->obtenerPorId($id);

        $cliente = new Cliente();
        $array_clientes = $cliente->obtenerTodos();

        $producto = new Producto();
        $array_productos = $producto->obtenerTodos();

        $localidad = new Localidad();
        $array_localidades = $localidad->obtenerTodos();

        return view('pedido.pedido-nuevo', compact('msg', 'titulo', 'pedido', 'array_clientes', 'array_productos', 'array_localidades')) . '?id=' . $pedido->idpedido;

    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidadPedido = new Pedido();
        $aPedido = $entidadPedido->obtenerFiltrado();

        $data = array();

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        if (count($aPedido) > 0) {
            $cont = 0;
        }

        for ($i = $inicio; $i < count($aPedido) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/sistema/pedido/' . $aPedido[$i]->idpedido . '">' . $aPedido[$i]->fecha . '</a>';
            $row[] = $aPedido[$i]->fecha_entrega;
            $row[] = $aPedido[$i]->nombre;
            $row[] = $aPedido[$i]->producto;
            $row[] = $aPedido[$i]->total;
            $row[] = $aPedido[$i]->direccion;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aPedido), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aPedido), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function editar($id)
    {
        $titulo = "Modificar Pedido";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("PEDIDOMODIFICACION")) {
                $codigo = "PEDIDOMODIFICACION";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $pedido = new Pedido();
                $pedido->obtenerPorId($id);

                $entidad = new Pedido();
                $array_pedido = $entidad->obtenerPorId($id);

                return view('pedido.pedido-nuevo', compact('pedido', 'titulo', 'array_pedido'));
            }
        } else {
            return redirect('admin/login');
        }
    }
}
