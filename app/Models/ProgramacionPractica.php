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
    public $nivelEnsenanza;
    public $nroSemanasPermanencia;
    public $nroHorasAula;
    public $nroHorasAdministrativas;
    public $tareas;
    public $caracteristicas;
    public $codAsignatura;
    public $nombreAsignatura;
    public $observacion;
    public $fechaActualizacion;
    public $estado;

    const CONEXION_BD = 'mysql_SIGEP';

    /**
     * @param $anio
     * @param $periodo
     * @param $carrera
     * @param $ua
     * @param $nivelPractica
     * @param $nivelEnsenanza
     * @param $nroSemanasPermanencia
     * @param $nroHorasAula
     * @param $nroHorasAdministrativas
     * @param $tareas
     * @param $caracteristicas
     * @param $codAsignatura
     * @param $nombreAsignatura
     * @param $observacion
     * @param $fechaActualizacion
     * @param $estado
     */
    public function __construct(
        $anio,
        $periodo,
        $carrera,
        $ua,
        $nivelPractica,
        $nivelEnsenanza,
        $nroSemanasPermanencia,
        $nroHorasAula,
        $nroHorasAdministrativas,
        $tareas,
        $caracteristicas,
        $codAsignatura,
        $nombreAsignatura,
        $observacion,
        $fechaActualizacion,
        $estado
    ) {
        $this->anio = $anio;
        $this->periodo = $periodo;
        $this->carrera = $carrera;
        $this->ua = $ua;
        $this->nivelPractica = $nivelPractica;
        $this->nivelEnsenanza = $nivelEnsenanza;
        $this->nroSemanasPermanencia = $nroSemanasPermanencia;
        $this->nroHorasAula = $nroHorasAula;
        $this->nroHorasAdministrativas = $nroHorasAdministrativas;
        $this->tareas = $tareas;
        $this->caracteristicas = $caracteristicas;
        $this->codAsignatura = $codAsignatura;
        $this->nombreAsignatura = $nombreAsignatura;
        $this->observacion = $observacion;
        $this->fechaActualizacion = $fechaActualizacion;
        $this->estado = $estado;
    }



}
