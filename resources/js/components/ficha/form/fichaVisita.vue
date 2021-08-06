<template>
    <div>
        <form ID="form" class="modal-form" @submit.prevent="validate">
            <h4>Información Visita Centro Práctica </h4>
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="required"> Carrera</label>

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

                <div class="form-group col-md-9">

                    <label class="required">Nombre Educador(a) en formación)</label>
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
                <label class="required">Nombre Jefe UTP</label>
                <input
                    type="text"
                    class="form-control"
                    ID="NOMBRE_UTP_CP"
                    name="NOMBRE_UTP_CP"
                    v-model="form.NOMBRE_UTP_CP"
                    placeholder=""
                    v-validate="'required|max:100'"
                    data-vv-as="NOMBRE_UTP_CP"
                    :class="{'is-invalid': errors.has('NOMBRE_UTP_CP')}"
                />
                <div class="invalid-feedback">{{ errors.first('NOMBRE_UTP_CP') }}</div>
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
                <label class="required">Propósito de la Visita</label>
                <input
                    type="text"
                    class="form-control"
                    ID="PROPOSITO_VISITA"
                    name="PROPOSITO_VISITA"
                    v-model="form.PROPOSITO_VISITA"
                    placeholder=""
                    v-validate="'required|max:100'"
                    data-vv-as="PROPOSITO_VISITA"
                    :class="{'is-invalid': errors.has('PROPOSITO_VISITA')}"
                />
                <div class="invalid-feedback">{{ errors.first('PROPOSITO_VISITA') }}</div>
            </div>
                <div class="form-group col-md-3">
                    <label class="required">Fecha Visita</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="FECHA_VISITA"
                        name="FECHA_VISITA"
                        v-model="form.FECHA_VISITA"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="FECHA_VISITA"
                        :class="{'is-invalid': errors.has('FECHA_VISITA')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('FECHA_VISITA') }}</div>
                </div>
                <div class="form-group col-md-3">
                <label class="required">N° de Visita</label>
                <input
                    type="text"
                    class="form-control"
                    ID="N_VISITA"
                    name="N_VISITA"
                    v-model="form.N_VISITA"
                    placeholder=""
                    v-validate="'required|max:100'"
                    data-vv-as="N_VISITA"
                    :class="{'is-invalid': errors.has('N_VISITA')}"
                />
                <div class="invalid-feedback">{{ errors.first('N_VISITA') }}</div>
            </div>
            <div class="form-group col-md-6">
                <label class="required">Observaciones del establecimiento sobre el/la Educador(a) en formación </label>
                <input
                    type="text"
                    class="form-control"
                    ID="OBSERVACIONES_VISITA"
                    name="OBSERVACIONES_VISITA"
                    v-model="form.OBSERVACIONES_VISITA"
                    placeholder=""
                    v-validate="'required|max:100'"
                    data-vv-as="OBSERVACIONES_VISITA"
                    :class="{'is-invalid': errors.has('OBSERVACIONES_VISITA')}"
                />
                <div class="invalid-feedback">{{ errors.first('OBSERVACIONES_VISITA') }}</div>
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
            return this.$store.state.ficha;
        },
    },

    created: function () {
        this.getCarreras();
    },
    methods: {

        resetForm() {
            this.form.ID = 0;
            this.form.CARRERA = null;
            this.form.NOMBRE = null;
            this.form.EDITAR_FORMULARIO = false;
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

<style scoped>

</style>
