<template>
    <div>
        <form ID="form" class="modal-form" @submit.prevent="validate">
            <h4>Información Educador(a) en formación </h4>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="required">RUT</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="RUT"
                        name="RUT"
                        v-model="form.RUT"
                        placeholder="Ej: 9.999.999-9"
                        v-on:keyup="searchEstudiante"
                        v-validate="'required|max:100'"
                        data-vv-as="RUT"
                        :class="{'is-invalid': errors.has('RUT')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('RUT') }}</div>
                </div>

                <div class="form-group col-md-6">
                    <label class="required">Nombre Educador(a) en formación</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="NOMBRE"
                        name="NOMBRE"
                        v-model="form.NOMBRE"
                        placeholder="Ej: Descripción ..."
                        v-validate="'required|max:100'"
                        data-vv-as="NOMBRE"
                        :class="{'is-invalid': errors.has('NOMBRE')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('NOMBRE') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Carrera </label>

                    <kendo-dropdownlist
                        :ref="'CARRERA'"
                        class="form-control"
                        name="CARRERA"
                        v-model="form.CARRERA"
                        :data-source="dsCarrera"
                        :data-text-field="'CARRERA'"
                        :data-value-field="'UA'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsCarrera')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('CARRERA') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Nivel de Práctica</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="NIVEL_PRACTICA"
                        name="NIVEL_PRACTICA"
                        v-model="form.NIVEL_PRACTICA"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="NIVEL_PRACTICA"
                        :class="{'is-invalid': errors.has('NIVEL_PRACTICA')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('NIVEL_PRACTICA') }}</div>
                </div>
                <div class="form-group col-md-12">
                    <label class="required">Nombre del Centro de Práctica</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="CENTRO_PRACTICA"
                        name="CENTRO_PRACTICA"
                        v-model="form.CENTRO_PRACTICA"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="CENTRO_PRACTICA"
                        :class="{'is-invalid': errors.has('CENTRO_PRACTICA')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('CENTRO_PRACTICA') }}</div>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">Comuna</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="COMUNA_CP"
                        name="COMUNA_CP"
                        v-model="form.COMUNA_CP"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="COMUNA_CP"
                        :class="{'is-invalid': errors.has('COMUNA_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('COMUNA_CP') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Nombre ducador(a) o Profesor(a) Colaborador(a) Centro de Práctica</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="NOMBRE_PROF_COLABORADOR_CP"
                        name="NOMBRE_PROF_COLABORADOR_CP"
                        v-model="form.NOMBRE_PROF_COLABORADOR_CP"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="NOMBRE_PROF_COLABORADOR_CP"
                        :class="{'is-invalid': errors.has('NOMBRE_PROF_COLABORADOR_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('NOMBRE_PROF_COLABORADOR_CP') }}</div>
                </div>

                <div class=" col-md-12">
                    <h4>Evaluación a el/la Educador(a) o Profesor(a) Colaborador(a) del	establecimiento</h4>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">El o la	educador(a)/profesor(a)	manifiesta compromiso ético	y formativo en su rol de colaborador(a)</label><br>
                        <input type="radio" id="siempre_1"  value="1" name="compromiso_etico">
                        <label for="siempre_1">Siempre</label>
                        <input type="radio" id="a_veces_1" value="2" name="compromiso_etico">
                        <label for="a_veces_1">A veces</label>
                        <input type="radio" id="nunca_1" value="3" name="compromiso_etico">
                        <label for="nunca_1">No observado</label>
                        <input type="radio" id="no_observado_1" value="4" name="compromiso_etico">
                        <label for="no_observado_1">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">El o la educador(a)/profesor(a) colaborador(a) genera un ambiente facilitador para promover	mi reflexión pedagógica</label><br>
                        <input type="radio" id="siempre_2"  value="1" name="ambiente">
                        <label for="siempre_2">Siempre</label>
                        <input type="radio" id="a_veces_2" value="2" name="ambiente">
                        <label for="a_veces_2">A veces</label>
                        <input type="radio" id="nunca_2" value="3" name="ambiente">
                        <label for="nunca_2">No observado</label>
                        <input type="radio" id="no_observado_2" value="4" name="ambiente">
                        <label for="no_observado_2">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">El o la educador(a)/profesor(a) colaborador(a) me guía en el diseño, implementación	y evaluación de propuestas pedagógicas pertinentes a los y las estudiantes y al	contexto</label><br>
                        <input type="radio" id="siempre_3"  value="1" name="propuestas_pedagógicas">
                        <label for="siempre_3">Siempre</label>
                        <input type="radio" id="a_veces_3" value="2" name="propuestas_pedagógicas">
                        <label for="a_veces_3">A veces</label>
                        <input type="radio" id="nunca_3" value="3" name="propuestas_pedagógicas">
                        <label for="nunca_3">No observado</label>
                        <input type="radio" id="no_observado_3" value="4" name="propuestas_pedagógicas">
                        <label for="no_observado_3">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">El o la educador(a)/profesor(a) colaborador(a) me guía en el proceso de autoevaluación de mi propio desempeño pedagógico</label><br>
                        <input type="radio" id="siempre_4"  value="1" name="desempeño_pedagógico">
                        <label for="siempre_4">Siempre</label>
                        <input type="radio" id="a_veces_4" value="2" name="desempeño_pedagógico">
                        <label for="a_veces_4">A veces</label>
                        <input type="radio" id="nunca_4" value="3" name="desempeño_pedagógico">
                        <label for="nunca_4">No observado</label>
                        <input type="radio" id="no_observado_4" value="4" name="desempeño_pedagógico">
                        <label for="no_observado_4">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">El o la educador(a)/profesor(a) colaborador(a) me realiza	observaciones y sugerencias	para mejorar mi desempeño docente</label><br>
                        <input type="radio" id="siempre_5"  value="1" name="observaciones">
                        <label for="siempre_5">Siempre</label>
                        <input type="radio" id="a_veces_5" value="2" name="observaciones">
                        <label for="a_veces_5">A veces</label>
                        <input type="radio" id="nunca_5" value="3" name="observaciones">
                        <label for="nunca_5">No observado</label>
                        <input type="radio" id="no_observado_5" value="4" name="observaciones">
                        <label for="no_observado_5">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">El o la educador(a)/profesor(a) colaborador(a) reflexiona sobre	el alcance que tales observaciones y sugerencias han tenido	en mi práctica</label><br>
                        <input type="radio" id="siempre_6"  value="1" name="reflexion_observaciones">
                        <label for="siempre_6">Siempre</label>
                        <input type="radio" id="a_veces_6" value="2" name="reflexion_observaciones">
                        <label for="a_veces_6">A veces</label>
                        <input type="radio" id="nunca_6" value="3" name="reflexion_observaciones">
                        <label for="nunca_6">No observado</label>
                        <input type="radio" id="no_observado_6" value="4" name="reflexion_observaciones">
                        <label for="no_observado_6">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">El o la educador(a)/profesor(a) colaborador(a) se preocupa por integrarme en las distintas actividades del establecimiento educacional y de	su comunidad</label><br>
                        <input type="radio" id="siempre_7"  value="1" name="integracion_actividades">
                        <label for="siempre_7">Siempre</label>
                        <input type="radio" id="a_veces_7" value="2" name="integracion_actividades">
                        <label for="a_veces_7">A veces</label>
                        <input type="radio" id="nunca_7" value="3" name="integracion_actividades">
                        <label for="nunca_7">No observado</label>
                        <input type="radio" id="no_observado_7" value="4" name="integracion_actividades">
                        <label for="no_observado_7">No observado</label>
                    </div>

                </div>

                <div class=" col-md-12">
                    <h4>Evaluación al centro de	práctica</h4>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">El centro de práctica y su equipo profesional, han favorecido mi integración al nuevo contexto educativo</label><br>
                        <input type="radio" id="siempre_8"  value="1" name="integracion">
                        <label for="siempre_8">Siempre</label>
                        <input type="radio" id="a_veces_8" value="2" name="integracion">
                        <label for="a_veces_8">A veces</label>
                        <input type="radio" id="nunca_8" value="3" name="integracion">
                        <label for="nunca_8">No observado</label>
                        <input type="radio" id="no_observado_8" value="4" name="integracion">
                        <label for="no_observado_8">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">El centro de práctica constituye un espacio adecuado de gestión y formación para mi aprendizaje	como futuro	profesor</label><br>
                        <input type="radio" id="siempre_9"  value="1" name="espacio_adecuado">
                        <label for="siempre_9">Siempre</label>
                        <input type="radio" id="a_veces_9" value="2" name="espacio_adecuado">
                        <label for="a_veces_9">A veces</label>
                        <input type="radio" id="nunca_9" value="3" name="espacio_adecuado">
                        <label for="nunca_9">No observado</label>
                        <input type="radio" id="no_observado_9" value="4" name="espacio_adecuado">
                        <label for="no_observado_9">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">El centro de práctica me permite desarrollar la	colaboración, intervenciones pedagógicas y/u otras actividades	exigidas por la	universidad</label><br>
                        <input type="radio" id="siempre_10"  value="1" name="permite_desarrollo">
                        <label for="siempre_10">Siempre</label>
                        <input type="radio" id="a_veces_10" value="2" name="permite_desarrollo">
                        <label for="a_veces_10">A veces</label>
                        <input type="radio" id="nunca_10" value="3" name="permite_desarrollo">
                        <label for="nunca_10">No observado</label>
                        <input type="radio" id="no_observado_10" value="4" name="permite_desarrollo">
                        <label for="no_observado_10">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">El centro de práctica respeta mis tiempos destinados por la	universidad, a las tareas propias del nivel	de práctica	que	desarrollo</label><br>
                        <input type="radio" id="siempre_11"  value="1" name="tiempos_destinados">
                        <label for="siempre_11">Siempre</label>
                        <input type="radio" id="a_veces_11" value="2" name="tiempos_destinados">
                        <label for="a_veces_11">A veces</label>
                        <input type="radio" id="nunca_11" value="3" name="tiempos_destinados">
                        <label for="nunca_11">No observado</label>
                        <input type="radio" id="no_observado_11" value="4" name="tiempos_destinados">
                        <label for="no_observado_11">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">Los	alumnos del	centro de práctica al que asisto se	involucran en las actividades que realizo</label><br>
                        <input type="radio" id="siempre_12"  value="1" name="alumnos_involucrados">
                        <label for="siempre_12">Siempre</label>
                        <input type="radio" id="a_veces_12" value="2" name="alumnos_involucrados">
                        <label for="a_veces_12">A veces</label>
                        <input type="radio" id="nunca_12" value="3" name="alumnos_involucrados">
                        <label for="nunca_12">No observado</label>
                        <input type="radio" id="no_observado_12" value="4" name="alumnos_involucrados">
                        <label for="no_observado_12">No observado</label>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="required">Comentarios</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="COMENTARIOS"
                            name="COMENTARIOS"
                            v-model="form.COMENTARIOS"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="COMENTARIOS"
                            :class="{'is-invalid': errors.has('COMENTARIOS')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('COMENTARIOS') }}</div>
                    </div>

                </div>



            </div>


            <button type="submit" class="btn btn-primary float-right" :disabled="submit">
                <i
                    class="fa"
                    :class="{'fa-floppy-o': !submit, 'fa-spinner fa-spin': submit}"
                    aria-hidden="true"
                ></i>
                Guardar
            </button>

        </form>
    </div>
