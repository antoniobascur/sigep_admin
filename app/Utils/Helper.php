<?php
namespace App\Utils;

/**
 * Utilitarios globales para aplicaciones UCSC
 *
 * @package     Componentes Comunes
 * @subpackage  Utils
 * @author      Alejandro Silva <alsilva@ucsc.cl>
 */
class Helper {
    /**
     * Constructor de respuesta estándar servicios UCSC
     *
     * @return StdResponse      Objeto respuesta estándar UCSC
     *
     */
    public static function createStdResponse($status=false, $message=null, $data=null, $error=null){
        return new StdResponse($status, $message, $data, $error);
    }



    /**
     * Obtiene el digito verificador de un rut y lo formatea.
     *
     * @param  integer $rut Rut sin puntos ni gión ni digito verificador.
     * @return string Rut formateado y con digito verificador.
     */
    public static function formateaRut($rut)
    {
        // Obtiene digito verifcador
        $rutCompleto=$rut;
        $s=1;
        for($m=0;$rut!=0;$rut/=10){
            $s=($s+$rut%10*(9-$m++%6))%11;
        }
        // Retorna rut formateado
        $rutCompleto = $rutCompleto . chr($s?$s+47:75);
        return number_format(substr($rutCompleto,0,-1),0,"", ".").'-'.substr($rutCompleto,strlen($rutCompleto)-1,1);
    }


    /**
     * Envía hacia el cliente respuesta estándar UCSC en formato JSON
     *
     * @param StdResponse $response     Objeto respuesta estándar UCSC
     *
     */
    public static function jsonResponse(StdResponse $response){
        header("Content-type: application/json; charset=utf-8");
        print_r(json_encode($response));
        exit;
    }



}
