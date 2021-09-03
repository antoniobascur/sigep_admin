<?php

namespace App\Http\Controllers;

use App\Models\CupoPractica;
use Illuminate\Http\Request;
use App\Utils\Helper;
use App\Utils\RulesValidation;
use Exception;
use Illuminate\Support\Facades\Validator;

class CuposPracticasController extends Controller
{
    public function getAll(){
        try {

            $result = CupoPractica::getAll();

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }

    public function save(Request $request){
        try {
            $validator = Validator::make($request->all(), RulesValidation::ValidateCuposPractica());
            if ($validator->fails()) {
                //return response()->json( Helper::createStdResponse(false,"Error validación!","",$validator->errors()), 400 );
                throw new Exception($validator->errors(), 1);
            }
            $result = array();
            $id = $request->ID;

            $anio=$request->ANIO;
            $periodo=$request->PERIODO;
            $carrera=$request->CARRERA;
            $ua=$request->UA;
            $modalidad=$request->MODALIDAD;
            $estado=$request->ESTADO;
            $tipoPractica=$request->TIPO_PRACTICA;
            $nivelEnsenanza=$request->NIVEL_ENSENANZA;
            $cursosIntervencion=$request->CURSOS_INTERVENCION;
            $nivelPractica=$request->NIVEL_PRACTICA;
            $idCentroPractica=$request->CENTRO_PRACTICAS_ID;
            $rbdCentroPractica=$request->RBD_CENTRO_PRACTICA;
            $rutProfesorColaborador=$request->RUT_PROFESOR_COLABORADOR;
            $profesorColaborador=$request->PROFESOR_COLABORADOR;

            $dev = new CupoPractica($anio,$periodo,$carrera,$ua,$modalidad,$estado,$tipoPractica,$nivelEnsenanza,$cursosIntervencion,$nivelPractica,$idCentroPractica,$rbdCentroPractica,$rutProfesorColaborador,$profesorColaborador);

            if ($id != 0) {
                $dev->id = $id;

            } else{
                $dev->id ="";
            }
            $idResp = $dev->save();


            if (!is_numeric($idResp)) {
                throw new Exception($idResp, 1);
            }
            $dev->id = $idResp;
            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $dev);
        } catch (Exception $e) {
            return response()->json(
                Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()),
                400
            );
        }
        return response()->json($respuesta, 200);
    }

    public function get($id){
        try {


            $result = CupoPractica::get($id);

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }

    public function delete($id)
    {
        try {


            $idResp = CupoPractica::delete($id);

            if (!is_numeric($idResp)) {
                throw new Exception($idResp, 3);
            }
            if ($idResp == 0) {
                //$cuestionario->updateState();
                $respuesta = Helper::createStdResponse(
                    false,
                    "No se puede eliminar",
                    $idResp
                );
            } else {
                $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $idResp);
            }

            return response()->json($respuesta, 200);
        } catch (Exception $e) {
            return response()->json(
                Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()),
                400
            );
        }
    }

    public function getCuposByProgramacion(Request $request){
        try {

            $anio=$request->ANIO;
            $periodo=$request->PERIODO;
            $ua=$request->UA;
            $tipoPractica=$request->TIPO_PRACTICA;
            $nivelPractica=$request->NIVEL_PRACTICA;
            $result = CupoPractica::getCuposByProgramacion($anio,$periodo,$ua,$tipoPractica,$nivelPractica);

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }


}
