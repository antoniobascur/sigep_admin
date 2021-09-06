<template>
    <div>
        <form ID="form" class="modal-form" @submit.prevent="validate">

            <div class="row">
                <div class="form-group col-md-3">
                    <label class="required">Fecha Visita</label>
                    <input
                        type="date"
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
                <label class="required">N° de Visita</label>
                <input
                    type="number"
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


                <h5 class="col-md-12 mt-2">Observaciones del establecimiento sobre el/la Educador(a) en formación </h5>
                <div class="col-md-12">

                    <editor :resizable-content="true"
                            :resizable-toolbar="true"
                            :value="htmlText"
                            style="height:80px"
                            rows="10"
                            cols="30"
                            :pdf="pdf"
                            v-model="form.OBSERVACIONES_VISITA"

                    >
                        <!--                    <editor-tool :name="'fontName'"></editor-tool>-->
                        <editor-tool :name="'fontSize'"></editor-tool>

                        <editor-tool :name="'bold'"></editor-tool>
                        <editor-tool :name="'italic'"></editor-tool>
                        <editor-tool :name="'underline'"></editor-tool>

                        <editor-tool :name="'insertUnorderedList'"></editor-tool>
                        <editor-tool :name="'insertOrderedList'"></editor-tool>
                        <editor-tool :name="'indent'"></editor-tool>
                        <editor-tool :name="'outdent'"></editor-tool>

                        <editor-tool :name="'justifyLeft'"></editor-tool>
                        <editor-tool :name="'justifyCenter'"></editor-tool>
                        <editor-tool :name="'justifyRight'"></editor-tool>
                        <editor-tool :name="'justifyFull'"></editor-tool>

                        <editor-tool :name="'viewHtml'"></editor-tool>
                        <editor-tool :name="'pdf'"></editor-tool>

                    </editor>
                    <br>
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

import {DateInput} from "@progress/kendo-vue-dateinputs";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import Urls from "../../../../common/json/Urls.json";
import AlertMessage from "../../../../common/json/AlertMessage.json";
import eventHub from "../../../../../eventHub";
import { Editor, EditorTool } from '@progress/kendo-editor-vue-wrapper';

export default {
    components: {
        Editor,
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
            return this.$store.state.fichaVisita;
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

                });
        },

    }
}
</script>

<style scoped>

</style>
