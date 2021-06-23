<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class EstadoSolicitud
{

    public $id;
    public $estado;
    public $descripcion;

    const CONEXION_BD = 'mysql_SIGEP';

    /**
     * EstadoSolicitud constructor.
     * @param $id
     * @param $estado
     * @param $descripcion
     */
    public function __construct($estado, $descripcion)
    {
        $this->estado = $estado;
        $this->descripcion = $descripcion;
    }

    public static function get($id)
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT * FROM
	        ESTADO_SOLICITUD
	  	    WHERE ESTADO_SOLICITUD.ID=?",
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
	        ESTADO_SOLICITUD
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
                "DELETE FROM ESTADO_SOLICITUD WHERE ID=? ",
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
                "INSERT INTO ESTADO_SOLICITUD
      (ID,ESTADO,DESCRIPCION) values
      (?,?,?)
      ON DUPLICATE KEY UPDATE ID = VALUES(ID),
ESTADO = VALUES(ESTADO),
DESCRIPCION = VALUES(DESCRIPCION)",
                [
                    $this->id,
                    $this->estado,
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
