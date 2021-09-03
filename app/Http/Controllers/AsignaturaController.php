<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;
use App\Utils\Helper;
use Exception;
use App\Utils\RulesValidation;
use Illuminate\Support\Facades\Validator;

class AsignaturaController extends Controller
{
    public function getByCode($code){
        try {
            $result = Asignatura::getByCode($code);

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }

    public function getAllByUa($code){
        try {
            if($code!=0){
                $result = Asignatura::getAllByUa($code);
            }else{
                $result = Asignatura::getAll();

            }


            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }


}
