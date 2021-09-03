<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class Ficha
 * @package App\Models
 */
class Ficha
{
    public $id;
    public $tipoFicha;
    public $runEstudiante;
    public $inicioPractica;
    public $terminoPractica;
    public $observacion;
    public $cartaPresentacionGenerada;
    public $especialidad;
    public $idCuposProgramacionPractica;
    public $fechaHoraCreacion;
    public $fechaHoraActualizacion;
    public $estado;




    const CONEXION_BD = 'mysql_SIGEP';

    /**
     * @param $id
     * @param $tipoFicha
     * @param $runEstudiante
     * @param $inicioPractica
     * @param $terminoPractica
     * @param $observacion
     * @param $cartaPresentacionGenerada
     * @param $especialidad
     * @param $idCuposProgramacionPractica
     * @param $fechaHoraCreacion
     * @param $fechaHoraActualizacion
     * @param $estado
     */
    public function __construct(
        $id,
        $tipoFicha,
        $runEstudiante,
        $inicioPractica,
        $terminoPractica,
        $observacion,
        $cartaPresentacionGenerada,
        $especialidad,
        $idCuposProgramacionPractica

    ) {
        $this->id = $id;
        $this->tipoFicha = $tipoFicha;
        $this->runEstudiante = $runEstudiante;
        $this->inicioPractica = $inicioPractica;
        $this->terminoPractica = $terminoPractica;
        $this->observacion = $observacion;
        $this->cartaPresentacionGenerada = $cartaPresentacionGenerada;
        $this->especialidad = $especialidad;
        $this->idCuposProgramacionPractica = $idCuposProgramacionPractica;
    }


