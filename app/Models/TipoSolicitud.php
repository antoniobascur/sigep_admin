<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class TipoSolicitud
 * @package App\Models
 */
class TipoSolicitud{
    public $id;
    public $tipoSolicitud;
    public $descripcion;

    const CONEXION_BD = 'mysql_SIGEP';

    public function __construct(
        $tipoSolicitud = null,
        $descripcion = null
    )
    {
        $this->tipoSolicitud = $tipoSolicitud;
        $this->descripcion = $descripcion;
    }

    public static function get($id)
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT * FROM
	        TIPO_SOLICITUD
	  	    WHERE TIPO_SOLICITUD.ID=?",
                [$id]
            );
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = "Error: " . $ex->getMessage();
        }
        //dd($results);
        return $results;
    }
    public static function getAll()
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT * FROM
	        TIPO_SOLICITUD
	  	    "
            );
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = "Error: " . $ex->getMessage();
        }
        //dd($results);
        return $results;
    }
    public static function delete($id)
    {
        try {
            $submit = DB::connection(self::CONEXION_BD)->delete(
                "DELETE FROM TIPO_SOLICITUD WHERE ID=? ",
                array($id)
            );
            // dd($submit);
            $id = $submit;
        } catch (\Illuminate\Database\QueryException $ex) {
            $id = "Error: " . $ex->getMessage();
            // dd($id);
        }

        return $id;
    }
    public function save()
    {
        try {
            DB::connection(self::CONEXION_BD)->insert(
                "INSERT INTO TIPO_SOLICITUD
      (ID,TIPO_SOLICITUD,DESCRIPCION) values
      (?,?,?)
      ON DUPLICATE KEY UPDATE ID = VALUES(ID),
TIPO_SOLICITUD = VALUES(TIPO_SOLICITUD),
DESCRIPCION = VALUES(DESCRIPCION)",
                [
                    $this->id,
                    $this->tipoSolicitud,
                    $this->descripcion,

                ]
            );
            $id = DB::connection(self::CONEXION_BD)->getPdo()->lastInsertId();
            // $id = ($id != 0) ? $this->id : $id;
        } catch (\Illuminate\Database\QueryException $ex) {
            $id = "Error: " . $ex->getMessage();

        }

        return $id;
    }
}
