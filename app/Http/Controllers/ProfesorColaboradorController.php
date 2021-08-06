<?php

namespace App\Http\Controllers;

use App\Models\ProfesorColaborador;
use Illuminate\Http\Request;
use App\Utils\Helper;
use App\Utils\RulesValidation;
use Exception;
use Illuminate\Support\Facades\Validator;
class ProfesorColaboradorController extends Controller
{
    public function getAll(){
        try {

            $result = ProfesorColaborador::getAll();

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }
    public function save(Request $request){
        try {
            $validator = Validator::make($request->all(), RulesValidation::ValidateProfesorColab());
            if ($validator->fails()) {
                //return response()->json( Helper::createStdResponse(false,"Error validación!","",$validator->errors()), 400 );
                throw new Exception($validator->errors(), 1);
            }
            $result = array();
            $id = $request->ID;

            $run=$request->RUN;
            $nombre=$request->NOMBRE;

            $email=$request->EMAIL;
            $especialidad=$request->ESPECIALIDAD;
            $fono=$request->FONO;
            $egresadoUcsc=$request->EGRESADO_USCS;

            $dev = new ProfesorColaborador($run, $nombre, $email,$especialidad,$fono,$egresadoUcsc);

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

    public function get($idprofesorColaborador){
        try {


            $result = ProfesorColaborador::get($idprofesorColaborador);

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }

    public function getByRun(Request $request){
        try {
            $RunProfesorColaborador=$request->RUN;

            $result = ProfesorColaborador::getByRun($RunProfesorColaborador);

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }
    public function delete($idprofesorColaborador)
    {
        try {


            $idResp = ProfesorColaborador::delete($idprofesorColaborador);

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
