<template>
    <div class="container-fluid">
        <loading v-if="loading"/>
        <div class="row">
            <div class="col">
                <div
                    class="card shadow-sm border-2 border-right-0 border-bottom-0 border-left-0 border-danger"
                >
                    <div class="card-body pt-2">
                        <div class="d-flex">
                            <div class="p-2">
                                <h4>{{ propsToPass.titulo }}</h4>
                            </div>
                            <div class="ml-auto p-2">
                                <help-button v-bind:element="propsToPass.element"/>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse bd-highlight">

                            <div class="p-2 bd-highlight">
                                <button class="btn btn-primary" @click="onDialogFormNew">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Nuevo
                                </button>

                            </div>
                        </div>
                        <!-- CUERPO-->
                        <Grid></Grid>
                        <!-- CUERPO-->
                    </div>
                </div>
            </div>
        </div>

        <kendo-window
            :ref="'form_programacion'"
            :width="'80%'"
            :height="'auto'"
            :title="this.tituloKendoWindowsFormNuevo"
            :visible="false"
            :modal="true"
            style="display:none;"
            :scrollable="false"
            :actions="actions"
        >
            <ficha-programacion></ficha-programacion>
        </kendo-window>

        <kendo-window
            :ref="'view_cupos'"
            :width="'80%'"
            :height="'auto'"
            :title="'Lista de cupos'"
            :visible="false"
            :modal="true"
            style="display:none;"
            :scrollable="false"
            :actions="actions"
        >
            <div class="col-md-12" >
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">RBD CENTRO</th>
                        <th scope="col">NOMBRE CENTRO</th>
                        <th scope="col">COMUNA</th>
                        <th scope="col">MODALIDAD</th>
                        <th scope="col">CURSOS INTERVENCIÓN</th>
                        <th scope="col">ESTADO</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for=" row in this.form.CUPOS" :key="row.ID">
                        <td>{{row.RBD}}</td>
                        <td>{{row.NOMBRE_CENTRO_PRACTICA}}</td>
                        <td>{{row.COMUNA_CENTRO_PRACTICA}}</td>
                        <td>{{row.MODALIDAD}}</td>
                        <td>{{row.CURSOS_INTERVENCION.replace('[',' ').replace(']','')}}</td>
                        <td>{{row.ESTADO}}</td>

                    </tr>

                    </tbody>
                </table>
            </div>
        </kendo-window>
    </div>
</template>

<script>

