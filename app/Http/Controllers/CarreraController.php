<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use App\Utils\Helper;
use Exception;
use App\Utils\RulesValidation;
use Illuminate\Support\Facades\Validator;

class CarreraController extends Controller
{
    public function getAll(){
        try {


            $result = Carrera::getAll();

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }
}
