<template>
<div>
    <form ID="form" class="modal-form" @submit.prevent="validate">

        <div class="row">
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
                    v-model="form.CARRERA"
                    :data-source="dsCarrera"
                    :data-text-field="'CARRERA'"
                    @select="getAsignaturasByUa"
                    :data-value-field="'UA'"
                    :optionLabel="'Seleccione'"
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
                <label class="required">Tipo Practica </label>

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
            <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Asignatura </h5>
            <div class="form-group col-md-4">
                <label class="required">Código Asignatura </label>

                <kendo-dropdownlist
                    :ref="'CODIGO_ASIGNATURA'"
                    class="form-control"
                    name="CODIGO_ASIGNATURA"
                    v-model="form.CODIGO_ASIGNATURA"
                    :data-source="dsAsignatura"
                    :data-text-field="'COD_ASIGNATURA'"
                    :data-value-field="'COD_ASIGNATURA'"
                    :optionLabel="'Seleccione'"
                    @select="getInfoAsignatura"
                    :filter="'contains'"
                    :class="{'is-invalid': errors.has('dsAsignatura')}"
                ></kendo-dropdownlist>
                <div class="invalid-feedback">{{ errors.first('CODIGO_ASIGNATURA') }}</div>
            </div>

            <div class="form-group col-md-4" v-if="form.CODIGO_ASIGNATURA!=null">
                <div class="d-flex flex-column">
                    <div class="p-2 mt-2"><label><i class="fa fa-caret-right" aria-hidden="true"></i>Nombre de la asignatura: {{form.NOMBRE_ASIGNATURA}}</label>
                    </div>
                    <div class="p-2"><label><i class="fa fa-caret-right" aria-hidden="true"></i>Nombre Profesor: {{form.PROFESOR_ASIGNATURA}}</label>
                    </div>
                </div>

            </div>
            <div class="form-group col-md-4" v-if="form.CODIGO_ASIGNATURA!=null">
                <div class="d-flex flex-column">
                    <div class="p-2 mt-2"><label><i class="fa fa-caret-right" aria-hidden="true"></i>Seccion: {{form.SECCION_ASIGNATURA}}</label>
                    </div>

                </div>

            </div>
            <div class="form-group col-md-4" v-else>
            <div class="d-flex flex-column" >
                <div class="mt-4"><label><i class="fa fa-info-circle" aria-hidden="true"></i> Debe ingresar un Código de asignatura valido</label>
                </div>
            </div>
            </div>
            <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i>Cupos Disponibles</h5>
<!--            <div class="form-group col-md-4">
                <label class="required">RBD</label>
                <input
                    type="text"
                    class="form-control"
                    ID="RBD"
                    name="RBD"
                    v-model="form.RBD"
                    placeholder=""
                    v-on:keyup="searchEstablecimiento"
                    v-validate="'required|max:100'"
                    data-vv-as="RBD"
                    :class="{'is-invalid': errors.has('RBD')}"
                />
                <div class="invalid-feedback">{{ errors.first('RBD') }}</div>
            </div>
            <div class="col-md-3">
                <div v-if="buscandoCentro">
                    <div class="d-flex flex-column">
                        <div class="mt-4"><label><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Buscando..</label>
                        </div>

                    </div>
                </div>

                <div v-else>
                    <div class="d-flex flex-column" v-if="form.CENTRO_PRACTICA!=null">
                        <div class="p-2"><label><i class="fa fa-caret-right" aria-hidden="true"></i>Nombre del Centro de Práctica: {{form.CENTRO_PRACTICA}}</label>
                        </div>
                        <div class="p-2"><label><i class="fa fa-caret-right" aria-hidden="true"></i>Cupos disponibles: {{form.CUPOS_PRACTICA}}</label>
                        </div>
                    </div>
                    <div class="d-flex flex-column" v-else>
                        <div class="mt-4"><label><i class="fa fa-info-circle" aria-hidden="true"></i> Debe ingresar un RBD de un centro de practica previamente ingresado</label>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-2">
                <div class="p-2 mt-2 bd-highlight">
                  <span class="btn btn-info float-left" @click="addCentro">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Asociar
                    </span>
                </div>
            </div>-->
            <label class="col-md-12 ml-2" v-if="!this.listaCupos"><i class="fa fa-info-circle" aria-hidden="true"></i><i>Debe completar el apartado general para conocer los cupos disponibles</i></label>

            <div class="col-md-12" v-if="this.listaCupos">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">RBD</th>
                        <th scope="col">Centro</th>
                        <th scope="col">Comuna</th>
                        <th scope="col">Modalidad</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for=" row in this.dsCuposPracticas" :key="row.ID">
                        <th scope="row">{{row.RBD_CENTRO_PRACTICA}}</th>
                        <td>{{row.NOMBRE_CENTRO_PRACTICA}}</td>
                        <td>{{row.COMUNA_CENTRO_PRACTICA}}</td>
                        <td>{{row.MODALIDAD}}</td>
                        <td><i class="fa fa-minus-square" aria-hidden="true" @click="deleteCentro(row.ID)"></i></td>
                    </tr>

                    </tbody>
                </table>
            </div>


        </div>
        <div class="row">
            <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Calendario</h5>
            <div class="col-md-12">
