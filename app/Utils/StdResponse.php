<?php
namespace App\Utils;

/**
 * Clase Respuesta estándar servicios UCSC
 *
 * @package     Componentes Comunes
 * @subpackage  Infrastructure
 * @author      Alejandro Silva <alsilva@ucsc.cl>
 */
class StdResponse
{
    /**
     * @var bool Estado que indica exito o fracaso en una operacion
     */
    public $status;

    /**
     * @var string Mensaje de salida que complementa el resultado
     */
    public $message;

    /**
     * @var object Objeto que alberga el contenido de la respuesta
     */
    public $data;

    /**
     * @var object Objeto que alberga detalles de los errores
     */
    public $error;


    /**
     * Constructor de la clase
     *
     * @param bool $status      Estado que indica exito o fracaso en una operacion
     * @param string $message   Mensaje de salida que complementa el resultado
     * @param object $data      Objeto que alberga el contenido de la respuesta
     * @param object $error     Objeto que alberga detalles de los errores
     *
     */
    public function __construct($status=false, $message=null, $data=null, $error=null)
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
        $this->error = $error;
    }
}
