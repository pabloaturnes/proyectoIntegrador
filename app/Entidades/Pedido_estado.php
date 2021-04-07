<?php


namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido_estado extends Model
{

    protected $table = 'pedidos_estados';
    public $timestamps = false;

    protected $fillable = [
        'idpedidoproducto',
        'nombre'
    ];


    protected $hidden = [

    ];

    public function cargarDesdeRequest($request)
    {
        $this->idpedidoproducto = $request->input('id') != "0" ? $request->input('id') : $this->idpedidoproducto;
        $this->nombre = $request->input('txtNombre');

    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  idpedidoproducto,
                  nombre
                FROM pedidos_estados  ORDER BY idpedidoproducto";
        $lstPedidosEstados = DB::select($sql);
        return $lstPedidosEstados;
    }

    public function obtenerPorId($idpedidoProducto)
    {
        $sql = "SELECT
                    idpedidoproducto,
                    nombre
                FROM pedidos_estados WHERE idpedidoproducto = $idpedidoProducto";
        $lstPedidosEstados = DB::select($sql);

        if (count($lstPedidosEstados) > 0) {
            $this->idpedidoProducto = $lstPedidosEstados[0]->idpedidoProducto;
            $this->nombre = $lstPedidosEstados[0]->nombre;

            return $this;
        }
        return null;
    }

    public function insertar()
    {
        $sql = "INSERT INTO pedidos_estados (
                    nombre          
            ) VALUES (?);";
        $result = DB::insert($sql, [
            $this->nombre

        ]);
        return $this->idpedidoProducto = DB::getPdo()->lastInsertId();
    }

    public function guardar()
    {
        $sql = "UPDATE pedidos_estados SET
            nombre='$this->nombre'
         

            WHERE idpedidoProducto=?";
        $affected = DB::update($sql, [$this->idpedidoProducto]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM pedidos_estados WHERE
            idpedido=?";
        $affected = DB::delete($sql, [$this->idpedidoProducto]);
    }

}