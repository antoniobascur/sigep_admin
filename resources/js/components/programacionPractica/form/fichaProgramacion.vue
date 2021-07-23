<template>
<div>
    <form ID="form" class="modal-form" @submit.prevent="validate">

        <div class="row">
            <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> General </h5>
            <div class="form-group col-md-6">
                <label class="required">Año </label>

                <input
                    type="text"
                    class="form-control"
                    ID="ANIO"
                    name="ANIO"
                    v-model="form.ANIO"
                    placeholder="Ej: Liceo k123"
                    v-validate="'required|max:100'"
                    data-vv-as="RUT"
                    :class="{'is-invalid': errors.has('ANIO')}"
                />

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
            <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Asignatura </h5>
            <div class="form-group col-md-6">
                <label class="required">Código Asignatura </label>

                <input
                    type="text"
                    class="form-control"
                    ID="CODIGO_ASIGNATURA"
                    name="CODIGO_ASIGNATURA"
                    v-model="form.CODIGO_ASIGNATURA"
                    placeholder=""
                    v-on:keyup="searchEstablecimiento"
                    v-validate="'required|max:100'"
                    data-vv-as="RBD"
                    :class="{'is-invalid': errors.has('CODIGO_ASIGNATURA')}"
                />

                <div class="invalid-feedback">{{ errors.first('CODIGO_ASIGNATURA') }}</div>
            </div>
            <div class="form-group col-md-6">
                <label class="required">Nombre Asignatura </label>
                <input
                    type="text"
                    class="form-control"
                    ID="NOMBRE_ASIGNATURA"
                    name="NOMBRE_ASIGNATURA"
                    v-model="form.NOMBRE_ASIGNATURA"
                    placeholder="Ej: Liceo k123"
                    v-validate="'required|max:100'"
                    data-vv-as="RUT"
                    :class="{'is-invalid': errors.has('NOMBRE_ASIGNATURA')}"
                />
                <div class="invalid-feedback">{{ errors.first('NOMBRE_ASIGNATURA') }}</div>
            </div>
            <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Centro de practica</h5>
            <div class="form-group col-md-4">
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
                <div class="d-flex flex-column">
                    <div class="p-2"><label><i class="fa fa-caret-right" aria-hidden="true"></i>Nombre del Centro de Práctica: {{form.CENTRO_PRACTICA}}</label>
                    </div>
                    <div class="p-2"><label><i class="fa fa-caret-right" aria-hidden="true"></i>Cupos disponibles: {{form.CUPOS_PRACTICA}}</label>
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
            </div>
            <div class="col-md-12" v-if="this.listaCentros">
                <h6 class="col-md-12"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Lista de centros asociados</h6>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">RBD</th>
                        <th scope="col">Centro</th>
                        <th scope="col">Comuna</th>
                        <th scope="col">Cupo</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for=" row in this.form.CENTROS" :key="row.RBD">
                        <th scope="row">{{row.RBD}}</th>
                        <td>{{row.CENTRO_PRACTICA}}</td>
                        <td>{{row.COMUNA_PRACTICA}}</td>
                        <td>{{row.CUPOS_PRACTICA}}</td>
                        <td><i class="fa fa-minus-square" aria-hidden="true" @click="deleteCentro(row.RBD)"></i></td>
                    </tr>

                    </tbody>
                </table>
            </div>


        </div>
        <div class="row">
            <h5 class="col-md-12"><i class="fa fa-angle-right" aria-hidden="true"></i> Calendario</h5>
            <div class="col-md-12">
                <scheduler></scheduler>
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
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import {DateInput} from "@progress/kendo-vue-dateinputs";
import scheduler from "../../common/scheduler";
import Urls from "../../common/json/Urls.json";
import eventHub from "../../../eventHub";
import Periodos from "../../common/json/Periodos.json";
import NivelesPractica from "../../common/json/NivelesPractica.json";
import AlertMessage from "../../common/json/AlertMessage.json";
export default {
    components: {
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
            dsNivelPractica:[],
            listaCentros:false,
            form:{
                ID: 0,
                ANIO: null,
                PERIODO: null,
                CARRERA: null,
                NIVEL_PRACTICA: null,
                CODIGO_ASIGNATURA: null,
                NOMBRE_ASIGNATURA: null,
                RBD: null,
                CENTRO_PRACTICA: null,
                COMUNA_PRACTICA: null,
                CUPOS_PRACTICA: null,
                CENTROS:[]
            }

        }

    },
    created: function () {
        this.getPeriodos();
        this.getNivelPractica();
    },
    methods: {
        addCentro(){

            if(this.form.CENTROS.find(el => el.RBD === this.form.RBD)==null && this.form.RBD!=null ){
                this.form.CENTROS.push({
                    RBD: this.form.RBD,
                    CENTRO_PRACTICA: this.form.CENTRO_PRACTICA,
                    COMUNA_PRACTICA: this.form.COMUNA_PRACTICA,
                    CUPOS_PRACTICA: this.form.CUPOS_PRACTICA,
                });
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
            let index =  this.form.CENTROS.find(el => el.RBD === rbd);
            console.log(index);
            this.form.CENTROS.splice(index, 1);
        },
        isExistCentro(find_key){
            return this.form.CENTROS.some(x => x[find_key]);
        },
        getPeriodos(){
            this.dsPeriodo=Periodos.Periodos;
        },
        getNivelPractica(){
            this.dsNivelPractica=NivelesPractica.NivelesPractica;
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
                    eventHub.$emit("LoadingOff");
                });
        },
    }
}
</script>