<!--                <scheduler></scheduler>
                <editor :resizable-content="true"
                        :resizable-toolbar="true"
                        :value="htmlText"
                        style="height:280px"
                        rows="10"
                        cols="30">
                </editor>-->
            </div>
            <div class="form-group col-md-4">
                <label class="required">Nro. Semanas Permanencia </label>

                <input
                    type="number"
                    class="form-control"
                    ID="N_SEMANAS_PERMANENCIA"
                    name="N_SEMANAS_PERMANENCIA"
                    v-model="form.N_SEMANAS_PERMANENCIA"
                    placeholder="Ej: 1"
                    v-validate="'required|max:100'"
                    data-vv-as="RUT"
                    :class="{'is-invalid': errors.has('N_SEMANAS_PERMANENCIA')}"
                />

                <div class="invalid-feedback">{{ errors.first('N_SEMANAS_PERMANENCIA') }}</div>
            </div>
            <div class="form-group col-md-4">
                <label class="required">Nro. Horas Aula </label>

                <input
                    type="number"
                    class="form-control"
                    ID="N_HORAS_AULA"
                    name="N_HORAS_AULA"
                    v-model="form.N_HORAS_AULA"
                    placeholder="Ej: 2"
                    v-validate="'required|max:100'"
                    data-vv-as="RUT"
                    :class="{'is-invalid': errors.has('N_HORAS_AULA')}"
                />

                <div class="invalid-feedback">{{ errors.first('N_HORAS_AULA') }}</div>
            </div>
            <div class="form-group col-md-4">
                <label class="required">Nro. Horas Administrativas </label>

                <input
                    type="number"
                    class="form-control"
                    ID="N_HORAS_ADMINISTRATIVAS"
                    name="N_HORAS_ADMINISTRATIVAS"
                    v-model="form.N_HORAS_ADMINISTRATIVAS"
                    placeholder="Ej: 2"
                    v-validate="'required|max:100'"
                    :disabled="buscandoProf"
                    data-vv-as="RUT"
                    :class="{'is-invalid': errors.has('N_HORAS_ADMINISTRATIVAS')}"
                />

                <div class="invalid-feedback">{{ errors.first('PROF_COLABORADOR') }}</div>
            </div>
            <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Descripción</h5>
            <div class="col-md-12">
                <label class="required">Características </label>
                <editor :resizable-content="true"
                        :resizable-toolbar="true"
                        :value="htmlText"
                        style="height:200px"
                        rows="10"
                        cols="30"
                        :pdf="pdf"
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
            </div>
            <br>
            <div class="col-md-12">
                <label class="required">Tareas </label>
                <editor :resizable-content="true"
                        :resizable-toolbar="true"
                        :value="htmlText"
                        style="height:200px"
                        rows="10"
                        cols="30"
                        :pdf="pdf"
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
            </div>
        </div>
        <br>
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
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import {DateInput} from "@progress/kendo-vue-dateinputs";
import scheduler from "../../common/scheduler";
import Urls from "../../common/json/Urls.json";
import eventHub from "../../../eventHub";
import Periodos from "../../common/json/Periodos.json";
import NivelesPractica from "../../common/json/NivelesPractica.json";
import AlertMessage from "../../common/json/AlertMessage.json";
import TipoPractica from "../../common/json/TipoPractica.json";
import Anios from "../../common/json/Anios.json";
import { Editor, EditorTool } from '@progress/kendo-editor-vue-wrapper';

