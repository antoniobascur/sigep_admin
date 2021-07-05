<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Utils\Helper;
use Illuminate\Http\Request;
use Exception;
use App\Utils\RulesValidation;
use Illuminate\Support\Facades\Validator;
class EstudianteController extends Controller
{
    public function get($id){
        try {


            $result = Estudiante::get($id);

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }
    public function getAll(){
        try {


            $result = Estudiante::getAll();

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }
    public function getAllCarreras(){
        try {


            $result = Estudiante::getAllCarreras();

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }
}
