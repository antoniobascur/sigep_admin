<?php

namespace App\Http\Controllers;

use App\Models\FichaAdscripcion;
use App\Utils\Helper;
use App\Utils\RulesValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FichaController extends Controller
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

            $carrera=$request->CARRERA;
            $nombre=$request->NOMBRE;
            $rut=$request->RUT;
            $email=$request->EMAIL;
            $direccion=$request->DIRECCION;
            $comuna=$request->COMUNA;
            $telefono=$request->TELEFONO;
            $profesorTutor=$request->PROFESOR_TUTOR;
            $nivelPractica=$request->NIVEL_PRACTICA;
            $rbd=$request->RBD;
            $centroPractica=$request->CENTRO_PRACTICA;
            $dependencia=$request->DEPENDENCIA;
            $ensenanza=$request->ENSENANZA;
            $direccionCp=$request->DIRECCION_CP;
            $comunaCp=$request->COMUNA_CP;
            $telefonoCp=$request->TELEFONO_CP;
            $directorCp=$request->DIRECTOR_CP;
            $emailDirectorCp=$request->EMAIL_DIRECTOR_CP;
            $nombreUtpCp=$request->NOMBRE_UTP_CP;
            $emailUtpCp=$request->EMAIL_UTP_CP;
            $nombreProfesorColaboradorCp=$request->NOMBRE_PROFESOR_COLABORADOR_CP;
            $rutProfesorColaboradorCp=$request->RUT_PROFESOR_COLABORADOR_CP;
            $emailProfesorColaboradorCp=$request->EMAIL_PROFESOR_COLABORADOR_CP;
            $telefonoProfesorColaboradorCp=$request->TELEFONO_PROFESOR_COLABORADOR_CP;
            $tituloProfesorColaboradorCp=$request->TITULO_PROFESOR_COLABORADOR_CP;
            $egresadoUcsc=$request->EGRESADO_UCSC;

            $dev = new FichaAdscripcion($carrera,$nombre,$rut,$email,$direccion,$comuna,$telefono,$profesorTutor,$nivelPractica,$rbd,$centroPractica,$dependencia,$ensenanza,$direccionCp,$comunaCp,$telefonoCp,$directorCp,$emailDirectorCp,$nombreUtpCp,$emailUtpCp,$nombreProfesorColaboradorCp,$rutProfesorColaboradorCp,$emailProfesorColaboradorCp,$telefonoProfesorColaboradorCp,$tituloProfesorColaboradorCp,$egresadoUcsc);

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
