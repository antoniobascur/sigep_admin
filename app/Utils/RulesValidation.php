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
            'CARRERA_PROGRAMA' => 'required',
            'EDUCADOR' => 'required',
            'RUT' => 'required',
            'MAIL' => 'required',
            'DIRECCION' => 'required',
            'COMUNA' => 'required',
            'TELEFONO' => 'required',
            'PROFESOR_TUTOR' => 'required',
            'NIVEL_PRACTICA' => 'required',
            'CENTRO_PRACTICA' => 'required',
            'DEPENDENCIA' => 'required',
            'ENSEÑANZA' => 'required',
            'DIRECCION_CP' => 'required',
            'COMUNA_CP' => 'required',
            'TELEFONO_CP' => 'required',
            'DIRECTOR_CP' => 'required',
            'EMAIL_DIRECTOR_CP' => 'required',
            'NOMBRE_UTP_CP' => 'required',
            'EMAIL_UTP' => 'required',
            'NOMBRE_EDUCADOR_CP' => 'required',
            'RUT_EDUCADOR_CP' => 'required',
            'MAIL_EDUCADOR_CP' => 'required',
            'TELEFONO_EDUCADOR_CP' => 'required',
            'TITULO_EDUCADOR_CP' => 'required',
            'EGRESADO_UCSC' => 'required',
        ];
    }

}
