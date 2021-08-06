<?php
namespace App\Utils;


class RulesValidation{

    public static function ValidateCentroPractica(){
        return [
            'ID' => 'required',
            'NOMBRE_ESTABLECIMIENTO' => 'required',
            'RBD' => 'required',
        ];
    }
    public static function ValidateEstadoSolicitud(){
        return [
            'ID' => 'required',
            'ESTADO' => 'required',
            'DESCRIPCION' => 'required',
        ];
    }
    public static function ValidateProfesorTutor(){
    return [
        'ID' => 'required',
        'RUN' => 'required',
        'NOMBRE' => 'required',
        'APELLIDO' => 'required',
        'EMAIL' => 'required',
        'TITULO' => 'required',
    ];
    }
    public static function ValidateProfesorColab(){
        return [
            'ID' => 'required',
            'RUN' => 'required',
            'NOMBRE' => 'required',
            'APELLIDO' => 'required',
            'EMAIL' => 'required',
            'ESPECIALIDAD' => 'required',
        ];
    }

    public static function ValidateCuposPractica(){
        return [
            'ID' => 'required',
            'ANIO' => 'required',
            'PERIODO' => 'required',
            'CARRERA' => 'required',
            'MODALIDAD' => 'required',
            'ESTADO' => 'required',
            'TIPO_PRACTICA' => 'required',
            'NIVEL_ENSENANZA' => 'required',
            'CURSOS_INTERVENCION' => 'required',
            'NIVEL_PRACTICA' => 'required',
            'CENTRO_PRACTICAS_ID' => 'required',
            'RBD_CENTRO_PRACTICA' => 'required',
            'RUT_PROFESOR_COLABORADOR' => 'required',
            'PROFESOR_COLABORADOR' => 'required',
        ];
    }

    public static function ValidateTipoSolicitud(){
        return [
            'ID' => 'required',
            'TIPO_SOLICITUD' => 'required',
            'DESCRIPCION' => 'required',
        ];
    }
    public static function ValidateFichaAdscripcion(){
        return [
            'ID' => 'required',
            'CARRERA' => 'required',
            'NOMBRE' => 'required',
            'RUT' => 'required',
            'EMAIL' => 'required',
            'DIRECCION' => 'required',
            'COMUNA' => 'required',
            'TELEFONO' => 'required',
        /*    'PROFESOR_TUTOR' => 'required',
            'NIVEL_PRACTICA' => 'required',
            'RBD' => 'required',
            'CENTRO_PRACTICA' => 'required',
            'DEPENDENCIA' => 'required',
            'ENSENANZA' => 'required',
            'DIRECCION_CP' => 'required',
            'COMUNA_CP' => 'required',
            'TELEFONO_CP' => 'required',
            'DIRECTOR_CP' => 'required',
            'EMAIL_DIRECTOR_CP' => 'required',
            'NOMBRE_UTP_CP' => 'required',
            'EMAIL_UTP_CP' => 'required',
            'NOMBRE_PROF_COLABORADOR_CP' => 'required',
            'RUT_PROF_COLABORADOR_CP' => 'required',
            'EMAIL_PROF_COLABORADOR_CP' => 'required',
            'TELEFONO_PROF_COLABORADOR_CP' => 'required',
            'TITULO_PROF_COLABORADOR_CP' => 'required',
            'EGRESADO_UCSC' => 'required',
        */
        ];
    }
    public static function ValidateFichaAutogestion(){

    }

}
