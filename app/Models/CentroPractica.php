<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class CentroPractica
 * @package App\Models
 */
class CentroPractica
{
    public $id;
    public $nombreEstablecimiento;
    public $nombreDirector;
    public $rbd;
    public $dependenciaAdministrativa;
    public $nombreJefeUtp;
    public $telefono;
    public $cuposPractica;
    public $grupoPractica;
    public $emailDirector;
    public $tipoEnsenanza;
    public $comuna;
    public $direccion;
    public $region;
    public $emailJefeUtp;

    /**
     *
     */
    const CONEXION_BD = 'mysql_SIGEP';

    /**
     * CentroPractica constructor.
     * @param null $nombreEstablecimiento
     * @param null $nombreDirector
     * @param null $rbd
     * @param null $dependenciaAdministrativa
     * @param null $nombreJefeUtp
     * @param null $telefono
     * @param null $cuposPractica
     * @param null $grupoPractica
     * @param null $emailDirector
     * @param null $tipoEnsenanza
     * @param null $comuna
     * @param null $direccion
     * @param null $region
     * @param null $emailJefeUtp
     */
    public function __construct(
        $nombreEstablecimiento = null,
        $nombreDirector = null,
        $rbd = null,
        $dependenciaAdministrativa = null,
        $nombreJefeUtp = null,
        $telefono = null,
        $cuposPractica = null,
        $grupoPractica = null,
        $emailDirector = null,
        $tipoEnsenanza = null,
        $comuna = null,
        $direccion = null,
        $region = null,
        $emailJefeUtp = null
    ) {
        $this->nombreEstablecimiento = $nombreEstablecimiento;
        $this->nombreDirector = $nombreDirector;
        $this->rbd = $rbd;
        $this->dependenciaAdministrativa = $dependenciaAdministrativa;
        $this->nombreJefeUtp = $nombreJefeUtp;
        $this->telefono = $telefono;
        $this->cuposPractica = $cuposPractica;
        $this->grupoPractica = $grupoPractica;
        $this->emailDirector = $emailDirector;
        $this->tipoEnsenanza = $tipoEnsenanza;
        $this->comuna = $comuna;
        $this->direccion = $direccion;
        $this->region = $region;
        $this->emailJefeUtp = $emailJefeUtp;

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
	        CENTRO_PRACTICAS
	  	    WHERE CENTRO_PRACTICAS.ID=?",
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
	        CENTRO_PRACTICAS
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
                "INSERT INTO CENTRO_PRACTICAS
      (ID,NOMBRE_ESTABLECIMIENTO,NOMBRE_DIRECTOR,RBD,DEPENDENCIA_ADMINISTRATIVA,NOMBRE_JEFE_UTP,TELEFONO,CUPOS_PRACTICA,GRUPO_PRACTICA,EMAIL_DIRECTOR,TIPO_ENSENANZA,COMUNA,DIRECCION,REGION,EMAIL_JEFE_UTP) values
      (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
      ON DUPLICATE KEY UPDATE ID = VALUES(ID),
NOMBRE_ESTABLECIMIENTO = VALUES(NOMBRE_ESTABLECIMIENTO),
NOMBRE_DIRECTOR = VALUES(NOMBRE_DIRECTOR),
RBD = VALUES(RBD),
DEPENDENCIA_ADMINISTRATIVA = VALUES(DEPENDENCIA_ADMINISTRATIVA),
NOMBRE_JEFE_UTP = VALUES(NOMBRE_JEFE_UTP),
TELEFONO = VALUES(TELEFONO),
CUPOS_PRACTICA = VALUES(CUPOS_PRACTICA),
GRUPO_PRACTICA = VALUES(GRUPO_PRACTICA),
EMAIL_DIRECTOR = VALUES(EMAIL_DIRECTOR),
TIPO_ENSENANZA = VALUES(TIPO_ENSENANZA),
COMUNA = VALUES(COMUNA),
DIRECCION = VALUES(DIRECCION),
REGION = VALUES(REGION),
EMAIL_JEFE_UTP = VALUES(EMAIL_JEFE_UTP)",
                [
                    $this->id,
                    $this->nombreEstablecimiento,
                    $this->nombreDirector,
                    $this->rbd,
                    $this->dependenciaAdministrativa,
                    $this->nombreJefeUtp,
                    $this->telefono,
                    $this->cuposPractica,
                    $this->grupoPractica,
                    $this->emailDirector,
                    $this->tipoEnsenanza,
                    $this->comuna,
                    $this->direccion,
                    $this->region,
                    $this->emailJefeUtp
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
