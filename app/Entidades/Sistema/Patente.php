<?php

namespace App\Entidades\Sistema;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

require app_path() . '/start/constants.php';

class Patente extends Model
{
    protected $table = 'sistema_patentes';
    public $timestamps = false;

    protected $fillable = [
        'idpatente',
        'nombre',
        'descripcion',
        'modulo',
        'submodulo',
        'tipo',
        'log_operacion'
    ];

    function cargarDesdeRequest($request)
    {
        $this->idpatente = $request->input('id') != "0" ? $request->input('id') : $this->idpatente;
        $this->nombre = $request->input('txtNombre');
        $this->descripcion = $request->input('txtDescripcion');
        $this->modulo = $request->input('txtModulo');
        $this->submodulo = $request->input('txtSubmodulo');
        $this->tipo = $request->input('txtTipo');
        $this->log_operacion = $request->input('txtOperacion');
    }

    public function obtenerTodosPorFamilia($familiaID)
    {
        $sql = "SELECT 
                idpatente,
                nombre,
                descripcion,
                modulo,
                submodulo,
                tipo
                FROM sistema_patentes A
                INNER JOIN sistema_patente_familia B ON B.fk_idpatente = A.idpatente AND B.fk_idfamilia = ? ";
        $sql .= " ORDER BY nombre";
        $lstRetorno = DB::select($sql, [$familiaID]);
        return $lstRetorno;
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'P.nombre',
            1 => 'P.modulo',
            2 => 'P.submodulo',
            3 => 'P.descripcion',
            4 => 'P.log_operacion',
            5 => 'P.tipo'
        );
        $sql = "SELECT DISTINCT
                    P.idpatente,
                    P.tipo,
                    P.submodulo,
                    P.nombre,
                    P.modulo,
                    P.log_operacion,
                    P.descripcion
                    FROM sistema_patentes P
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( P.nombre LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR P.modulo LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR P.submodulo LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR P.descripcion LIKE '%" . $request['search']['value'] . "%')";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerCantidadGrillaDisponibles()
    {
        $sql = "SELECT count(idpatente) as cantidad
                FROM sistema_patentes A
                WHERE A.idpatente NOT IN (SELECT fk_idpatente FROM sistema_patente_familia)";
        $lstRetorno = DB::select($sql);
        return $lstRetorno[0]->cantidad;
    }

    public function obtenerFiltradoDisponibles()
    {
        /*
         * Obtiene todas las patentes que aun no fueron agregadas en la familia
         * 
         */
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.idpatente',
            1 => 'A.idpatente',
            2 => 'A.descripcion',
            3 => 'A.tipo',
            4 => 'A.modulo',
            5 => 'A.submodulo',
            6 => 'A.nombre'
        );
        $sql = "SELECT 
                    idpatente, 
                    nombre,
                    descripcion,
                    modulo,
                    submodulo,
                    tipo
                    FROM sistema_patentes A WHERE 1=1 ";

        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.descripcion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.modulo LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.submodulo LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.tipo LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    /*public function obtenerPorId($idpatente) {
        $sql = "SELECT
                    idpatente,
                    nombre,
                    descripcion,
                    fk_idfamilia,
                    aud_usuario_ingreso,
                    aud_stm_ingreso,
                    aud_ip_ingreso,
                    aud_usuario_ultmod,
                    aud_stm_ultmod,
                    aud_ip_ultmod
                    FROM sistema_patentes WHERE idpatente = ?";
        $lstRetorno = DB::select($sql, [$idpatente]);
        return $lstRetorno[0];
    }*/

    public function obtenerPorId($idpatente)
    {
        $sql = "SELECT
                    idpatente,
                    nombre,
                    descripcion,
                    tipo,
                    modulo,
                    submodulo,
                    log_operacion
                    FROM sistema_patentes WHERE idpatente = ?";
        $lstRetorno = DB::select($sql, [$idpatente]);

        if (count($lstRetorno) > 0) {
            $this->idpatente = $lstRetorno[0]->idpatente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->tipo = $lstRetorno[0]->tipo;
            $this->modulo = $lstRetorno[0]->modulo;
            $this->submodulo = $lstRetorno[0]->submodulo;
            $this->log_operacion = $lstRetorno[0]->log_operacion;
            return $this;
        }
        return null;
    }

    public function obtenerPatentesDelUsuario()
    {
        $sql = "SELECT nombre, modulo, tipo, log_operacion
            FROM sistema_patentes A
            INNER JOIN sistema_patente_familia B ON B.fk_idpatente = A.idpatente
            INNER JOIN sistema_usuario_familia C ON C.fk_idfamilia = B.fk_idfamilia
            WHERE C.fk_idusuario = ? ";

        $lstRetorno = DB::select($sql, [Session::get('usuario_id')]);
        return $lstRetorno;
    }

    /**
     * 
     * @param type $idPatente 
     * @param type $log_operacion Indica desde el codigo si una operacion registra log en BBDD
     * @return boolean
     */
    public static function autorizarOperacion($nombrePatente)
    {
        /*
         * Busca que la patente este dentro de la variable de session que contiene
         * las patentes habilitadas para el usuario
         */
        $autorizado = false;
        $aPermisos = Session::get('array_permisos');

        if (isset($aPermisos) && $aPermisos != "" && count($aPermisos) > 0) {
            foreach ($aPermisos as $entidad) {
                if ($entidad->nombre == $nombrePatente) {
                    $autorizado = true;
                    break;
                }
            }
        }

        return $autorizado;
    }

    public static function autorizarModulo($nombreModulo)
    {
        /*
         * Busca que el modulo este dentro de la variable de session que contiene
         * los modulos habilitados para el usuario
         */
        $autorizado = false;
        $aPermisos = getPermisos();
        if (isset($aPermisos) && $aPermisos != "" && count($aPermisos) > 0) {
            foreach ($aPermisos as $entidad) {

                if ($entidad->modulo == $nombreModulo) {
                    $autorizado = true;
                    break;
                }
            }
        }
        return $autorizado;
    }

    public static function errorOperacion($nombrePatente, $mensaje)
    {
?>
        <br>
        <div class="col-lg-12">
            <div id="msg-error" class="alert alert-danger">
                <p><strong>&#161;Error&#33;</strong></p><?php echo "<p>$mensaje </p><p>Err: $nombrePatente</p>"; ?>
            </div>
        </div>
<?php
    }

    public function guardar()
    {
        $sql = "UPDATE sistema_patentes SET
            nombre = '$this->nombre',
            tipo = '$this->tipo',
            modulo = '$this->modulo',
            submodulo = '$this->submodulo',
            log_operacion = $this->log_operacion,
            descripcion = '$this->descripcion'
            WHERE idpatente=?";
        DB::update($sql, [$this->idpatente]);
    }

    public  function eliminar()
    {
        $sql = "DELETE FROM sistema_patentes WHERE 
            idpatente=?";
        DB::delete($sql, [$this->idpatente]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO sistema_patentes (
                nombre,
                tipo,
                modulo,
                submodulo,
                descripcion,
                log_operacion
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->tipo,
            $this->modulo,
            $this->submodulo,
            $this->descripcion,
            $this->log_operacion
        ]);
        return $this->idpatente = DB::getPdo()->lastInsertId();
    }
}