</template>

<script>
import Loading from "../../common/Loading";
import {DateInput} from "@progress/kendo-vue-dateinputs";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import Urls from "../../common/json/Urls.json";
import AlertMessage from "../../common/json/AlertMessage.json";
import eventHub from "../../../eventHub";


export default {
    components: {
        Loading,
        MultiSelect,
        DateInput,
    },
    data: function () {
        return{
            submit:false,
            dsCarrera:[]

        }

    },
    computed: {
        form() {
            return this.$store.state.fichaEvaluacion;
        },
    },

    created: function () {
        this.getCarreras();
    },
    methods: {

        resetForm() {
            this.form.ID = 0;
            this.form.RUT = null;
            this.form.NOMBRE = null;
            this.form.CENTRO_PRACTICA = false;
        },
        validate() {
            this.$validator.validate().then((results) => {
                if (results) this.saveForm();
                else {
                    toastr.error(
                        AlertMessage.FORMULARIO.VALIDATE_ERROR
                    );
                }
            });
        },

        searchEstudiante() {
            var keyword = this.form.RUT;

            if (keyword != null && keyword.length > 7) {
                //traer informacion del estudiante
                //console.log(keyword);
                console.log('traer informacion del estudiante');
                this.getEstudiante(keyword)
            }
        },
        getEstudiante(id){
            let url = Urls["ESTUDIANTES"].GET+id;
            axios
                .get(url, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    console.log(response.data.data);


                    if (response.data.data.length > 0) {
                        this.form.NOMBRE = response.data.data[0].NOMBRE + " " +response.data.data[0].APELLIDO ;
                        this.form.EMAIL = response.data.data[0].EMAIL;
                        this.form.CARRERA = response.data.data[0].UA;
                        this.form.DIRECCION = response.data.data[0].DIRECCION;
                        this.form.TELEFONO = response.data.data[0].TELEFONO;
                        this.form.COMUNA = response.data.data[0].COMUNA;


                    }
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    eventHub.$emit("LoadingOff");
                });
        },
        getCarreras(){
            let url = Urls["CARRERAS"].GET_ALL;
            axios
                .get(url, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    //console.log(response.data.data);
                    if (response.data.data.length > 0) {
                        this.dsCarrera = response.data.data;
                    }
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    eventHub.$emit("LoadingOff");
                });

        },


    }
}
</script>
