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
                <div class="form-group col-md-3">
                    <label class="required">FECHA</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="FECHA"
                        name="FECHA"
                        v-model="form.FECHA"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="FECHA"
                        :class="{'is-invalid': errors.has('FECHA')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('FECHA') }}</div>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">Email</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="EMAIL"
                        name="EMAIL"
                        v-model="form.EMAIL"
                        placeholder="Ej: ejemplo@email.com..."
                        v-validate="'required|max:100'"
                        data-vv-as="EMAIL"
                        :class="{'is-invalid': errors.has('EMAIL')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('EMAIL') }}</div>
                </div>

                <div class="form-group col-md-3">
                    <label class="required">Teléfono</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="TELEFONO"
                        name="TELEFONO"
                        v-model="form.TELEFONO"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="TELEFONO"
                        :class="{'is-invalid': errors.has('TELEFONO')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('TELEFONO') }}</div>
                </div>

                <div class="form-group col-md-3">
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
                <div class=" col-md-12">
                    <h4>Ámbitos	de	observación</h4>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">Asiste	con	puntualidad</label><br>
                        <input type="radio" id="siempre_1"  value="1" name="asistencia">
                        <label for="siempre_1">Siempre</label>
                        <input type="radio" id="a_veces_1" value="2" name="asistencia">
                        <label for="a_veces_1">A veces</label>
                        <input type="radio" id="no_observado_1" value="3" name="asistencia">
                        <label for="no_observado_1">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">Su presentación	personal es adecuada según las normas del establecimiento</label><br>
                        <input type="radio" id="siempre_2"  value="1" name="presentacion_personal">
                        <label for="siempre_2">Siempre</label>
                        <input type="radio" id="a_veces_2" value="2" name="presentacion_personal">
                        <label for="a_veces_2">A veces</label>
                        <input type="radio" id="no_observado_2" value="3" name="presentacion_personal">
                        <label for="no_observado_2">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">Se adapta a las normas del centro de practica</label><br>
                        <input type="radio" id="siempre_3"  value="1" name="normas_practica">
                        <label for="siempre_3">Siempre</label>
                        <input type="radio" id="a_veces_3" value="2" name="normas_practica">
                        <label for="a_veces_3">A veces</label>
                        <input type="radio" id="no_observado_3" value="3" name="normas_practica">
                        <label for="no_observado_3">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">Informa de sus tareas y responsabilidades como practicante</label><br>
                        <input type="radio" id="siempre_4"  value="1" name="tareas_practica">
                        <label for="siempre_4">Siempre</label>
                        <input type="radio" id="a_veces_4" value="2" name="tareas_practica">
                        <label for="a_veces_4">A veces</label>
                        <input type="radio" id="no_observado_4" value="3" name="tareas_practica">
                        <label for="no_observado_4">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">Informa	de manera oportuna y formal	su ausencia	en el centro de	práctica</label><br>
                        <input type="radio" id="siempre_5"  value="1" name="informa_asistencia">
                        <label for="siempre_5">Siempre</label>
                        <input type="radio" id="a_veces_5" value="2" name="informa_asistencia">
                        <label for="a_veces_5">A veces</label>
                        <input type="radio" id="no_observado_5" value="3" name="informa_asistencia">
                        <label for="no_observado_5">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">Respalda con la	debida documentación su	ausencia en	el centro práctica</label><br>
                        <input type="radio" id="siempre_6"  value="1" name="respalda_documentacion">
                        <label for="siempre_6">Siempre</label>
                        <input type="radio" id="a_veces_6" value="2" name="respalda_documentacion">
                        <label for="a_veces_6">A veces</label>
                        <input type="radio" id="no_observado_6" value="3" name="respalda_documentacion">
                        <label for="no_observado_6">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">Mantiene buenas	relaciones con docentes	de aula, directivos	y asistentes de	la educación</label><br>
                        <input type="radio" id="siempre_7"  value="1" name="buena_relacion_docentes">
                        <label for="siempre_7">Siempre</label>
                        <input type="radio" id="a_veces_7" value="2" name="buena_relacion_docentes">
                        <label for="a_veces_7">A veces</label>
                        <input type="radio" id="no_observado_7" value="3" name="buena_relacion_docentes">
                        <label for="no_observado_7">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">Demuestra empatía y	se relaciona adecuadamente con las alumnas y los alumnos</label><br>
                        <input type="radio" id="siempre_8"  value="1" name="buena_relacion_alumnos">
                        <label for="siempre_8">Siempre</label>
                        <input type="radio" id="a_veces_8" value="2" name="buena_relacion_alumnos">
                        <label for="a_veces_8">A veces</label>
                        <input type="radio" id="no_observado_8" value="3" name="buena_relacion_alumnos">
                        <label for="no_observado_8">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">Manifiesta disposición hacia el	trabajo	colaborativo y en equipo</label><br>
                        <input type="radio" id="siempre_9"  value="1" name="trabajo_en_equipo">
                        <label for="siempre_9">Siempre</label>
                        <input type="radio" id="a_veces_9" value="2" name="trabajo_en_equipo">
                        <label for="a_veces_9">A veces</label>
                        <input type="radio" id="no_observado_9" value="3" name="trabajo_en_equipo">
                        <label for="no_observado_9">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">Realiza	responsablemente las tareas	encomendadas</label><br>
                        <input type="radio" id="siempre_10"  value="1" name="responsabilidad_tareas">
                        <label for="siempre_10">Siempre</label>
                        <input type="radio" id="a_veces_10" value="2" name="responsabilidad_tareas">
                        <label for="a_veces_10">A veces</label>
                        <input type="radio" id="no_observado_10" value="3" name="responsabilidad_tareas">
                        <label for="no_observado_10">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">Demuestra iniciativa y proactividad</label><br>
                        <input type="radio" id="siempre_11"  value="1" name="iniciativa">
                        <label for="siempre_11">Siempre</label>
                        <input type="radio" id="a_veces_11" value="2" name="iniciativa">
                        <label for="a_veces_11">A veces</label>
                        <input type="radio" id="no_observado_11" value="3" name="iniciativa">
                        <label for="no_observado_11">No observado</label>
                    </div>
                    <div id="" class="form-group col-md-12" >
                        <label class="required">Recepciona las valoraciones y las críticas en forma positiva</label><br>
                        <input type="radio" id="siempre_12"  value="1" name="recepcion_criticas">
                        <label for="siempre_12">Siempre</label>
                        <input type="radio" id="a_veces_12" value="2" name="recepcion_criticas">
                        <label for="a_veces_12">A veces</label>
                        <input type="radio" id="no_observado_12" value="3" name="recepcion_criticas">
                        <label for="no_observado_12">No observado</label>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="required">Observaciones</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="OBSERVACIONES"
                            name="OBSERVACIONES"
                            v-model="form.OBSERVACIONES"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="OBSERVACIONES"
                            :class="{'is-invalid': errors.has('OBSERVACIONES')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('OBSERVACIONES') }}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="required">Aspectos a mejorar</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="MEJORAR"
                            name="MEJORAR"
                            v-model="form.MEJORAR"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="MEJORAR"
                            :class="{'is-invalid': errors.has('MEJORAR')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('MEJORAR') }}</div>
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
            return this.$store.state.fichaSeguimiento;
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

        searchEstablecimiento() {
            var keyword = this.form.RBD;

            if (keyword != null && keyword.length > 3) {
                //traer informacion del CENTRO PRACTICA
                console.log(keyword);
                console.log('traer informacion del Centro de práctica');
                this.getEstablecimiento(keyword)
            }
        },
        getEstablecimiento(id){
            let url = Urls["CENTRO_PRACTICAS"].GET+id;
            axios
                .get(url, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {


                    if (response.data.data.length > 0) {

                        console.log(response);
                        this.form.CENTRO_PRACTICA = response.data.data[0].NOMBRE_ESTABLECIMIENTO;
                        this.form.DEPENDENCIA = response.data.data[0].DEPENDENCIA_ADMINISTRATIVA;
                        this.form.DIRECCION_CP = response.data.data[0].DIRECCION;
                        this.form.TELEFONO_CP = response.data.data[0].TELEFONO;
                        this.form.DIRECTOR_CP = response.data.data[0].NOMBRE_DIRECTOR;
                        this.form.EMAIL_DIRECTOR_CP = response.data.data[0].EMAIL_DIRECTOR;

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