    /**
     * @param $id
     * @return array|string
     */
    public static function get($id)
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT * FROM
	        FICHA
	  	    WHERE FICHA.ID=?",
                [$id]
            );
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = "Error: " . $ex->getMessage();
        }
        //dd($results);
        return $results;
    }

    /**
     * @return array|string
     */
    public static function getAll()
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT
FICHA.ID,FICHA.TIPO_FICHA,FICHA.RUN_ESTUDIANTE,FICHA.ESTADO AS ESTADO_FICHA,
CUPOS_PROGRAMACION_PRACTICA.ID AS ID_CUPOS_PROGRAMACION_PRACTICA,CUPOS_PROGRAMACION_PRACTICA.N_INTEGRANTES AS N_INTEGRANTES_CUPOS_PROGRAMACION_PRACTICA,CUPOS_PROGRAMACION_PRACTICA.ESTADO AS ESTADO_CUPOS_PROGRAMACION_PRACTICA,
PROGRAMACION_PRACTICA.ID AS ID_PROGRAMACION_PRACTICA,PROGRAMACION_PRACTICA.ANIO,PROGRAMACION_PRACTICA.PERIODO,PROGRAMACION_PRACTICA.CARRERA,PROGRAMACION_PRACTICA.UA,PROGRAMACION_PRACTICA.NIVEL_PRACTICA,PROGRAMACION_PRACTICA.TIPO_PRACTICA,PROGRAMACION_PRACTICA.NIVEL_ENSENANZA,PROGRAMACION_PRACTICA.N_SEMANAS_PERMANENCIA,PROGRAMACION_PRACTICA.N_HORAS_AULA,PROGRAMACION_PRACTICA.N_HORAS_ADMINISTRATIVAS,PROGRAMACION_PRACTICA.COD_ASIGNATURA,PROGRAMACION_PRACTICA.NOMBRE_ASIGNATURA,PROGRAMACION_PRACTICA.ESTADO AS ESTADO_PROGRAMACION_PRACTICA,
CUPOS_PRACTICA.MODALIDAD,CUPOS_PRACTICA.RBD_CENTRO_PRACTICA,CUPOS_PRACTICA.RUT_PROFESOR_COLABORADOR,CUPOS_PRACTICA.PROFESOR_COLABORADOR,
CENTRO_PRACTICAS.NOMBRE_ESTABLECIMIENTO,
ESTUDIANTE.NOMBRE AS NOMBRE_ESTUDIANTE,ESTUDIANTE.APELLIDO AS APELLIDO_ESTUDIANTE, ESTUDIANTE.EMAIL AS EMAIL_ESTUDIANTE,ESTUDIANTE.TELEFONO AS TELEFONO_ESTUDIANTE ,ESTUDIANTE.COMUNA AS COMUNA_ESTUDIANTE
FROM FICHA JOIN CUPOS_PROGRAMACION_PRACTICA ON FICHA.CUPOS_PROGRAMACION_PRACTICA_ID=CUPOS_PROGRAMACION_PRACTICA.ID
JOIN PROGRAMACION_PRACTICA ON PROGRAMACION_PRACTICA.ID=CUPOS_PROGRAMACION_PRACTICA.PROGRAMACION_PRACTICA_ID
JOIN CUPOS_PRACTICA ON CUPOS_PRACTICA.ID= CUPOS_PROGRAMACION_PRACTICA.CUPOS_PRACTICA_ID
JOIN CENTRO_PRACTICAS ON  CENTRO_PRACTICAS.RBD=CUPOS_PRACTICA.RBD_CENTRO_PRACTICA
left JOIN ESTUDIANTE ON ESTUDIANTE.RUN=FICHA.RUN_ESTUDIANTE"
            );
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = "Error: " . $ex->getMessage();
        }
        //dd($results);
        return $results;
    }

    /**
     * @return string
     */
    public function save()
    {
        try {
            DB::connection(self::CONEXION_BD)->insert(
                "INSERT INTO FICHA
                        (ID,
                        TIPO_FICHA,
                        RUN_ESTUDIANTE,
                        INICIO_PRACTICA,
                        TERMINO_PRACTICA,
                        OBSERVACION,
                        CARTA_PRESENTACION_GENERADA,
                        ESPECIALIDAD,
                        CUPOS_PROGRAMACION_PRACTICA_ID,
                        FECHA_HORA_CREACION,
                        FICHA_HORA_ACTUALIZACION,
                        ESTADO
                        ) values
                        (?,?,?,?,?,?,?,?,?,?,?,?)
                        ON DUPLICATE KEY UPDATE ID = VALUES(ID),
                        TIPO_FICHA = VALUES(TIPO_FICHA),
                        RUN_ESTUDIANTE = VALUES(RUN_ESTUDIANTE),
                        INICIO_PRACTICA = VALUES(INICIO_PRACTICA),
                        TERMINO_PRACTICA = VALUES(TERMINO_PRACTICA),
                        OBSERVACION = VALUES(OBSERVACION),
                        CARTA_PRESENTACION_GENERADA = VALUES(CARTA_PRESENTACION_GENERADA),
                        ESPECIALIDAD = VALUES(ESPECIALIDAD),
                        CUPOS_PROGRAMACION_PRACTICA_ID = VALUES(CUPOS_PROGRAMACION_PRACTICA_ID),
                        FECHA_HORA_CREACION = VALUES(FECHA_HORA_CREACION),
                        FICHA_HORA_ACTUALIZACION = VALUES(FICHA_HORA_ACTUALIZACION)",
                [
                    $this->id,
                    $this->tipoFicha,
                    $this->runEstudiante,
                    $this->inicioPractica,
                    $this->terminoPractica,
                    $this->observacion,
                    $this->cartaPresentacionGenerada,
                    $this->especialidad,
                    $this->idCuposProgramacionPractica,
                    $this->fechaHoraCreacion,
                    $this->fechaHoraActualizacion,
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

    public static function delete($id)
    {
        try {
            $submit = DB::connection(self::CONEXION_BD)->delete(
                "DELETE FROM FICHA WHERE ID=? ",
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


}
