<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    public $timestamps = false;

    protected $fillable = [
        'idpedido',
        'fecha',
        'cantidad',
        'preciounitario',
        'total',
        'direccion',
        'codigo_postal',
        'cantidadpersonas',
        'fecha_entrega',
        'comentario',
        'fk_idcliente',
        'fk_idproducto',
        'fk_idlocalidad',
        'fk_idestadopedido'
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request)
    {
        $this->idpedido = $request->input('id') != "0" ? $request->input('id') : $this->idpedido;
        $this->fecha= $request->input('txtFecha');
        $this->cantidad = $request->input('txtCantidad');
        $this->preciounitario = $request->input('txtPrecioUni') != "" ? $request->input('txtPrecioUni') : 0;
        $this->total = $request->input('txtTotal');
        $this->direccion = $request->input('txtDireccion');
        $this->codigo_postal = $request->input('codigoPostal');
        $this->cantidadpersonas = $request->input('txtCantidadPersonas');
        $this->fecha_entrega = $request->input('txtFechaEntrega');
        $this->comentario = $request->input('txtComentario');
        $this->fk_idcliente = $request->input('lstCliente');
        $this->fk_idproducto = $request->input('lstProducto');
        $this->fk_idlocalidad = $request->input('lstLocalidad');
        $this->fk_idestadopedido = $request->input('lstEstadoPedido');
  
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idpedido,
                  A.fecha,
                  A.cantidad,
                  A.preciounitario,
                  A.total,
                  A.direccion,
                  A.codigo_postal,
                  A.cantidadpersonas,
                  A.fecha_entrega,
                  A.comentario,
                  A.fk_idcliente,
                  A.fk_idproducto,
                  A.fk_idlocalidad,
                  A.fk_idestadopedido
                FROM pedidos A ORDER BY A.idpedido";
        $lstPedidos = DB::select($sql);
        return $lstPedidos;
    }

    public function obtenerPorId($idpedido)
    {
        $sql = "SELECT *
                FROM pedidos WHERE idpedido = $idpedido";
        $lstPedidos = DB::select($sql);

        if (count($lstPedidos) > 0) {
            $this->idpedido = $lstPedidos[0]->idpedido;
            $this->fecha = $lstPedidos[0]->fecha;
            $this->cantidad = $lstPedidos[0]->cantidad;
            $this->preciounitario = $lstPedidos[0]->preciounitario;
            $this->total = $lstPedidos[0]->total;
            $this->direccion = $lstPedidos[0]->direccion;
            $this->codigo_postal = $lstPedidos[0]->codigo_postal;
            $this->cantidadpersonas = $lstPedidos[0]->cantidadpersonas;
            $this->fecha_entrega = $lstPedidos[0]->fecha_entrega;
            $this->comentario = $lstPedidos[0]->comentario;
            $this->fk_idcliente = $lstPedidos[0]->fk_idcliente;
            $this->fk_idproducto = $lstPedidos[0]->fk_idproducto;
            $this->fk_idlocalidad = $lstPedidos[0]->fk_idlocalidad;
            $this->fk_idestadopedido = $lstPedidos[0]->fk_idestadopedido;
   
            return $this;
        }
        return null;
    }

    public function insertar()
    {
        $sql = "INSERT INTO pedidos (
                    fecha,
                    cantidad,
                    preciounitario,
                    total,
                    direccion,
                    codigo_postal,
                    cantidadpersonas,
                    fecha_entrega,
                    comentario,
                    fk_idcliente,
                    fk_idproducto,
                    fk_idlocalidad,
                    fk_idestadopedido
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $result = DB::insert($sql, [
            $this->fecha,
            $this->cantidad,
            $this->preciounitario,
            $this->total,
            $this->direccion,
            $this->codigo_postal,
            $this->cantidadpersonas,
            $this->fecha_entrega,
            $this->comentario,
            $this->fk_idcliente,
            $this->fk_idproducto,
            $this->fk_idlocalidad,
            $this->fk_idestadopedido
        ]);
        return $this->idpedido = DB::getPdo()->lastInsertId();
    }

    public function guardar()
    {
        $sql = "UPDATE pedidos SET
            fecha='$this->fecha',
            cantidad=$this->cantidad,
            preciounitario=$this->preciounitario,
            total=$this->total,
            direccion='$this->direccion',
            codigo_postal='$this->codigo_postal',
            cantidadpersonas=$this->cantidadpersonas,
            fecha_entrega='$this->fecha_entrega',
            comentario='$this->comentario',
            fk_idcliente=$this->idcliente,
            fk_idproducto=$this->idproducto,
            fk_idlocalidad=$this->idlocalidad,
            fk_idestadopedido=$this->idestadopedido

            WHERE idpedido=?";
        $affected = DB::update($sql, [$this->idpedido]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM pedidos WHERE
            idpedido=?";
        $affected = DB::delete($sql, [$this->idpedido]);
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.fecha',
            1 => 'A.fecha_entrega',
            2 => 'C.nombre',
            3 => 'A.producto',
            4 => 'A.total',
            5 => 'B.direccion',
        );
        $sql = "SELECT DISTINCT
                    A.idpedido,
                    A.fecha,
                    A.fecha_entrega,
                    B.nombre as nombre,
                    C.nombre as producto,
                    A.total,
                    B.direccion,
                    A.fk_idcliente
                    FROM pedidos A
                    LEFT JOIN clientes B ON A.fk_idcliente = B.idcliente
                    LEFT JOIN productos C ON A.fk_idproducto = C.idproducto
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.url LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

}
