<?php

namespace App\Http\Controllers;

use App\Models\CuposProgramacionPractica;
use Illuminate\Http\Request;
use App\Utils\Helper;
use App\Utils\RulesValidation;
use Exception;
use Illuminate\Support\Facades\Validator;

class CuposProgramacionPracticaController extends Controller
{
    public function getCuposByCuposProgramacionPractica(Request $request){
        try {

            $anio=$request->ANIO;
            $periodo=$request->PERIODO;
            $ua=$request->UA;
            $tipoPractica=$request->TIPO_PRACTICA;
            $nivelPractica=$request->NIVEL_PRACTICA;
            $result = CuposProgramacionPractica::getCuposByCuposProgramacionPractica($anio,$periodo,$ua,$tipoPractica,$nivelPractica);

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }
}
