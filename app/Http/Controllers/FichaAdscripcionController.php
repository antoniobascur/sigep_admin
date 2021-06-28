<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\Helper;
use App\Utils\RulesValidation;
use App\Models\FichaAdscripcion;
use Exception;
use Illuminate\Support\Facades\Validator;



class FichaAdscripcionController extends Controller
{

    public function save(Request $request){
        try {
            $validator = Validator::make($request->all(), RulesValidation::ValidateFichaAdscripcion());
            if ($validator->fails()) {
                //return response()->json( Helper::createStdResponse(false,"Error validación!","",$validator->errors()), 400 );
                throw new Exception($validator->errors(), 1);
            }
            $result = array();

            $id = $request->ID;

            $carreraPrograma=$request->CARRERA_PROGRAMA;
            $educador=$request->EDUCADOR;
            $rut=$request->RUT;
            $mail=$request->MAIL;
            $direccion=$request->DIRECCION;
            $comuna=$request->COMUNA;
            $telefono=$request->TELEFONO;
            $profesorTutor=$request->PROFESOR_TUTOR;
            $nivelPractica=$request->NIVEL_PRACTICA;
            $centroPractica=$request->CENTRO_PRACTICA;
            $dependencia=$request->DEPENDENCIA;
            $enseñanza=$request->ENSEÑANZA;
            $direccionCp=$request->DIRECCION_CP;
            $comunaCp=$request->COMUNA_CP;
            $telefonoCp=$request->TELEFONO_CP;
            $directorCp=$request->DIRECTOR_CP;
            $emailDirectorCp=$request->EMAIL_DIRECTOR_CP;
            $nombreUtpCp=$request->NOMBRE_UTP_CP;
            $emailUtp=$request->EMAIL_UTP;
            $nombreEducadorCp=$request->NOMBRE_EDUCADOR_CP;
            $rutEducadorCp=$request->RUT_EDUCADOR_CP;
            $mailEducadorCp=$request->MAIL_EDUCADOR_CP;
            $telefonoEducadorCp=$request->TELEFONO_EDUCADOR_CP;
            $tituloEducadorCp=$request->TITULO_EDUCADOR_CP;
            $egresadoUcsc=$request->EGRESADO_UCSC;

            $dev = new FichaAdscripcion($carreraPrograma,$educador,$rut,$mail,$direccion,$comuna,$telefono,$profesorTutor,$nivelPractica,$centroPractica,$dependencia,$enseñanza,$direccionCp,$comunaCp,$telefonoCp,$directorCp,$emailDirectorCp,$nombreUtpCp,$emailUtp,$nombreEducadorCp,$rutEducadorCp,$mailEducadorCp,$telefonoEducadorCp,$tituloEducadorCp,$egresadoUcsc);

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

}