import {KendoWindow} from "@progress/kendo-window-vue-wrapper";
import HelpButton from "../common/HelpButton";
import FichaProgramacion from "./form/fichaProgramacion";
import eventHub from "../../eventHub";
import AlertMessage from "../common/json/AlertMessage.json";
import Grid from "./grid/Grid";
import Loading from "../common/Loading";
import Urls from "../common/json/Urls.json";
export default {
    components: {
        FichaProgramacion,
        HelpButton,
        KendoWindow,
        Loading,
        Grid
    },
    computed: {
        windowFormNuevo() {
            return this.$refs["form_programacion"];
        },
        windowCupos(){
            return this.$refs["view_cupos"];

        },
        form() {
            return this.$store.state.fichaProgramacion;
        },

    },
    created: function () {
        eventHub.$on("closeKendoWindows", () => {
            this.windowFormNuevo.kendoWidget().close();
        });
        eventHub.$on("LoadingOff", (data) => {

            this.loading = data.obj;
        });
        eventHub.$on("onEditProgramacionPractica", (data) => {

            this.form.ID = data.obj.ID;
            this.form.ANIO= data.obj.ANIO;
            this.form.PERIODO= data.obj.PERIODO;
            this.form.CARRERA = data.obj.CARRERA;
            this.form.UA= data.obj.UA;
            this.form.NIVEL_PRACTICA= data.obj.NIVEL_PRACTICA;
            this.form.TIPO_PRACTICA= data.obj.TIPO_PRACTICA;
            this.form.NIVEL_ENSENANZA= data.obj.NIVEL_ENSENANZA;
            this.form.N_SEMANAS_PERMANENCIA= data.obj.N_SEMANAS_PERMANENCIA;
            this.form.N_HORAS_AULA = data.obj.N_HORAS_AULA;
            this.form.N_HORAS_ADMINISTRATIVAS= data.obj.N_HORAS_ADMINISTRATIVAS;
            this.form.TAREAS= data.obj.TAREAS;
            this.form.CARACTERISTICAS= data.obj.CARACTERISTICAS;
            this.form.CODIGO_ASIGNATURA= data.obj.COD_ASIGNATURA;
            this.form.NOMBRE_ASIGNATURA= data.obj.NOMBRE_ASIGNATURA;
            this.form.SECCION_ASIGNATURA= data.obj.SECCION_ASIGNATURA;
            this.form.PROFESOR_ASIGNATURA= data.obj.PROFESOR_ASIGNATURA;
            this.form.RUT_PROFESOR_ASIGNATURA= data.obj.RUT_PROFESOR_ASIGNATURA;
            this.form.RBD= data.obj.RBD;
            this.form.CENTRO_PRACTICA= data.obj.CENTRO_PRACTICA;
            this.form.COMUNA_PRACTICA= data.obj.COMUNA_PRACTICA;
            this.form.CUPOS_PRACTICA= data.obj.CUPOS_PRACTICA;
            this.form.ESTADO= data.obj.ESTADO;

            this.getDataCupos(data.obj.ID);
            this.form.EDITAR_FORMULARIO = true;

            console.log("se hizo click");
            this.tituloKendoWindowsFormNuevo="EDITAR CUPO";

            this.$nextTick(() => {
                this.windowFormNuevo.kendoWidget().center().open();

            });


        });
        eventHub.$on("onDuplicateProgramacionPractica", (data) => {
            console.log("onDuplicateProgramacionPractica");
            console.log(data);
            this.form.ID = 0;
            this.form.ANIO= data.obj.ANIO;
            this.form.PERIODO= data.obj.PERIODO;
            this.form.CARRERA = data.obj.CARRERA;
            this.form.UA= data.obj.UA;
            this.form.NIVEL_PRACTICA= data.obj.NIVEL_PRACTICA;
            this.form.TIPO_PRACTICA= data.obj.TIPO_PRACTICA;
            this.form.NIVEL_ENSENANZA= data.obj.NIVEL_ENSENANZA;
            this.form.N_SEMANAS_PERMANENCIA= data.obj.N_SEMANAS_PERMANENCIA;
            this.form.N_HORAS_AULA = data.obj.N_HORAS_AULA;
            this.form.N_HORAS_ADMINISTRATIVAS= data.obj.N_HORAS_ADMINISTRATIVAS;
            this.form.TAREAS= data.obj.TAREAS;
            this.form.CARACTERISTICAS= data.obj.CARACTERISTICAS;
            this.form.CODIGO_ASIGNATURA= data.obj.COD_ASIGNATURA;
            this.form.NOMBRE_ASIGNATURA= data.obj.NOMBRE_ASIGNATURA;
            this.form.SECCION_ASIGNATURA= data.obj.SECCION_ASIGNATURA;
            this.form.PROFESOR_ASIGNATURA= data.obj.PROFESOR_ASIGNATURA;
            this.form.RUT_PROFESOR_ASIGNATURA= data.obj.RUT_PROFESOR_ASIGNATURA;
            this.form.RBD= data.obj.RBD;
            this.form.CENTRO_PRACTICA= data.obj.CENTRO_PRACTICA;
            this.form.COMUNA_PRACTICA= data.obj.COMUNA_PRACTICA;
            this.form.CUPOS_PRACTICA= data.obj.CUPOS_PRACTICA;
            this.form.ESTADO= data.obj.ESTADO;

            this.getDataCupos(data.obj.ID);
            this.form.EDITAR_FORMULARIO = true;


            this.tituloKendoWindowsFormNuevo="NUEVA PROGRAMACIÓN BASADA EN UNA EXISTENTE";

            this.$nextTick(() => {
                this.windowFormNuevo.kendoWidget().center().open();

            });


        });
        eventHub.$on("onDeleteProgramacionPractica", (data) => {
            this.form.ID = data.obj.ID;

            kendo
                .confirm(AlertMessage.CONFIRMACION.ELIMINACION + this.form.ID + " ?")
                .then((result) => {
                    this.delete();
                });
        });
        eventHub.$on("onViewCupos", (data) => {
           // this.form.ID = data.obj.ID;

            this.onDialogCupos(data.obj.ID);

        });
        eventHub.$on("onChangeEstado", (data) => {

                    this.changeEstado(data.obj.ID,data.obj.ESTADO);

        });

    },
    methods: {
        resetForm() {
            this.form.ID= 0;
            this.form.ANIO= null;
            this.form.PERIODO= null;
            this.form.CARRERA= null;
            this.form.UA= null;
            this.form.NIVEL_PRACTICA= null;
            this.form.TIPO_PRACTICA= null;
            this.form.NIVEL_ENSENANZA= null;
            this.form.N_SEMANAS_PERMANENCIA= null;
            this.form.N_HORAS_AULA= null;
            this.form.N_HORAS_ADMINISTRATIVAS= null;
            this.form.TAREAS= null;
            this.form.CARACTERISTICAS= null;
            this.form.CODIGO_ASIGNATURA= null;
            this.form.NOMBRE_ASIGNATURA= null;
            this.form.SECCION_ASIGNATURA=null;
            this.form.PROFESOR_ASIGNATURA=null;
            this.form.RUT_PROFESOR_ASIGNATURA=null;
            this.form.RBD= null;
            this.form.CENTRO_PRACTICA= null;
            this.form.COMUNA_PRACTICA= null;
            this.form.CUPOS_PRACTICA= null;
            this.form.ESTADO="ACTIVO";
            this.form.CUPOS=[];
        },
        onDialogFormNew() {
            this.$nextTick(() => {
                this.windowFormNuevo.kendoWidget().center().open();
            });
        },
        onDialogCupos(id) {
            console.log("onDialogCupos: "+id);
            this.getDataCupos(id);
            this.$nextTick(() => {
                this.windowCupos.kendoWidget().center().open();
            });
        },
        delete() {
            this.loading = true;
            let url = Urls[this.propsToPass.element].DELETE + this.form.ID;


            axios
                .get(url, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {

                    this.submit = false;

                    if (response.status) {

                        this.form.ID = response.data.data;

                        eventHub.$emit( "updateToGrid",
                            {obj: this.form}
                        );
                        toastr.success(AlertMessage.GRID.ELIMINACION_EXITO);
                    }
                })
                .catch(function (error) {
                    this.loading = false;
                    console.log("ERROR:", error);
                    toastr.error(AlertMessage.GRID.ELIMINACION_ERROR);
                    onError();
                });
        },
        changeEstado(ID,ESTADO){


            console.log("buscadnocupos");
            let url = Urls[this.propsToPass.element].CHANGE_STATE_PROGRAMACION;
            let formData = new FormData();
            formData.append("ID", ID);
            formData.append("ESTADO", (ESTADO=="INACTIVO")?"ACTIVO":"INACTIVO");
            axios
                .post(url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    if (response.status) {

                        this.form.ID = response.data.data;

                        eventHub.$emit( "updateToGrid",
                            {obj: this.form}
                        );

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
        },
        getDataCupos(id) {
            eventHub.$emit("LoadingOff",{obj:true});

            let url = Urls[this.propsToPass.element].GET_ALL_CUPOS_PROGRAMACION+id;
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
                        this.$store.state.fichaProgramacion.CUPOS = response.data.data;
                    }

                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    eventHub.$emit("LoadingOff",{obj:false});

                });
        }
    },
    data: function () {
        return {
            actions: ["Maximize", "Close"],
            tituloKendoWindowsFormNuevo:"NUEVA PROGRAMACIÓN ",
            loading: false,
            propsToPass: {
                titulo: "Programación Practica",
                ayuda: "lorem ",
                element: "PROGRAMACION_PRACTICA",
            },
        }},
    beforeDestroy() {
        eventHub.$off("onEditProgramacionPractica");
        eventHub.$off("onDuplicateProgramacionPractica");
        eventHub.$off("onDeleteProgramacionPractica");
    },

}
</script>

