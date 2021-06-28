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

    /**
     *
     */
    const CONEXION_BD = 'mysql_SIGEP';

    /**
     * FichaAdscripcion constructor.
     * @param null $carreraPrograma
     * @param null $educador
     * @param null $rut
     * @param null $mail
     * @param null $direccion
     * @param null $comuna
     * @param null $telefono
     * @param null $profesorTutor
     * @param null $nivelPractica
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
     * @param null $nombreEducadorCp
     * @param null $rutEducadorCp
     * @param null $emailEducadorCp
     * @param null $telefonoEducadorCp
     * @param null $tituloEducadorCp
     * @param null $egresadoUcsc
     */


    public function __construct(
     $carreraPrograma = null,
     $educador= null,
     $rut= null,
     $mail= null,
     $direccion= null,
     $comuna= null,
     $telefono= null,
     $profesorTutor= null,
     $nivelPractica= null,
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
     $nombreEducadorCp= null,
     $rutEducadorCp= null,
     $emailEducadorCp= null,
     $telefonoEducadorCp= null,
     $tituloEducadorCp = null,
     $egresadoUcsc= null
    ) {
        $this->carreraPrograma = $carreraPrograma;
        $this->educador = $educador;
        $this->rut = $rut;
        $this->mail = $mail;
        $this->direccion = $direccion;
        $this->comuna = $comuna;
        $this->telefono = $telefono;
        $this->profesorTutor = $profesorTutor;
        $this->nivelPractica = $nivelPractica;
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
        $this->nombreEducadorCp = $nombreEducadorCp;
        $this->rutEducadorCp = $rutEducadorCp;
        $this->emailEducadorCp = $emailEducadorCp;
        $this->telefonoEducadorCp = $telefonoEducadorCp;
        $this->tituloEducadorCp = $tituloEducadorCp;
        $this->egresadoUcsc = $egresadoUcsc;
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
                        RUN_ESTUDIANTE,
                        TIPO_SOLICITUD_ID,
                        ESTADO_SOLICITUD_ID,
                        PROFESOR_COLABORADOR_ID,
                        PROFESOR_COLABORADOR_CENTRO_PRACTICAS_ID,
                        PROGRAMACION_PRACTICA_ID
                        ) values
                        (?,?,?,?,?,?,?)
                        ON DUPLICATE KEY UPDATE ID = VALUES(ID),
                        RUN_ESTUDIANTE = VALUES(RUN_ESTUDIANTE),
                        TIPO_SOLICITUD_ID = VALUES(TIPO_SOLICITUD_ID),
                        ESTADO_SOLICITUD_ID = VALUES(ESTADO_SOLICITUD_ID),
                        PROFESOR_COLABORADOR_ID = VALUES(PROFESOR_COLABORADOR_ID),
                        PROFESOR_COLABORADOR_CENTRO_PRACTICAS_ID = VALUES(PROFESOR_COLABORADOR_CENTRO_PRACTICAS_ID),
                        PROGRAMACION_PRACTICA_ID = VALUES(PROGRAMACION_PRACTICA_ID)",
                [
                    $this->id,
                    $this->rut,
                    '2',
                    '1',
                    '6',
                    '5',
                    '3'

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
                "DELETE FROM CENTRO_PRACTICAS WHERE ID=? ",
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
