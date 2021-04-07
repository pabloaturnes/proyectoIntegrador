<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    public $timestamps = false;

    protected $fillable = [
        'idproducto', 'nombre', 'precio', 'stock', 'descripcion', 'fk_idcategoria' ,'imagen'
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request)
    {
        $this->idproducto = $request->input('id') != "0" ? $request->input('id') : $this->idproducto;
        $this->nombre = $request->input('txtNombre');
        $this->precio = $request->input('txtPrecio');
        $this->stock = $request->input('txtStock') ;
        $this->descripcion = $request->input('txtDescripcion');
        $this->fk_idcategoria = $request->input('lstCategoria');
        
    }

    public function obtenerTodos($txtBusqueda)
    {
        $sql = "SELECT
                  A.idproducto,
                  A.nombre,
                  A.precio,
                  A.stock,
                  A.descripcion,
                  A.fk_idcategoria,
                  A.imagen
                FROM productos A  WHERE  A.nombre LIKE '%$txtBusqueda%'";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idProducto)
    {
        $sql = "SELECT
                idproducto,
                nombre,
                precio,
                stock,
                descripcion,
                fk_idcategoria,
                imagen
                FROM productos WHERE idproducto = $idProducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idproducto = $lstRetorno[0]->idproducto;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->precio = $lstRetorno[0]->precio;
            $this->stock = $lstRetorno[0]->stock;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->fk_idcategoria = $lstRetorno[0]->fk_idcategoria;
            $this->imagen = $lstRetorno[0]->imagen;
            return $this;
        }
        return null;
    }

    public function obtenerProductoPorCategoria($idCategoria, $txtBusqueda){

        $sql = "SELECT
        idproducto,
        nombre,
        precio,
        stock,
        descripcion,
        fk_idcategoria,
        imagen
        FROM productos WHERE fk_idcategoria = $idCategoria AND nombre LIKE '%$txtBusqueda%'";
        return $lstRetorno = DB::select($sql);



    }



    public function insertar()
    {
        $sql = "INSERT INTO productos (
                nombre,
                precio,
                stock,
                descripcion,
                fk_idcategoria,
                imagen
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->precio,
            $this->stock,
            $this->descripcion,
            $this->fk_idcategoria,
            $this->imagen
        ]);
        return $this->idproducto = DB::getPdo()->lastInsertId();
    }

    public function guardar()
    {
        $sql = "UPDATE productos SET
            nombre='$this->nombre',
            precio='$this->precio',
            stock=$this->stock,
            descripcion='$this->descripcion'
            fk_idcategoria=$this->fk_idcategoria
            WHERE idproducto=?";
        $affected = DB::update($sql, [$this->idproducto]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM productos WHERE
            idproducto=?";
        $affected = DB::delete($sql, [$this->idproducto]);
    }  

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.nombre',
            1 => 'A.precio',
            2 => 'A.stock',
            3 => 'A.descripcion',
            4 => 'A.imagen'               
        );
        $sql = "SELECT DISTINCT
                    A.idproducto,
                    A.nombre,
                    A.precio,
                    A.stock,
                    A.descripcion,
                    A.imagen                   
                    FROM productos A
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.precio LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.stock LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.descripcion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.imagen LIKE '%" . $request['search']['value'] . "%' ";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }







}
