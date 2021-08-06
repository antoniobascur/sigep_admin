<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class ProfesorColaborador
{
    public $id;
    public $run;
    public $nombre;
    public $email;
    public $titulo;
    public $especialidad;
    public $fono;
    public $egresadoUcsc;

    const CONEXION_BD = 'mysql_SIGEP';

    /**
     * ProfesorColaborador constructor.
     * @param $id
     * @param $run
     * @param $nombre
     * @param $apellido
     * @param $email
     * @param $titulo
     * @param $especialidad
     * @param $fono
     * @param $egresadoUcsc
     */
    public function __construct( $run=null, $nombre=null, $email=null, $titulo=null, $especialidad=null, $fono=null, $egresadoUcsc=null)
    {
        $this->run = $run;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->titulo = $titulo;
        $this->especialidad = $especialidad;
        $this->fono = $fono;
        $this->egresadoUcsc = $egresadoUcsc;
    }


    public static function get($id)
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT * FROM
	        PROFESOR_COLABORADOR
	  	    WHERE PROFESOR_COLABORADOR.ID=?",
                [$id]
            );
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = "Error: " . $ex->getMessage();
        }
        //dd($results);
        return $results;
    }
    public static function getByRun($id)
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT * FROM
	        PROFESOR_COLABORADOR
	  	    WHERE PROFESOR_COLABORADOR.RUN=?",
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
	        PROFESOR_COLABORADOR
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
                "DELETE FROM PROFESOR_COLABORADOR WHERE ID=? ",
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
                "INSERT INTO PROFESOR_COLABORADOR
      (RUN,NOMBRE,ESPECIALIDAD,EMAIL,FONO,EGRESADO_UCSC) values
      (?,?,?,?,?,?)
      ON DUPLICATE KEY UPDATE
 RUN = VALUES(RUN),
 NOMBRE = VALUES(NOMBRE),
 ESPECIALIDAD = VALUES(ESPECIALIDAD),
  EMAIL = VALUES(EMAIL),
   FONO = VALUES(FONO),
    EGRESADO_UCSC = VALUES(EGRESADO_UCSC)",
                [

                    $this->run,
                    $this->nombre,
                    $this->especialidad,
                    $this->email,
                    $this->fono,
                    $this->egresadoUcsc,

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




