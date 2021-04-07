<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consultas';
    public $timestamps = false;

    protected $fillable = [
        'idconsulta', 'email', 'nombre', 'telefono', 'fecha', 'consulta', 'archivo', 'fk_idproducto',
    ];

    public function cargarDesdeRequest($request)
    {
        $this->idconsulta = $request->input('id') != "0" ? $request->input('id') : $this->idconsulta;
        $this->email = $request->input('txtEmail');
        $this->nombre = $request->input('txtNombre');
        $this->telefono = $request->input('txtTelefono');
        $this->fecha = $request->input('txtFecha');
        $this->consulta = $request->input('txtConsulta');
        $this->fk_idproducto = $request->input('lstProducto');
    }

    public function obtenerPorId($idConsulta)
    {
        $sql = "SELECT
            idconsulta,
            email,
            nombre,
            telefono,
            fecha,
            consulta,
            archivo,
            fk_idproducto
            FROM consultas WHERE idconsulta = '$idConsulta'";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idconsulta = $lstRetorno[0]->idconsulta;
            $this->email = $lstRetorno[0]->email;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->consulta = $lstRetorno[0]->consulta;
            $this->archivo = $lstRetorno[0]->archivo;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            return $lstRetorno[0];
        }
        return null;
    }

    public function eliminar()
    {
        $sql = "DELETE FROM consultas WHERE
            idconsulta=?";
        $affected = DB::delete($sql, [$this->idconsulta]);
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                A.idconsulta,
                A.email,
                A.nombre,
                A.telefono,
                A.fecha,
                A.consulta,
                A.archivo,
                A.fk_idproducto
                FROM consultas A
                ORDER BY A.nombre DESC";

        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function insertar()
    {
        $sql = "INSERT INTO consultas (
            email,
            nombre,
            telefono,
            fecha,
            consulta,
            archivo,
            fk_idproducto
        ) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->email,
            $this->nombre,
            $this->telefono,
            $this->fecha,
            $this->consulta,
            $this->archivo,
            $this->fk_idproducto,
        ]);
        $this->idconsulta = DB::getPdo()->lastInsertId();
    }

    public function guardar()
    {
        $sql = "UPDATE consultas SET
            email='$this->email',
            nombre='$this->nombre',
            telefono='$this->telefono',
            fecha='$this->fecha',
            consulta='$this->consulta',
            archivo='$this->archivo',
            fk_idproducto=$this->fk_idproducto
            WHERE idconsulta=?;";
        $affected = DB::update($sql, [$this->idconsulta]);
    }
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.nombre',
            1 => 'A.email',
            2 => 'A.telefono',
            3 => 'A.consulta',
            4 => 'A.archivo',
            
        );
        $sql = "SELECT DISTINCT
                    A.idconsulta,
                    A.nombre,
                    A.email,
                    A.telefono,
                    A.consulta,
                    A.archivo,
                    A.fecha
                    FROM consultas A
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.email LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.telefono LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.consulta LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
        
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

}

