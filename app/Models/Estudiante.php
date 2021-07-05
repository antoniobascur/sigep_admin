<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class TipoSolicitud
 * @package App\Models
 */
class Estudiante{
    public $run;
    public $nombre;
    public $carrera;
    public $ua;
    public $email;

    const CONEXION_BD = 'mysql_SIGEP';

    /**
     * Estudiante constructor.
     * @param $run
     * @param $nombre
     * @param $carrera
     * @param $ua
     * @param $email
     */
    public function __construct($run, $nombre, $carrera, $ua, $email)
    {
        $this->run = $run;
        $this->nombre = $nombre;
        $this->carrera = $carrera;
        $this->ua = $ua;
        $this->email = $email;
    }


    public static function get($id)
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT * FROM
	        ESTUDIANTE
	  	    WHERE ESTUDIANTE.RUN=?",
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
