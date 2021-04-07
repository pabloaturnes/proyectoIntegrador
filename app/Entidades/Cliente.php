<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    public $timestamps = false;

    protected $fillable = [
        'idcliente', 'nombre', 'dni', 'telefono', 'fk_idlocalidad', 'direccion', 'codigo_postal'
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request)
    {
        $this->idcliente = $request->input('id') != "0" ? $request->input('id') : $this->idcliente;
        $this->nombre = $request->input('txtNombre');
        $this->dni = $request->input('txtDni') != "" ? $request->input('txtDni') : 0;
        $this->telefono = $request->input('txtTelefono') != "" ? $request->input('txtTelefono') : 0;
        $this->fk_idlocalidad = $request->input('lstLocalidad');
        $this->direccion = $request->input('txtDireccion');
        $this->codigo_postal = $request->input('txtCodigoPostal');
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idcliente,
                  A.nombre,
                  A.dni,
                  A.telefono,
                  A.fk_idlocalidad,
                  A.direccion,
                  A.codigo_postal
                FROM clientes A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idCliente)
    {
        $sql = "SELECT
                idcliente,
                nombre,
                dni,
                telefono,
                fk_idlocalidad,
                direccion,
                codigo_postal
                FROM clientes WHERE idcliente = $idCliente";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->dni = $lstRetorno[0]->dni;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->fk_idlocalidad = $lstRetorno[0]->fk_idlocalidad;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->codigo_postal = $lstRetorno[0]->codigo_postal;
            return $this;
        }
        return null;
    }

    public function insertar()
    {
        $sql = "INSERT INTO clientes (
                nombre,
                telefono,
                dni,
                fk_idlocalidad,
                direccion,
                codigo_postal
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->telefono,
            $this->dni,
            $this->fk_idlocalidad,
            $this->direccion,
            $this->codigo_postal,
        ]);
        return $this->idcliente = DB::getPdo()->lastInsertId();
    }

    public function guardar()
    {
        $sql = "UPDATE clientes SET
            nombre='$this->nombre',
            telefono='$this->telefono',
            dni='$this->dni',
            fk_idlocalidad=$this->fk_idlocalidad,
            direccion='$this->direccion',
            codigo_postal='$this->codigo_postal'
            WHERE idcliente=?";
        $affected = DB::update($sql, [$this->idcliente]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM clientes WHERE
            idcliente=?";
        $affected = DB::delete($sql, [$this->idcliente]);
    }


    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.nombre',
            1 => 'A.dni',
            2 => 'A.telefono',
            3 => 'B.nombre',
            4 => 'A.direccion',
            5 => 'A.codigo_postal'
        );
        $sql = "SELECT DISTINCT
                    A.idcliente,
                    A.nombre,
                    A.dni,
                    A.telefono,
                    B.nombre as localidad,
                    A.direccion,
                    A.codigo_postal
                    FROM clientes A
                    LEFT JOIN localidades B ON A.fk_idlocalidad = B.idlocalidad
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.dni LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.telefono LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.direccion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.codigo_postal LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }




}