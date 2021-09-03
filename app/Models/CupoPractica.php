<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class CupoPractica
{
    public $id;
    public $anio;
    public $periodo;
    public $carrera;
    public $ua;
    public $modalidad;
    public $estado;
    public $tipoPractica;
    public $nivelEnsenanza;
    public $cursosIntervencion;
    public $nivelPractica;
    public $idCentroPractica;
    public $rbdCentroPractica;
    public $rutProfesorColaborador;
    public $profesorColaborador;
    public $fechaActualizacion;


    const CONEXION_BD = 'mysql_SIGEP';

    /**
     * @param $anio
     * @param $periodo
     * @param $carrera
     * @param $modalidad
     * @param $estado
     * @param $tipoPractica
     * @param $nivelEnsenanza
     * @param $cursosIntervencion
     * @param $nivelPractica
     * @param $idCentroPractica
     * @param $rbdCentroPractica
     * @param $rutProfesorColaborador
     * @param $profesorColaborador
     */
    public function __construct(
        $anio,
        $periodo,
        $carrera,
        $ua,
        $modalidad,
        $estado,
        $tipoPractica,
        $nivelEnsenanza,
        $cursosIntervencion,
        $nivelPractica,
        $idCentroPractica,
        $rbdCentroPractica,
        $rutProfesorColaborador,
        $profesorColaborador
    ) {
        $this->anio = $anio;
        $this->periodo = $periodo;
        $this->carrera = $carrera;
        $this->ua = $ua;
        $this->modalidad = $modalidad;
        $this->estado = $estado;
        $this->tipoPractica = $tipoPractica;
        $this->nivelEnsenanza = $nivelEnsenanza;
        $this->cursosIntervencion = $cursosIntervencion;
        $this->nivelPractica = $nivelPractica;
        $this->idCentroPractica = $idCentroPractica;
        $this->rbdCentroPractica = $rbdCentroPractica;
        $this->rutProfesorColaborador = $rutProfesorColaborador;
        $this->profesorColaborador = $profesorColaborador;
    }

    public static function get($id)
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT * FROM
	        CUPOS_PRACTICA
	  	    WHERE CUPOS_PRACTICA.ID=?",
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
	        CUPOS_PRACTICA
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
                "DELETE FROM CUPOS_PRACTICA WHERE ID=? ",
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
                "INSERT INTO CUPOS_PRACTICA
      (ID,ANIO,PERIODO,CARRERA,UA,MODALIDAD,ESTADO,TIPO_PRACTICA,NIVEL_ENSENANZA,CURSOS_INTERVENCION,NIVEL_PRACTICA,CENTRO_PRACTICAS_ID,RBD_CENTRO_PRACTICA,RUT_PROFESOR_COLABORADOR,PROFESOR_COLABORADOR,FECHA_ACTUALIZACION) values
      (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ON DUPLICATE KEY UPDATE ID = VALUES(ID),
        ANIO = VALUES(ANIO),
        PERIODO = VALUES(PERIODO),
        CARRERA = VALUES(CARRERA),
        MODALIDAD = VALUES(MODALIDAD),
        ESTADO = VALUES(ESTADO),
        TIPO_PRACTICA = VALUES(TIPO_PRACTICA),
        NIVEL_ENSENANZA = VALUES(NIVEL_ENSENANZA),
        CURSOS_INTERVENCION = VALUES(CURSOS_INTERVENCION),
        NIVEL_PRACTICA = VALUES(NIVEL_PRACTICA),
        CENTRO_PRACTICAS_ID = VALUES(CENTRO_PRACTICAS_ID),
        RBD_CENTRO_PRACTICA = VALUES(RBD_CENTRO_PRACTICA),
        RUT_PROFESOR_COLABORADOR = VALUES(RUT_PROFESOR_COLABORADOR),
        PROFESOR_COLABORADOR = VALUES(PROFESOR_COLABORADOR),
        FECHA_ACTUALIZACION = VALUES(FECHA_ACTUALIZACION)
        ",
                [
                    $this->id,
                    $this->anio,
                    $this->periodo,
                    $this->carrera,
                    $this->ua,
                    $this->modalidad,
                    $this->estado,
                    $this->tipoPractica,
                    $this->nivelEnsenanza,
                    $this->cursosIntervencion,
                    $this->nivelPractica,
                    $this->idCentroPractica,
                    $this->rbdCentroPractica,
                    $this->rutProfesorColaborador,
                    $this->profesorColaborador,
                    $fecha

                ]
            );
            $id = DB::connection(self::CONEXION_BD)->getPdo()->lastInsertId();
            // $id = ($id != 0) ? $this->id : $id;
        } catch (\Illuminate\Database\QueryException $ex) {
            $id = "Error: " . $ex->getMessage();

        }

        return $id;
    }

    public static function getCuposByProgramacion($anio,$periodo,$ua,$tipoPractica,$nivelPractica)
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "SELECT CUPOS_PRACTICA.*,CENTRO_PRACTICAS.NOMBRE_ESTABLECIMIENTO AS NOMBRE_CENTRO_PRACTICA,CENTRO_PRACTICAS.DEPENDENCIA_ADMINISTRATIVA AS DEPENDENCIA_ADMINISTRATIVA_CENTRO_PRACTICA ,CENTRO_PRACTICAS.TIPO_ENSENANZA AS TIPO_ENSENANZA_CENTRO_PRACTICA ,CENTRO_PRACTICAS.COMUNA AS COMUNA_CENTRO_PRACTICA
FROM  CUPOS_PRACTICA  JOIN CENTRO_PRACTICAS  ON CUPOS_PRACTICA.CENTRO_PRACTICAS_ID=CENTRO_PRACTICAS.ID
WHERE CUPOS_PRACTICA.ANIO=?
AND CUPOS_PRACTICA.PERIODO=?
AND CUPOS_PRACTICA.UA=?
AND CUPOS_PRACTICA.TIPO_PRACTICA=?
AND CUPOS_PRACTICA.NIVEL_PRACTICA=?",
                [$anio,$periodo,$ua,$tipoPractica,$nivelPractica]
            );
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = "Error: " . $ex->getMessage();
        }
        //dd($results);
        return $results;
    }


}
