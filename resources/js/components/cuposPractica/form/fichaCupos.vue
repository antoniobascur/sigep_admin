<template>

    <div>
        <form ID="form" class="modal-form" @submit.prevent="validate">
            <div class="row">
                <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Centro de practica </h5>

                <div class="form-group col-md-6">
                    <label class="required">Centro de Practica (RBD)</label>

                    <kendo-dropdownlist
                        :ref="'RBD_CENTRO_PRACTICA'"
                        class="form-control"
                        name="RBD_CENTRO_PRACTICA"
                        @select="getEstablecimiento"
                        v-model="form.RBD_CENTRO_PRACTICA"
                        :data-source="dsCentroPractica"
                        :data-text-field="'RBD'"
                        :data-value-field="'RBD'"
                        :optionLabel="'Seleccione'"
                        :template="'<strong>#= RBD # </strong> ( <i>#=  NOMBRE_ESTABLECIMIENTO #</i> )'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsCentroPractica')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('RBD_CENTRO_PRACTICA') }}</div>
                </div>

                <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> General </h5>
                <div class="form-group col-md-6">
                    <label class="required">Año </label>


                    <kendo-dropdownlist
                        :ref="'ANIO'"
                        class="form-control"
                        name="ANIO"
                        v-model="form.ANIO"
                        :data-source="dsAnio"
                        :data-text-field="'name'"
                        :data-value-field="'name'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsAnio')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('ANIO') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Periodo </label>

                    <kendo-dropdownlist
                        :ref="'PERIODO'"
                        class="form-control"
                        name="PERIODO"
                        v-model="form.PERIODO"
                        :data-source="dsPeriodo"
                        :data-text-field="'name'"
                        :data-value-field="'name'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsPeriodo')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('PERIODO') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Carrera </label>

                    <kendo-dropdownlist
                        :ref="'CARRERA'"
                        class="form-control"
                        name="CARRERA"
                        v-model="form.UA"
                        :data-source="dsCarrera"
                        :data-text-field="'CARRERA'"
                        :data-value-field="'UA'"
                        :optionLabel="'Seleccione'"
                        @select="selectCarrera"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsCarrera')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('CARRERA') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Nivel Practica </label>

                    <kendo-dropdownlist
                        :ref="'NIVEL_PRACTICA'"
                        class="form-control"
                        name="NIVEL_PRACTICA"
                        v-model="form.NIVEL_PRACTICA"
                        :data-source="dsNivelPractica"
                        :data-text-field="'name'"
                        :data-value-field="'name'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsNivelPractica')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('NIVEL_PRACTICA') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Tipo de practica </label>

                    <kendo-dropdownlist
                        :ref="'TIPO_PRACTICA'"
                        class="form-control"
                        name="TIPO_PRACTICA"
                        v-model="form.TIPO_PRACTICA"
                        :data-source="dsTipoPractica"
                        :data-text-field="'name'"
                        :data-value-field="'name'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsTipoPractica')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('TIPO_PRACTICA') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Nivel de enseñanza </label>

                    <kendo-dropdownlist
                        :ref="'NIVEL_ENSENANZA'"
                        class="form-control"
                        name="NIVEL_ENSENANZA"
                        v-model="form.NIVEL_ENSENANZA"
                        :data-source="dsNivelEnsenanza"
                        :data-text-field="'name'"
                        :data-value-field="'name'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsNivelEnsenanza')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('NIVEL_ENSENANZA') }}</div>
                </div>
                <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Información del cupo </h5>

                <div class="form-group col-md-6">
                    <label class="required">Modalidad Practica</label>

                    <kendo-dropdownlist
                        :ref="'MODALIDAD_PRACTICA'"
                        class="form-control"
                        name="MODALIDAD_PRACTICA"
                        v-model="form.MODALIDAD_PRACTICA"
                        :data-source="dsModalidadPractica"
                        :data-text-field="'name'"
                        :data-value-field="'value'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsModalidadPractica')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('MODALIDAD_PRACTICA') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Cursos de intervención </label>

                    <kendo-multiselect
                        :ref="'CURSO_INTERVENCION'"
                        class="form-control"
                        name="CURSO_INTERVENCION"
                        v-model="form.CURSO_INTERVENCION"
                        :data-source="dsCursoIntervencion"
                        :data-text-field="'name'"
                        :data-value-field="'name'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsCursoIntervencion')}"
                    ></kendo-multiselect>

                    <div class="invalid-feedback">{{ errors.first('CURSO_INTERVENCION') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">RUN Prof. Colaborador </label>

                    <input
                        type="text"
                        class="form-control"
                        ID="RUN_PROF_COLABORADOR"
                        name="RUN_PROF_COLABORADOR"
                        v-model="form.RUN_PROF_COLABORADOR"
                        v-on:keyup="searchProfesorColaborador"
                        placeholder="Ej: 18291683"
                        v-validate="'required|max:100'"
                        data-vv-as="RUT"
                        :class="{'is-invalid': errors.has('RUN_PROF_COLABORADOR')}"
                    />

                    <div class="invalid-feedback">{{ errors.first('RUN_PROF_COLABORADOR') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Prof. Colaborador </label>

                    <input
                        type="text"
                        class="form-control"
                        ID="PROF_COLABORADOR"
                        name="PROF_COLABORADOR"
                        v-model="form.PROF_COLABORADOR"
                        placeholder="Ej: Antonio B.."
                        v-validate="'required|max:100'"
                        :disabled="buscandoProf"
                        data-vv-as="RUT"
                        :class="{'is-invalid': errors.has('PROF_COLABORADOR')}"
                    />

                    <div class="invalid-feedback">{{ errors.first('PROF_COLABORADOR') }}</div>
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
import Urls from "../../common/json/Urls.json";
import eventHub from "../../../eventHub";
import NivelesPractica from "../../common/json/NivelesPractica.json";
import NivelEnsenanza from "../../common/json/NivelEnsenanza.json";
import Modalidad from "../../common/json/Modalidad.json";
import CursosIntervencion from "../../common/json/CursosIntervencion.json";
import TipoPractica from "../../common/json/TipoPractica.json";
import Periodos from "../../common/json/Periodos.json";
import Anios from "../../common/json/Anios.json";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import AlertMessage from "../../common/json/AlertMessage.json";
import Regions from "../../common/json/Regions.json";


export default {
    components:{
        MultiSelect,
    },
    data: function () {
        return {
            submit: false,
            buscandoProf:false,
            dsCarrera: [],
            dsPeriodo: [],
            dsCentroPractica: [],
            dsNivelPractica: [],
            dsModalidadPractica:[],
            dsCursoIntervencion:[],
            dsNivelEnsenanza:[],
            dsTipoPractica:[],
            dsAnio:[],
            listaCentros: false,
            buscandoCentro: false,
            buscandoAsignatura: false,
            propsToPass: {
                titulo: "Cupos de practicas",
                ayuda: "lorem ",
                element: "CUPOS_PRACTICA",
            },

        }
    },
    computed: {
        form() {
            return this.$store.state.fichaCupos;
        },
    },
    created: function () {
        this.getPeriodos();
        this.getNivelPractica();
        this.getCarreras();
        this.getNivelEnsenanza();
        this.getModalidad();
        this.getCursosIntervencion();
        this.getTipoPractica();
        this.getAnio();
        this.getAllEstablecimientos();



    },
    methods: {
        getCarreras(){
           // eventHub.$emit("LoadingOff",{obj:true});
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
                    console.log(response.data.data);
                    if (response.data.data.length > 0) {
                        this.dsCarrera = response.data.data;
                    }
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    //eventHub.$emit("LoadingOff",{obj:false});
                });

        },
        getNivelPractica(){
            this.dsNivelPractica=NivelesPractica.NivelesPractica;
        },
        getPeriodos(){
            this.dsPeriodo=Periodos.Periodos;
        },
        getNivelEnsenanza(){
            this.dsNivelEnsenanza=NivelEnsenanza.NivelEnsenanza;
        },
        getModalidad(){
            this.dsModalidadPractica=Modalidad.Modalidad;

        },
        getCursosIntervencion(){
            this.dsCursoIntervencion=CursosIntervencion.CursosIntervencion;

        },
        getTipoPractica(){
            this.dsTipoPractica=TipoPractica.TipoPractica;

        },
        getAnio(){
            this.dsAnio=Anios.Anios;

        },
        getAllEstablecimientos(){
            //eventHub.$emit("LoadingOff",{obj:true});
            let url = Urls["CENTRO_PRACTICAS"].GET_ALL;
            axios
                .get(url, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    // console.log(response.data.data);

                    if (response.data.data.length > 0) {

                        console.log(response);
                        this.dsCentroPractica = response.data.data;

                    }
                    //eventHub.$emit("LoadingOff",{obj:false});
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    this.buscandoCentro=false;

                });
        },
        searchProfesorColaborador() {
            var keyword = this.form.RUN_PROF_COLABORADOR;
            console.log(keyword);
            if (keyword != null && keyword.length > 3) {
                //traer informacion del CENTRO PRACTICA
                console.log(keyword);
                console.log('traer informacion del profesor');
                this.getProfesorColaborador(keyword)
            }
        },
        getProfesorColaborador(run){
            this.buscandoProf=true;
            let formData = new FormData();
            formData.append("RUN", run);
            let url = Urls["PROFESOR_COLABORADOR"].GET_BY_RUN;
            axios
                .post(url, formData,{
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    // console.log(response.data.data);

                    if (response.data.data.length > 0) {
                        console.log(response);
                        this.form.PROF_COLABORADOR = response.data.data[0].NOMBRE;

                    }
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    this.buscandoProf=false;
                    //eventHub.$emit("LoadingOff",{obj:false});
                });
        },
        getEstablecimiento(id){

            this.buscandoCentro=true;
            let url = Urls["CENTRO_PRACTICAS"].GET_RBD+id.dataItem.RBD;
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

                        console.log(response);
                        this.form.CENTRO_PRACTICA = response.data.data[0].NOMBRE_ESTABLECIMIENTO;
                        this.form.ID_CENTRO_PRACTICA = response.data.data[0].ID;

                    }
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    this.buscandoCentro=false;
                    //eventHub.$emit("LoadingOff",{obj:false});
                });
        },
        selectCarrera(value){
            console.log(value);
            this.form.CARRERA=value.dataItem.CARRERA
            console.log(this.form.CARRERA);
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
        saveForm() {
            eventHub.$emit("LoadingOff",{obj:true});

            let url = Urls[this.propsToPass.element].SAVE;
            let formData = new FormData();

            formData.append("ID", this.form.ID);
            formData.append("ANIO", this.form.ANIO);
            formData.append("PERIODO", this.form.PERIODO);
            formData.append("CARRERA", this.form.CARRERA);
            formData.append("UA", this.form.UA);
            formData.append("MODALIDAD", this.form.MODALIDAD_PRACTICA);
            formData.append("ESTADO", this.form.ESTADO);
            formData.append("TIPO_PRACTICA", this.form.TIPO_PRACTICA);
            formData.append("NIVEL_ENSENANZA", this.form.NIVEL_ENSENANZA);
            formData.append("CURSOS_INTERVENCION", JSON.stringify(this.form.CURSO_INTERVENCION));
            formData.append("NIVEL_PRACTICA", this.form.NIVEL_PRACTICA);
            formData.append("CENTRO_PRACTICAS_ID", this.form.ID_CENTRO_PRACTICA);
            formData.append("RBD_CENTRO_PRACTICA", this.form.RBD_CENTRO_PRACTICA);
            formData.append("RUT_PROFESOR_COLABORADOR", this.form.RUN_PROF_COLABORADOR);
            formData.append("PROFESOR_COLABORADOR", this.form.PROF_COLABORADOR);


            axios
                .post(url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    this.submit = false;

                    if (response.status) {
                        this.form.ID = response.data.data.id;

                        console.log("axios");
                        console.log(this.form);
                        toastr.success(AlertMessage.FORMULARIO.SAVE_EXITO);
                        eventHub.$emit( "updateToGrid",
                            {obj: this.form}
                        );
                        eventHub.$emit("LoadingOff",{obj:false});
                        eventHub.$emit("closeKendoWindows");
                    }

                })
                .catch(function (error) {
                   // this.loading = false;
                    toastr.error(
                        AlertMessage.FORMULARIO.SAVE_ERROR
                    );
                    console.log("ERROR:", error);
                    onError();
                });
        }

    },

}
</script>




