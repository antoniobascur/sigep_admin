<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\Helper;
use App\Utils\RulesValidation;
use App\Models\EstadoSolicitud;
use Exception;
use Illuminate\Support\Facades\Validator;

class EstadoSolicitudController extends Controller
{
    public function getAll(){
        try {

            $result = EstadoSolicitud::getAll();

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }

    public function save(Request $request){
        try {
            $validator = Validator::make($request->all(), RulesValidation::ValidateEstadoSolicitud());
            if ($validator->fails()) {
                //return response()->json( Helper::createStdResponse(false,"Error validación!","",$validator->errors()), 400 );
                throw new Exception($validator->errors(), 1);
            }
            $result = array();
            $id = $request->ID;

            $estado=$request->ESTADO;
            $descripcion=$request->DESCRIPCION;

            $dev = new EstadoSolicitud($estado, $descripcion);

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

    public function get($idEstadoSolicitud){
        try {


            $result = EstadoSolicitud::get($idEstadoSolicitud);

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }

    public function delete($idEstadoSolicitud){
        try {


            $idResp = EstadoSolicitud::delete($idEstadoSolicitud);

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
