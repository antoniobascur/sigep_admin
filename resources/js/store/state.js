// state
export const state = {
    dsCuposPracticas:{
        data: []
    },
    dsCentroPracticas: {
        data: []
    },
    dsEstadoSolicitud: {
        data: []
    },
    dsProfesorTutor: {
        data: []
    },
    dsTipoSolicitud: {
        data: []
    },
    dsProgramacionPracticas:{
        data: []
    },
    dsSteps: {
        data: []
    },
    ficha:{
        CARRERA: null,
        NOMBRE: null,
        RUT: null,
        EMAIL: null,
        DIRECCION: null,
        COMUNA: null,
        TELEFONO: null,
        PROFESOR_TUTOR: null,
        NIVEL_PRACTICA: null,
        HORAS_PASANTIA: null,
        RBD: null,
        CENTRO_PRACTICA: null,
        DEPENDENCIA: null,
        ENSENANZA: null,
        DIRECCION_CP: null,
        COMUNA_CP: null,
        TELEFONO_CP: null,
        DIRECTOR_CP: null,
        EMAIL_DIRECTOR_CP: null,
        NOMBRE_UTP_CP: null,
        EMAIL_UTP_CP: null,
        NOMBRE_PROF_COLABORADOR_CP: null,
        RUT_PROF_COLABORADOR_CP: null,
        EMAIL_PROF_COLABORADOR_CP: null,
        TELEFONO_PROF_COLABORADOR_CP: null,
        TITULO_PROF_COLABORADOR_CP: null,
        EGRESADO_UCSC: null,
        NOMBRE_OTORGA_CUPO: null,
        TELEFONO_OTORGA_CUPO: null,
        EMAIL_OTORGA_CUPO: null,
        OBSERVACION_HORARIO_CURSO: null,
        RAZON_CONTINUIDAD: null,
        CANTIDAD_VECES: null,
        EXALUMNO: null,
        PROPOSITO_VISITA: null,
        FECHA_VISITA: null,
        N_VISITA: null,
        OBSERVACIONES_VISITA: null,
    },

    fichaAutogestion:{
        RUT: null,
        CARRERA: null,
        NIVEL_PRACTICA: null,
        NOMBRE: null,
        EMAIL: null,
        TELEFONO: null,
        RBD: null,
        CENTRO_PRACTICA: null,
        DIRECTOR_CP: null,
        DEPENDENCIA: null,
        TELEFONO_CP: null,
        NOMBRE_OTORGA_CUPO: null,
        TELEFONO_OTORGA_CUPO: null,
        EMAIL_OTORGA_CUPO: null,
        NOMBRE_PROF_COLABORADOR_CP: null,

    },
    fichaContinuidad:{
        RUT: null,
        CARRERA: null,
        NIVEL_PRACTICA: null,
        NOMBRE: null,
        EMAIL: null,
        TELEFONO: null,
        RBD: null,
        CENTRO_PRACTICA: null,
        DIRECTOR_CP: null,
        DEPENDENCIA: null,
        TELEFONO_CP: null,
        CANTIDAD_VECES: null,
        EXALUMNO: null,
        NOMBRE_PROF_COLABORADOR_CP: null,
        OBSERVACION_HORARIO_CURSO: null,
        RAZON_CONTINUIDAD: null,
    },
    fichaCupos: {
        ID: 0,
        ANIO: null,
        PERIODO: null,
        CARRERA: null,
        UA: null,
        RBD_CENTRO_PRACTICA:null,
        ID_CENTRO_PRACTICA:null,
        CENTRO_PRACTICA:null,
        NIVEL_PRACTICA: null,
        NIVEL_ENSENANZA: null,
        MODALIDAD_PRACTICA: null,
        CURSO_INTERVENCION: null,
        PROF_COLABORADOR: null,
        RUN_PROF_COLABORADOR: null,
        ESTADO:"DISPONIBLE",
        TIPO_PRACTICA:null,
        EDITAR_FORMULARIO:false
    },
    fichaProgramacion:{
        ID: 0,
        ANIO: null,
        PERIODO: null,
        CARRERA: null,
        UA: null,
        NIVEL_PRACTICA: null,
        TIPO_PRACTICA: null,
        NIVEL_ENSENANZA: null,
        N_SEMANAS_PERMANENCIA: null,
        N_HORAS_AULA: null,
        N_HORAS_ADMINISTRATIVAS: null,
        TAREAS: null,
        CARACTERISTICAS: null,
        CODIGO_ASIGNATURA: null,
        NOMBRE_ASIGNATURA: null,
        SECCION_ASIGNATURA:null,
        PROFESOR_ASIGNATURA:null,
        RUT_PROFESOR_ASIGNATURA:null,
        RBD: null,
        CENTRO_PRACTICA: null,
        COMUNA_PRACTICA: null,
        CUPOS_PRACTICA: null,
        ESTADO:"ACTIVO",
        CUPOS:[]
    }



}
