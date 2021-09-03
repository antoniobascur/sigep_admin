<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class ProgramacionPractica
{
    public $id;
    public $anio;
    public $periodo;
    public $carrera;
    public $ua;
    public $nivelPractica;
    public $tipoPractica;
    public $nivelEnsenanza;
    public $nroSemanasPermanencia;
    public $nroHorasAula;
    public $nroHorasAdministrativas;
    public $tareas;
    public $caracteristicas;
    public $codAsignatura;
    public $nombreAsignatura;
    public $estado;
    public $fechaActualizacion;

    const CONEXION_BD = 'mysql_SIGEP';

    /**
     * @param $anio
     * @param $periodo
     * @param $carrera
     * @param $ua
     * @param $nivelPractica
     * @param $tipoPractica
     * @param $nivelEnsenanza
     * @param $nroSemanasPermanencia
     * @param $nroHorasAula
     * @param $nroHorasAdministrativas
     * @param $tareas
     * @param $caracteristicas
     * @param $codAsignatura
     * @param $nombreAsignatura
     * @param $observacion
     * @param $estado
     * @param $fechaActualizacion
     */
    public function __construct(
        $anio,
        $periodo,
        $carrera,
        $ua,
        $nivelPractica,
        $tipoPractica,
        $nivelEnsenanza,
        $nroSemanasPermanencia,
        $nroHorasAula,
        $nroHorasAdministrativas,
        $tareas,
        $caracteristicas,
        $codAsignatura,
        $nombreAsignatura,
        $estado
    ) {
        $this->anio = $anio;
        $this->periodo = $periodo;
        $this->carrera = $carrera;
        $this->ua = $ua;
        $this->nivelPractica = $nivelPractica;
        $this->tipoPractica = $tipoPractica;
        $this->nivelEnsenanza = $nivelEnsenanza;
        $this->nroSemanasPermanencia = $nroSemanasPermanencia;
        $this->nroHorasAula = $nroHorasAula;
        $this->nroHorasAdministrativas = $nroHorasAdministrativas;
        $this->tareas = $tareas;
        $this->caracteristicas = $caracteristicas;
        $this->codAsignatura = $codAsignatura;
        $this->nombreAsignatura = $nombreAsignatura;

        $this->estado = $estado;

    }

    public static function get($id)
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT * FROM
	        PROGRAMACION_PRACTICA
	  	    WHERE PROGRAMACION_PRACTICA.ID=?",
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
	        PROGRAMACION_PRACTICA
	  	    "
            );
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = "Error: " . $ex->getMessage();
        }
        //dd($results);
        return $results;
    }

    public static function getAllCuposProgramacion(){
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
           SELECT PROGRAMACION_PRACTICA.*,
CUPOS_PROGRAMACION_PRACTICA.ID AS ID_CUPOS_PROGRAMACION_PRACTICA,
CUPOS_PROGRAMACION_PRACTICA.ESTADO AS ESTADO_CUPOS_PROGRAMACION_PRACTICA,
CENTRO_PRACTICAS.NOMBRE_ESTABLECIMIENTO AS NOMBRE_CENTRO_PRACTICA,
CENTRO_PRACTICAS.DEPENDENCIA_ADMINISTRATIVA AS DEPENDENCIA_ADMINISTRATIVA_CENTRO_PRACTICA,
CENTRO_PRACTICAS.TIPO_ENSENANZA AS TIPO_ENSENANZA_CENTRO_PRACTICA,
CENTRO_PRACTICAS.COMUNA AS COMUNA_CENTRO_PRACTICA
FROM  PROGRAMACION_PRACTICA join CUPOS_PROGRAMACION_PRACTICA  ON PROGRAMACION_PRACTICA.ID=CUPOS_PROGRAMACION_PRACTICA.PROGRAMACION_PRACTICA_ID
JOIN  CUPOS_PRACTICA ON CUPOS_PRACTICA.ID=CUPOS_PROGRAMACION_PRACTICA.CUPOS_PRACTICA_ID
JOIN CENTRO_PRACTICAS  ON CUPOS_PRACTICA.CENTRO_PRACTICAS_ID=CENTRO_PRACTICAS.ID
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
                "DELETE FROM PROGRAMACION_PRACTICA WHERE PROGRAMACION_PRACTICA.ID=? ",
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

    public static function changeStateProgramacion($id,$estado)
    {
        try {
            $submit = DB::connection(self::CONEXION_BD)->delete(
                "UPDATE PROGRAMACION_PRACTICA SET PROGRAMACION_PRACTICA.ESTADO=? where  PROGRAMACION_PRACTICA.ID=? ",
                array($estado,$id)
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
                "INSERT INTO PROGRAMACION_PRACTICA
      (ID,
       ANIO,
       PERIODO,
       CARRERA,
       UA,
       NIVEL_PRACTICA,TIPO_PRACTICA,NIVEL_ENSENANZA,N_SEMANAS_PERMANENCIA,N_HORAS_AULA,N_HORAS_ADMINISTRATIVAS,TAREAS,CARACTERISTICAS,COD_ASIGNATURA,NOMBRE_ASIGNATURA,ESTADO,FECHA_ACTUALIZACION) values
      (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ON DUPLICATE KEY UPDATE ID = VALUES(ID),
        ANIO = VALUES(ANIO),
        PERIODO = VALUES(PERIODO),
        CARRERA = VALUES(CARRERA),
        UA = VALUES(UA),
        NIVEL_PRACTICA = VALUES(NIVEL_PRACTICA),
        TIPO_PRACTICA = VALUES(TIPO_PRACTICA),
        NIVEL_ENSENANZA = VALUES(NIVEL_ENSENANZA),
        N_SEMANAS_PERMANENCIA = VALUES(N_SEMANAS_PERMANENCIA),
        N_HORAS_AULA = VALUES(N_HORAS_AULA),
        N_HORAS_ADMINISTRATIVAS = VALUES(N_HORAS_ADMINISTRATIVAS),
        TAREAS = VALUES(TAREAS),
        CARACTERISTICAS = VALUES(CARACTERISTICAS),
        COD_ASIGNATURA = VALUES(COD_ASIGNATURA),
        NOMBRE_ASIGNATURA = VALUES(NOMBRE_ASIGNATURA),
        ESTADO = VALUES(ESTADO),
        FECHA_ACTUALIZACION = VALUES(FECHA_ACTUALIZACION)
        ",
                [$this->id,
                    $this->anio,
            $this->periodo,
            $this->carrera,
            $this->ua,
            $this->nivelPractica,
            $this->tipoPractica,
            $this->nivelEnsenanza,
            $this->nroSemanasPermanencia,
            $this->nroHorasAula,
            $this->nroHorasAdministrativas,
            $this->tareas,
            $this->caracteristicas,
            $this->codAsignatura,
            $this->nombreAsignatura,

            $this->estado,
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
}
