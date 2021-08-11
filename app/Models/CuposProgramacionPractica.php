<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class CuposProgramacionPractica
{
    public $id;
    public $idCuposPractica;
    public $idProgramacionPractica;
    public $observacion;
    public $estado;
    public $fechaActializacion;

    const CONEXION_BD = 'mysql_SIGEP';

    /**
     * @param $idCuposPractica
     * @param $idProgramacionPractica
     * @param $observacion
     * @param $estado
     * @param $fechaActializacion
     */
    public function __construct($idCuposPractica, $idProgramacionPractica, $observacion, $estado)
    {
        $this->idCuposPractica = $idCuposPractica;
        $this->idProgramacionPractica = $idProgramacionPractica;
        $this->observacion = $observacion;
        $this->estado = $estado;
    }

    public static function get($id)
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT * FROM
	        CUPOS_PROGRAMACION_PRACTICA
	  	    WHERE CUPOS_PROGRAMACION_PRACTICA.ID=?",
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
	        CUPOS_PROGRAMACION_PRACTICA
	  	    "
            );
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = "Error: " . $ex->getMessage();
        }
        //dd($results);
        return $results;
    }
    public static function getAllByIdProgramacion($idProgramacion)
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT CUPOS_PROGRAMACION_PRACTICA.*,CENTRO_PRACTICAS.RBD,CUPOS_PRACTICA.MODALIDAD,CUPOS_PRACTICA.CURSOS_INTERVENCION,CENTRO_PRACTICAS.NOMBRE_ESTABLECIMIENTO AS NOMBRE_CENTRO_PRACTICA,
CENTRO_PRACTICAS.DEPENDENCIA_ADMINISTRATIVA AS DEPENDENCIA_ADMINISTRATIVA_CENTRO_PRACTICA,
CENTRO_PRACTICAS.TIPO_ENSENANZA AS TIPO_ENSENANZA_CENTRO_PRACTICA,
CENTRO_PRACTICAS.COMUNA AS COMUNA_CENTRO_PRACTICA
 FROM CUPOS_PROGRAMACION_PRACTICA JOIN CUPOS_PRACTICA
ON CUPOS_PROGRAMACION_PRACTICA.CUPOS_PRACTICA_ID=CUPOS_PRACTICA.ID
JOIN CENTRO_PRACTICAS  ON CUPOS_PRACTICA.CENTRO_PRACTICAS_ID=CENTRO_PRACTICAS.ID
 WHERE CUPOS_PROGRAMACION_PRACTICA.PROGRAMACION_PRACTICA_ID=?",array($idProgramacion)
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
                "DELETE FROM CUPOS_PROGRAMACION_PRACTICA WHERE CUPOS_PROGRAMACION_PRACTICA.ID=? ",
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
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d G:i:s");
        try {
            DB::connection(self::CONEXION_BD)->insert(
                "INSERT INTO CUPOS_PROGRAMACION_PRACTICA
      (ID,CUPOS_PRACTICA_ID,PROGRAMACION_PRACTICA_ID,OBSERVACION,FECHA_ACTUALIZACION,ESTADO) values
      (?,?,?,?,?,?)
    ON DUPLICATE KEY UPDATE ID = VALUES(ID),
        CUPOS_PRACTICA_ID = VALUES(CUPOS_PRACTICA_ID),
        PROGRAMACION_PRACTICA_ID = VALUES(PROGRAMACION_PRACTICA_ID),
        OBSERVACION = VALUES(OBSERVACION),
        FECHA_ACTUALIZACION = VALUES(FECHA_ACTUALIZACION),
        ESTADO = VALUES(ESTADO)
        ",
                [
                    $this->id,
                    $this->idCuposPractica,
                    $this->idProgramacionPractica,
                    $this->observacion,
                    $fecha,
                    $this->estado

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
