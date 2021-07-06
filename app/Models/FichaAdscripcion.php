<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class FichaAdscripcion
 * @package App\Models
 */
class FichaAdscripcion
{
    public $id;
 //   public $carrera;
 //   public $nombre;
    public $rut;
 /*   public $email;
    public $direccion;
    public $comuna;
    public $telefono;
    public $profesorTutor;*/
    public $nivelPractica;
  /*  public $rbd;
    public $centroPractica;
    public $dependencia;
    public $ensenanza;
    public $direccionCp;
    public $comunaCp;
    public $telefonoCp;
    public $directorCp;
    public $emailDirectorCp;
    public $nombreUtpCp;
    public $emailUtpCp;
    public $nombreProfColaboradorCp;
    public $rutProfColaboradorCp;
    public $emailProfColaboradorCp;
    public $telefonoProfColaboradorCp;
    public $tituloProfColaboradorCp;
    public $egresadoUcsc;
*/


    /**
     *
     */
    const CONEXION_BD = 'mysql_SIGEP';

    /**
     * FichaAdscripcion constructor.
     * @param null $carrera
     * @param null $nombre
     * @param null $rut
     * @param null $email
     * @param null $direccion
     * @param null $comuna
     * @param null $telefono
     * @param null $profesorTutor
     * @param null $nivelPractica
     * @param null $rbd
     * @param null $centroPractica
     * @param null $dependencia
     * @param null $ensenanza
     * @param null $direccionCp
     * @param null $comunaCp
     * @param null $telefonoCp
     * @param null $directorCp
     * @param null $emailDirectorCp
     * @param null $nombreUtpCp
     * @param null $emailUtpCp
     * @param null $nombreProfColaboradorCp
     * @param null $rutProfColaboradorCp
     * @param null $emailProfColaboradorCp
     * @param null $telefonoProfColaboradorCp
     * @param null $tituloProfColaboradorCp
     * @param null $egresadoUcsc
     */


    public function __construct(
/*     $carrera = null,
     $nombre= null,*/
     $rut= null,
 /*    $email= null,
     $direccion= null,
     $comuna= null,
     $telefono= null,
     $profesorTutor= null,*/
     $nivelPractica= null /*saque la coma*/
 /*    $rbd= null,
     $centroPractica= null,
     $dependencia= null,
     $ensenanza= null,
     $direccionCp= null,
     $comunaCp= null,
     $telefonoCp= null,
     $directorCp= null,
     $emailDirectorCp= null,
     $nombreUtpCp= null,
     $emailUtpCp= null,
     $nombreProfColaboradorCp = null,
     $rutProfColaboradorCp = null,
     $emailProfColaboradorCp = null,
     $telefonoProfColaboradorCp = null,
     $tituloProfColaboradorCp = null,
     $egresadoUcsc= null*/
    ) {
   /*     $this->carrera = $carrera;
        $this->nombre = $nombre;*/
        $this->rut = $rut;
  /*      $this->email = $email;
        $this->direccion = $direccion;
        $this->comuna = $comuna;
        $this->telefono = $telefono;
        $this->profesorTutor = $profesorTutor; */
        $this->nivelPractica = $nivelPractica;
  /*      $this->rbd = $rbd;
        $this->centroPractica = $centroPractica;
        $this->dependencia = $dependencia;
        $this->ensenanza = $ensenanza;
        $this->direccionCp = $direccionCp;
        $this->comunaCp = $comunaCp;
        $this->telefonoCp = $telefonoCp;
        $this->directorCp = $directorCp;
        $this->emailDirectorCp = $emailDirectorCp;
        $this->nombreUtpCp = $nombreUtpCp;
        $this->emailUtpCp = $emailUtpCp;
        $this->nombreProfColaboradorCp = $nombreProfColaboradorCp;
        $this->rutProfColaboradorCp = $rutProfColaboradorCp;
        $this->emailProfColaboradorCp = $emailProfColaboradorCp;
        $this->telefonoProfColaboradorCp = $telefonoProfColaboradorCp;
        $this->tituloProfColaboradorCp = $tituloProfColaboradorCp;
        $this->egresadoUcsc = $egresadoUcsc; */
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
            SELECT * FROM
	        FICHA
	  	    "
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
                        NIVEL_PRACTICA,
                        RUN_ESTUDIANTE) values
                        (?,?,?)
                        ON DUPLICATE KEY UPDATE ID = VALUES(ID),
                        NIVEL_PRACTICA = VALUES(NIVEL_PRACTICA),
                       RUN_ESTUDIANTE = VALUES(RUN_ESTUDIANTE)",
//                        INICIO_PRACTICA = VALUES(INICIO_PRACTICA),
//                        TERMINO_PRACTICA = VALUES(TERMINO_PRACTICA),
//                        OBSERVACION = VALUES(OBSERVACION),
//                        FECHA_HORA_CREACION = VALUES(FECHA_HORA_CREACION),
//                        FICHA_HORA_ACTUALIZACION = VALUES(FICHA_HORA_ACTUALIZACION)
                [
                    $this->id,
                    $this->nivelPractica,
                    $this->rut
                    //  $this->inicioPractica,
                  //  $this->TerminoPractica,
                  //  $this->Observacion,
                  //  $this->FechaHoraCreacion,
                  //  $this->FechaHoraActualizacion,

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
