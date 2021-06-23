<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\Helper;
use App\Utils\RulesValidation;
use App\Models\CentroPractica;
use Exception;
use Illuminate\Support\Facades\Validator;

class CentroPracticasController extends Controller
{

    public function getAll(){
        try {


            $result = CentroPractica::getAll();

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }

    public function save(Request $request){
        try {
            $validator = Validator::make($request->all(), RulesValidation::ValidateCentroPractica());
            if ($validator->fails()) {
                //return response()->json( Helper::createStdResponse(false,"Error validación!","",$validator->errors()), 400 );
                throw new Exception($validator->errors(), 1);
            }
            $result = array();
            $id = $request->ID;

            $nombreEstablecimiento=$request->NOMBRE_ESTABLECIMIENTO;
            $nombreDirector=$request->NOMBRE_DIRECTOR;
            $rbd=$request->RBD;
            $dependenciaAdministrativa=$request->DEPENDENCIA_ADMINISTRATIVA;
            $nombreJefeUtp=$request->NOMBRE_JEFE_UTP;
            $telefono=$request->TELEFONO;
            $cuposPractica=$request->CUPOS_PRACTICA;
            $grupoPractica=$request->GRUPO_PRACTICA;
            $emailDirector=$request->EMAIL_DIRECTOR;
            $tipoEnsenanza=$request->TIPO_ENSENANZA;
            $comuna=$request->COMUNA;
            $direccion=$request->DIRECCION;
            $region=$request->REGION;
            $emailJefeUtp=$request->EMAIL_JEFE_UTP;
            $dev = new CentroPractica($nombreEstablecimiento, $nombreDirector, $rbd, $dependenciaAdministrativa, $nombreJefeUtp, $telefono, $cuposPractica, $grupoPractica, $emailDirector, $tipoEnsenanza, $comuna, $direccion, $region, $emailJefeUtp);

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

    public function get($idCentroPracticas){
        try {


            $result = CentroPractica::get($idCentroPracticas);

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }

    public function delete($idCentroPracticas){
        try {


            $idResp = CentroPractica::delete($idCentroPracticas);

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
