<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';
    public $timestamps = false;

    protected $fillable = [
        'idlocalidad', 'nombre', 
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request)
    {
        $this->idlocalidad = $request->input('id') != "0" ? $request->input('id') : $this->idlocalidad;
        $this->nombre = $request->input('txtNombre');
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idlocalidad,
                  A.nombre
                FROM localidades A WHERE A.fk_idprovincia = 1 ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idlocalidad)
    {
        $sql = "SELECT
                idlocalidad,
                nombre
                FROM localidades WHERE idlocalidad = $idlocalidad";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idlocalidad = $lstRetorno[0]->idlocalidad;
            $this->nombre = $lstRetorno[0]->nombre;
            return $this;
        }
        return null;
    }

    public function insertar()
    {
        $sql = "INSERT INTO localidades (
                nombre
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
        ]);
        return $this->idlocalidad = DB::getPdo()->lastInsertId();
    }

    public function guardar()
    {
        $sql = "UPDATE localidades SET
            nombre='$this->nombre'
            WHERE idlocalidad=?";
        $affected = DB::update($sql, [$this->idlocalidad]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM localidades WHERE
            idlocalidad=?";
        $affected = DB::delete($sql, [$this->idlocalidad]);
    }

}
