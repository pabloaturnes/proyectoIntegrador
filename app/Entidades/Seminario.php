<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Seminario extends Model
{
    protected $table = 'seminarios';
    public $timestamps = false;

    protected $fillable = [
        'idseminario', 'nombre', 'fecha_curso', 'contenido', 'horario', 'descripcion', 'observacion', 'imagen', 'direccion', 'fecha_carga'
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request)
    {
        $this->idseminario = $request->input('id') != "0" ? $request->input('id') : $this->idseminario;
        $this->nombre = $request->input('txtNombre');
        $this->fecha_curso = $request->input('txtFechaCurso');
        $this->contenido = $request->input('txtContenido');
        $this->horario = $request->input('txtHorario');
        $this->descripcion = $request->input('txtDescripcion');
        $this->observacion = $request->input('txtObservacion');
        $this->direccion = $request->input('txtDireccion');
        $this->fecha_carga = $request->input('txtFechaCarga');
      
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idseminario,
                  A.nombre,
                  A.fecha_curso,
                  A.contenido,
                  A.horario,
                  A.descripcion,
                  A.observacion,
                  A.imagen,
                  A.direccion,
                  A.fecha_carga
                FROM seminarios A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idSeminario)
    {
        $sql = "SELECT
                idseminario,
                nombre,
                fecha_curso,
                contenido,
                horario,
                descripcion,
                observacion,
                imagen,
                direccion,
                fecha_carga
                FROM seminarios WHERE idseminario = $idSeminario";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idseminario = $lstRetorno[0]->idseminario;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->fecha_curso= $lstRetorno[0]->fecha_curso;
            $this->contenido = $lstRetorno[0]->contenido;
            $this->horario = $lstRetorno[0]->horario;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->observacion = $lstRetorno[0]->observacion;
            $this->imagen = $lstRetorno[0]->imagen;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->fecha_carga = $lstRetorno[0]->fecha_carga;
            return $this;
        }
        return null;
    }

    public function insertar()
    {
        $sql = "INSERT INTO seminarios (
                nombre,
                fecha_curso,
                contenido,
                horario,
                descripcion,
                observacion,
                imagen,
                direccion,
                fecha_carga
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->fecha_curso,
            $this->contenido,
            $this->horario,
            $this->descripcion,
            $this->observacion,
            $this->imagen,
            $this->direccion,
            $this->fecha_carga,
        ]);
        return $this->idseminario = DB::getPdo()->lastInsertId();
    }

    public function guardar()
    {
        $sql = "UPDATE seminarios SET
            nombre='$this->nombre',
            fecha_curso='$this->fecha_curso',
            contenido='$this->contenido',
            horario='$this->horario',
            descripcion='$this->descripcion',
            observacion='$this->observacion',
            imagen='$this->imagen',
            direccion='$this->direccion',
            fecha_carga='$this->fecha_carga'
            WHERE idseminario=?";
        $affected = DB::update($sql, [$this->idseminario]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM seminarios WHERE
            idseminario=?";
        $affected = DB::delete($sql, [$this->idseminario]);
    }


    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.nombre',
            1 => 'A.fecha_curso',
            2 => 'A.contenido',
            3 => 'B.horario',
            4 => 'A.descripcion',
            5 => 'A.observacion',
            6 => 'A.imagen',
            7 => 'A.direccion',
            8 => 'A.fecha_carga',
        );
        $sql = "SELECT DISTINCT
                A.idseminario,
                A.nombre,
                A.fecha_curso,
                A.contenido,
                A.horario,
                A.descripcion,
                A.observacion,
                A.imagen,
                A.direccion,
                A.fecha_carga
                FROM seminarios A
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.fecha_curso LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.contenido LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.horario LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.descripcion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.observacion LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR A.imagen LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR A.direccion LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR A.fecha_carga LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }




}