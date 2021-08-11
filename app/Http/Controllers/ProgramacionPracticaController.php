<?php

namespace App\Http\Controllers;

use App\Models\CuposProgramacionPractica;
use App\Models\ProgramacionPractica;
use Illuminate\Http\Request;
use App\Utils\Helper;
use App\Utils\RulesValidation;
use Exception;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Array_;

class ProgramacionPracticaController extends Controller
{
    public function getAll(){
        try {

            $result = ProgramacionPractica::getAll();

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }

    public function getAllCuposProgramacion($id){
        try {

            $result = CuposProgramacionPractica::getAllByIdProgramacion($id);

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }


    public function save(Request $request){
        try {
            $validator = Validator::make($request->all(), RulesValidation::ValidateProgramacionPractica());
            if ($validator->fails()) {
                //return response()->json( Helper::createStdResponse(false,"Error validación!","",$validator->errors()), 400 );
                throw new Exception($validator->errors(), 1);
            }
            $result = array();
            $id = $request->ID;

            $anio= $request->ANIO;
            $periodo= $request->PERIODO;
            $carrera= $request->CARRERA;
            $ua= $request->UA;
            $nivelPractica= $request->NIVEL_PRACTICA;
            $tipoPractica= $request->TIPO_PRACTICA;
            $nivelEnsenanza= $request->NIVEL_ENSENANZA;
            $nroSemanasPermanencia= $request->N_SEMANAS_PERMANENCIA;
            $nroHorasAula= $request->N_HORAS_AULA;
            $nroHorasAdministrativas= $request->N_HORAS_ADMINISTRATIVAS;
            $tareas= $request->TAREAS;
            $caracteristicas= $request->CARACTERISTICAS;
            $codAsignatura= $request->COD_ASIGNATURA;
            $nombreAsignatura= $request->NOMBRE_ASIGNATURA;
            $CUPOS= JSON_DECODE($request->CUPOS);
            $estado= $request->ESTADO;

//dd($CUPOS);

            $dev = new ProgramacionPractica( $anio,
                $periodo,
                $carrera,
                $ua,
                $nivelPractica,
                $tipoPractica,
                $nivelEnsenanza,
                $nroSemanasPermanencia,
                $nroHorasAula,
                $nroHorasAdministrativas,
                $tareas,
                $caracteristicas,
                $codAsignatura,
                $nombreAsignatura,
                $estado);

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

            $idProgramacionPractica=$idResp;
            $observacion=null;
            $estado="DISPONIBLE";
            foreach ($CUPOS as $valor) {
                $idCuposPractica=$valor->ID;
                //dd($valor->ID);

                $cpp= new CuposProgramacionPractica($idCuposPractica, $idProgramacionPractica, $observacion, $estado);
                $rescpp=$cpp->save();
            }
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


            $result = ProgramacionPractica::get($id);

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }

    public function delete($id)
    {
        try {


            $idResp = ProgramacionPractica::delete($id);

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
}
