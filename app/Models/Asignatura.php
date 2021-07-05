<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class TipoSolicitud
 * @package App\Models
 */
class Asignatura{
    public $id;
    public $codAsignatura;
    public $nombreAsignatura;
    public $ua;
    public $especialidad;
    public $tipoPractica;


    const CONEXION_BD = 'mysql_SIGEP';

    /**
     * Asignatura constructor.
     * @param $codAsignatura
     * @param $nombreAsignatura
     * @param $ua
     * @param $especialidad
     * @param $tipoPractica
     */
    public function __construct($codAsignatura, $nombreAsignatura, $ua, $especialidad, $tipoPractica)
    {
        $this->codAsignatura = $codAsignatura;
        $this->nombreAsignatura = $nombreAsignatura;
        $this->ua = $ua;
        $this->especialidad = $especialidad;
        $this->tipoPractica = $tipoPractica;
    }

    public static function get($id)
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT * FROM
	        ASIGNATURA
	  	    WHERE ASIGNATURA.ID=?",
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
	        ESTUDIANTE
	  	    "
            );
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = "Error: " . $ex->getMessage();
        }
        //dd($results);
        return $results;
    }
    public static function getAllCarreras()
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT DISTINCT CARRERA,UA  FROM
	        ESTUDIANTE
	  	    "
            );
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = "Error: " . $ex->getMessage();
        }
        //dd($results);
        return $results;
    }
}
