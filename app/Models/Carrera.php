<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class Estudiante
 * @package App\Models
 */
class Carrera
{

    public $carrera;
    public $ua;
    public $codFacultad;

    const CONEXION_BD = 'mysql_SIGEP';

    public static function getAll()
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT * FROM
	        CARRERA
	  	    "
            );
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = "Error: " . $ex->getMessage();
        }
        //dd($results);
        return $results;
    }
}
