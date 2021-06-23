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

}