export default {
    components: {
        Editor,
    EditorTool,
        Loading,
        MultiSelect,
        DateInput,
        scheduler,
    },
    data: function () {
        return{
            submit:false,
            dsCarrera:[],
            dsPeriodo:[],
            dsAsignatura:[],
            dsNivelPractica:[],
            dsCuposPracticas:[],
            dsTipoPractica:[],
            dsAnio:[],
            listaCupos:false,
            buscandoCentro:false,
            buscandoAsignatura:false,
            pdf: {
                fileName: "Export.pdf",
                proxyURL: "https://demos.telerik.com/kendo-ui/service/export",
                paperSize: "a4",
                margin: {
                    bottom: 20,
                    left: 20,
                    right: 20,
                    top: 20
                }
            },
            htmlText:'<p>Escribir aquí...</p>',
            form:{
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
                CUPOS:[]
            }

        }

    },
    created: function () {
        this.getPeriodos();
        this.getNivelPractica();
        this.getCarreras();
        this.getTipoPractica();
        this.getAnio();
        //this.getCuposByProgramacion();
    },
    methods: {
        getTipoPractica(){
            this.dsTipoPractica=TipoPractica.TipoPractica;

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
                    eventHub.$emit("LoadingOff");
                });

        },
        addCentro(){

            if(this.form.CUPOS.find(el => el.RBD === this.form.RBD)==null && this.form.RBD!=null ){
                this.form.CUPOS.push({
                    RBD: this.form.RBD,
                    CENTRO_PRACTICA: this.form.CENTRO_PRACTICA,
                    COMUNA_PRACTICA: this.form.COMUNA_PRACTICA,
                    CUPOS_PRACTICA: this.form.CUPOS_PRACTICA,
                });
                    this.form.RBD=null;
                    this.form.CENTRO_PRACTICA=null;
                    this.form.COMUNA_PRACTICA=null;
                    this.form.CUPOS_PRACTICA=null;
                this.listaCentros=true;
            }else{
                console.log("ya se agrego ese RBD");

                if(this.form.RBD==null){
                    toastr.error(
                        "Debe ingresar un RBD"
                    );
                }else{
                    toastr.error(
                        "ya se agrego ese RBD"
                    );
                }

            }

        },
        deleteCentro(rbd){
            let index =  this.form.CUPOS.find(el => el.RBD === rbd);
            console.log(index);
            this.form.CUPOS.splice(index, 1);
        },
        isExistCentro(find_key){
            return this.form.CUPOS.some(x => x[find_key]);
        },
        getPeriodos(){
            this.dsPeriodo=Periodos.Periodos;
        },
        getNivelPractica(){
            this.dsNivelPractica=NivelesPractica.NivelesPractica;
        },
        getAnio(){
            this.dsAnio=Anios.Anios;

        },
        searchEstablecimiento() {
            var keyword = this.form.RBD;
            console.log(keyword);
            if (keyword != null && keyword.length > 3) {
                //traer informacion del CENTRO PRACTICA
                console.log(keyword);
                console.log('traer informacion del Centro de práctica');
                this.getEstablecimiento(keyword)
            }
        },

        getEstablecimiento(id){
            this.buscandoCentro=true;
            let url = Urls["CENTRO_PRACTICAS"].GET_RBD+id;
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
                        this.form.CENTRO_PRACTICA = response.data.data[0].NOMBRE_ESTABLECIMIENTO;
                        this.form.CUPOS_PRACTICA = response.data.data[0].CUPOS_PRACTICA;
                        this.form.COMUNA_PRACTICA = response.data.data[0].COMUNA_PRACTICA;
                    }
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    this.buscandoCentro=false;
                    eventHub.$emit("LoadingOff");
                });
        },
        searchAsignatura() {
            var keyword = this.form.CODIGO_ASIGNATURA;
            console.log(keyword);
            if (keyword != null && keyword.length > 3) {
                //traer informacion del CENTRO PRACTICA
                console.log(keyword);
                console.log('traer informacion de la Asignatura');
                this.getAsignatura(keyword)
            }
        },
        getAsignatura(id){
            this.buscandoAsignatura=true;
            let url = Urls["ASIGNATURA"].GET_CODE+id;
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
                        this.form.CODIGO_ASIGNATURA = response.data.data[0].COD_ASIGNATURA;
                        this.form.NOMBRE_ASIGNATURA = response.data.data[0].NOMBRE_ASIGNATURA;
                        this.form.SECCION_ASIGNATURA = response.data.data[0].SECCION_ASIGNATURA;
                    }
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    this.buscandoAsignatura=false;
                    eventHub.$emit("LoadingOff");
                });
        },
        getAsignaturasByUa(value){
            console.log(value.dataItem.UA);
            this.buscandoAsignatura=true;
            let url = Urls["ASIGNATURA"].GET_ALL_UA+value.dataItem.UA;
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


                            this.dsAsignatura = response.data.data;

                    }
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    this.buscandoAsignatura=false;
                    eventHub.$emit("LoadingOff");
                });
        },
        getInfoAsignatura(value){
            console.log(value);
            this.form.NOMBRE_ASIGNATURA=value.dataItem.NOMBRE_ASIGNATURA;
            this.form.SECCION_ASIGNATURA=value.dataItem.SECCION_ASIGNATURA;
            this.form.PROFESOR_ASIGNATURA=value.dataItem.NOMBRE;
            this.form.RUT_PROFESOR_ASIGNATURA=value.dataItem.RUT_PROFESOR_TUTOR;
        },
        getCuposByProgramacion(){
            console.log("buscadnocupos");
            let url = Urls["CUPOS_PRACTICA"].GET_CUPOS_PROGRAMACION;
            let formData = new FormData();
            formData.append("ANIO", this.form.ANIO);
            formData.append("PERIODO", this.form.PERIODO);
            formData.append("UA", this.form.CARRERA);
            formData.append("CARRERA", this.form.CARRERA);
            formData.append("TIPO_PRACTICA", this.form.TIPO_PRACTICA);
            formData.append("NIVEL_PRACTICA", this.form.NIVEL_PRACTICA);
            axios
                .post(url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    if (response.data.data.length > 0) {


                        this.dsCuposPracticas = response.data.data;
                        this.listaCupos=true;
                    }
                })
                .catch(function (error) {
                    //this.loading = false;
                    toastr.error(
                        AlertMessage.FORMULARIO.SAVE_ERROR
                    );
                    console.log("ERROR:", error);
                    onError();
                });

        }
    },
    watch:{
       'form.PERIODO': function () {
       //console.log(this.form.PERIODO);
        if(this.form.PERIODO!=null&&this.form.ANIO!=null&&this.form.CARRERA!=null&&this.form.NIVEL_PRACTICA!=null&&this.form.TIPO_PRACTICA!=null){

            this.getCuposByProgramacion();
        }
       },
        'form.ANIO': function () {
            // console.log(this.form.ANIO);
            if(this.form.PERIODO!=null&&this.form.ANIO!=null&&this.form.CARRERA!=null&&this.form.NIVEL_PRACTICA!=null&&this.form.TIPO_PRACTICA!=null){

                this.getCuposByProgramacion();
            }
        },
        'form.UA': function () {
            //console.log(this.form.UA);
            if(this.form.PERIODO!=null&&this.form.ANIO!=null&&this.form.CARRERA!=null&&this.form.NIVEL_PRACTICA!=null&&this.form.TIPO_PRACTICA!=null){

                this.getCuposByProgramacion();
            }
        },
        'form.NIVEL_PRACTICA': function () {
            //console.log(this.form.NIVEL_PRACTICA);
            if(this.form.PERIODO!=null&&this.form.ANIO!=null&&this.form.CARRERA!=null&&this.form.NIVEL_PRACTICA!=null&&this.form.TIPO_PRACTICA!=null){

                this.getCuposByProgramacion();
            }
        },
        'form.TIPO_PRACTICA': function () {
            // console.log(this.form.TIPO_PRACTICA);
            console.log(this.form.PERIODO);
            console.log(this.form.TIPO_PRACTICA);
            console.log(this.form.NIVEL_PRACTICA);
            console.log(this.form.UA);
            console.log(this.form.PERIODO);
            if(this.form.PERIODO!=null&&this.form.ANIO!=null&&this.form.CARRERA!=null&&this.form.NIVEL_PRACTICA!=null&&this.form.TIPO_PRACTICA!=null){

                this.getCuposByProgramacion();
            }
        }
    }
}
</script>


