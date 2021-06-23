<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class ProfesorTutor
{
    public $id;
    public $run;
    public $nombre;
    public $apellido;
    public $email;
    public $titulo;

    const CONEXION_BD = 'mysql_SIGEP';

    /**
     * ProfesorTutor constructor.
     * @param $id
     * @param $run
     * @param $nombre
     * @param $apellido
     * @param $email
     * @param $titulo
     */
    public function __construct($run = null, $nombre = null, $apellido = null, $email = null, $titulo = null)
    {
        $this->run = $run;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->titulo = $titulo;
    }

    public static function get($id)
    {
        try {
            $results = DB::connection(self::CONEXION_BD)->select(
                "
            SELECT * FROM
	        PROFESOR_TUTOR
	  	    WHERE PROFESOR_TUTOR.ID=?",
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
	        PROFESOR_TUTOR
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
                "DELETE FROM PROFESOR_TUTOR WHERE ID=? ",
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
                "INSERT INTO PROFESOR_TUTOR
      (ID,RUN,NOMBRE,APELLIDO,EMAIL,TITULO) values
      (?,?,?,?,?,?)
      ON DUPLICATE KEY UPDATE ID = VALUES(ID),
 ID = VALUES(ID),
 RUN = VALUES(RUN),
 NOMBRE = VALUES(NOMBRE),
 APELLIDO= VALUES(APELLIDO),
 EMAIL = VALUES(EMAIL),
 TITULO = VALUES(TITULO)",
                [
                    $this->id,
                    $this->run,
                    $this->nombre,
                    $this->apellido,
                    $this->email,
                    $this->titulo,

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




