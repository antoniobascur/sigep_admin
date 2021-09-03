<?php

namespace App\Http\Controllers;

use App\Models\CuposProgramacionPractica;
use App\Models\Ficha;
use App\Utils\Helper;
use App\Utils\RulesValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

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
            $tipoFicha=$request->TIPO_FICHA;
            $rutEstudiante=$request->RUT_ESTUDIANTE;
            $nombreEstudiante=$request->NOMBRE_ESTUDIANTE;
            $emailEstudiante=$request->EMAIL_ESTUDIANTE;
            $telefonoEstudiante=$request->TELEFONO_ESTUDIANTE;
            $anio=$request->ANIO;
            $periodo=$request->PERIODO;
            $carrera=$request->CARRERA;
            $ua=$request->UA;
            $nivelPractica=$request->NIVEL_PRACTICA;
            $tipoPractica=$request->TIPO_PRACTICA;
            $idCuposProgramacionPractica=$request->ID_CUPOS_PROGRAMACION_PRACTICA;
            $cantidadVeces=$request->CANTIDAD_VECES;
            $exAlumnoEstablecimiento=$request->EX_ALUMNO_ESTABLECIMIENTO;
            $razonContinuidad=$request->RAZON_CONTINUIDAD;
            $rbdCp=$request->RBD_CP;
            $nombreCp=$request->NOMBRE_CP;
            $comunaCp=$request->COMUNA_CP;
            $regionCp=$request->REGION_CP;
            $dependenciaCp=$request->DEPENDENCIA_CP;
            $tipoEnsenanzaCp=$request->TIPO_ENSENANZA_CP;
            $directivoCp=$request->DIRECTIVO_CP;
            $cargoDirectivoCp=$request->CARGO_DIRECTIVO_CP;
            $telefonoCp=$request->TELEFONO_CONTACTO_CP;
            $emailCp=$request->EMAIL_CONTACTO_CP;
            $modalidadPracticaCupo=$request->MODALIDAD_PRACTICA_CUPO;
            $cursoIntervencionCupo=$request->CURSO_INTERVENCION_CUPO;
            $nombreProfesorColaboradorCupo=$request->NOMBRE_PROF_COLABORADOR_CUPO;
            $emailProfesorColaboradorCupo=$request->EMAIL_PROF_COLABORADOR_CUPO;
            $funcionProfesorColaboradorCupo=$request->FUNCION_PROF_COLABORADOR_CUPO;
            $infoCupo= json_decode($request->INFO_CUPO);
            //falta agregar esto en el front
            $observacion=$request->OBSERVACION;
            $estado="ACTIVO";
            $nIntegrantesCupo=$infoCupo->N_INTEGRANTES_CUPOS_PRACTICA;
            if($tipoFicha=="ADSCRIPCION"){
                $modalidadPracticaCupo=$infoCupo->MODALIDAD;
            }
            date_default_timezone_set("America/Santiago");
            $fechaHora = date("Y-m-d G:i:s");


            //se inserta o actualiza la ficha
            $dev = new Ficha($id,
                $tipoFicha,
                $rutEstudiante,
                "",
                "",
                $observacion,
                false,
                null,
                $idCuposProgramacionPractica
               );
            $dev->estado ="ACTIVO";

            if ($id != 0) {
                $dev->id = $id;
                $dev->fechaHoraActualizacion = $fechaHora;
            } else{
                $dev->id ="";
                $dev->fechaHoraCreacion =$fechaHora;
            }
            $idResp = $dev->save();

            if (!is_numeric($idResp)) {
                throw new Exception($idResp, 1);
            }
            $dev->id = $idResp;


            ///actualizar cupo
            ///
            if($nIntegrantesCupo<$modalidadPracticaCupo){
                CuposProgramacionPractica::updateEstado($idCuposProgramacionPractica,$nIntegrantesCupo+1,($modalidadPracticaCupo===$nIntegrantesCupo+1)?"OCUPADO":"DISPONIBLE",$fechaHora);
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


    public function getAll(){
        try {

            $result = Ficha::getAll();

            $respuesta = Helper::createStdResponse(true, "Procesado con éxito!", $result);
        } catch (Exception $e) {
            return response()->json(Helper::createStdResponse(false, "Error " . $e->getCode(), "", $e->getMessage()), 400);
        }
        return response()->json($respuesta, 200);
    }



}
