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
            :ref="'form_nuevo'"
            :width="'80%'"
            :height="'auto'"
            :title="this.tituloKendoWindowsFormNuevo"
            :visible="false"
            :modal="true"
            style="display:none;"
            :scrollable="false"
            :actions="actions"
        >
            <ficha-cupos></ficha-cupos>

        </kendo-window>
    </div>
</template>

<script>
import HelpButton from "../common/HelpButton";
import {KendoWindow} from "@progress/kendo-window-vue-wrapper";
import FichaCupos from "./form/fichaCupos";
import Grid from "./grid/Grid";
import Communes from "../common/json/Communes.json";
import eventHub from "../../eventHub";
import Loading from "../common/Loading";
import AlertMessage from "../common/json/AlertMessage.json";
import Urls from "../common/json/Urls.json";

export default {
    name: "CuposPractica",
    components:{
        FichaCupos,
        HelpButton,
        Loading,
        KendoWindow,
        Grid
    },
    computed:{
        windowFormNuevo() {
            return this.$refs["form_nuevo"];
        },
        form() {
            return this.$store.state.fichaCupos;
        },
    },
    created: function () {
        eventHub.$on("closeKendoWindows", () => {
            this.windowFormNuevo.kendoWidget().close();
        });
        eventHub.$on("LoadingOff", (data) => {
            this.loading = data.data;
        });
        eventHub.$on("onEditCuposPractica", (data) => {



            this.form.ID = data.obj.ID;
            this.form.ANIO= data.obj.ANIO;
            this.form.PERIODO= data.obj.PERIODO;
            this.form.CARRERA= data.obj.CARRERA;
            this.form.UA= data.obj.UA;
            this.form.MODALIDAD_PRACTICA= data.obj.MODALIDAD;
            this.form.ESTADO= data.obj.ESTADO;
            this.form.TIPO_PRACTICA= data.obj.TIPO_PRACTICA;
            this.form.NIVEL_ENSENANZA= data.obj.NIVEL_ENSENANZA;
            this.form.CURSO_INTERVENCION= JSON.parse(data.obj.CURSOS_INTERVENCION);
            this.form.NIVEL_PRACTICA= data.obj.NIVEL_PRACTICA;
            this.form.ID_CENTRO_PRACTICA= data.obj.CENTRO_PRACTICAS_ID;
            this.form.RBD_CENTRO_PRACTICA= data.obj.RBD_CENTRO_PRACTICA;
            this.form.RUN_PROF_COLABORADOR= data.obj.RUT_PROFESOR_COLABORADOR;
            this.form.PROF_COLABORADOR= data.obj.PROFESOR_COLABORADOR;

            this.form.EDITAR_FORMULARIO = true;

                console.log("se hizo click");
                this.tituloKendoWindowsFormNuevo="EDITAR CUPO";

                this.$nextTick(() => {
                    this.windowFormNuevo.kendoWidget().center().open();

                });


        });
        eventHub.$on("onDuplicateCuposPractica", (data) => {

            this.form.ID = null;
            this.form.ANIO= data.obj.ANIO;
            this.form.PERIODO= data.obj.PERIODO;
            this.form.CARRERA= data.obj.CARRERA;
            this.form.UA= data.obj.UA;
            this.form.MODALIDAD_PRACTICA= data.obj.MODALIDAD;
            this.form.ESTADO= data.obj.ESTADO;
            this.form.TIPO_PRACTICA= data.obj.TIPO_PRACTICA;
            this.form.NIVEL_ENSENANZA= data.obj.NIVEL_ENSENANZA;
            this.form.CURSO_INTERVENCION= JSON.parse(data.obj.CURSOS_INTERVENCION);
            this.form.NIVEL_PRACTICA= data.obj.NIVEL_PRACTICA;
            this.form.ID_CENTRO_PRACTICA= data.obj.CENTRO_PRACTICAS_ID;
            this.form.RBD_CENTRO_PRACTICA= data.obj.RBD_CENTRO_PRACTICA;
            this.form.RUN_PROF_COLABORADOR= data.obj.RUT_PROFESOR_COLABORADOR;
            this.form.PROF_COLABORADOR= data.obj.PROFESOR_COLABORADOR;

            this.form.EDITAR_FORMULARIO = false;


            this.tituloKendoWindowsFormNuevo="NUEVO CUPO BASADO EN UNO EXISTENTE";

            this.$nextTick(() => {
                this.windowFormNuevo.kendoWidget().center().open();

            });


        });
        eventHub.$on("onDeleteCuposPractica", (data) => {
            this.form.ID = data.obj.ID;

            kendo
                .confirm(AlertMessage.CONFIRMACION.ELIMINACION + this.form.ID + " ?")
                .then((result) => {
                    this.delete();
                });
        });

    },
    methods: {
        resetForm() {
            this.form.ID = null;
            this.form.ANIO= null;
            this.form.PERIODO= null;
            this.form.CARRERA= null;
            this.form.UA= null;
            this.form.MODALIDAD_PRACTICA= null;
            this.form.ESTADO= null;
            this.form.TIPO_PRACTICA= null;
            this.form.NIVEL_ENSENANZA= null;
            this.form.CURSO_INTERVENCION= null;
            this.form.NIVEL_PRACTICA= null;
            this.form.ID_CENTRO_PRACTICA= null;
            this.form.RBD_CENTRO_PRACTICA= null;
            this.form.RUN_PROF_COLABORADOR= null;
            this.form.PROF_COLABORADOR= null;

            this.form.EDITAR_FORMULARIO = false;
        },
        onDialogFormNew() {
            this.tituloKendoWindowsFormNuevo="Nuevo Cupo";
            this.resetForm();
            this.$nextTick(() => {
                this.windowFormNuevo.kendoWidget().center().open();
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
    },
    data: function () {
        return {
            actions: ["Maximize", "Close"],
            tituloKendoWindowsFormNuevo:"NUEVO CUPO",
            loading: true,
            propsToPass: {
                titulo: "Cupos Practica",
                ayuda: "lorem ",
                element: "CUPOS_PRACTICA",
            },
        }},
    beforeDestroy() {
        eventHub.$off("onEditCuposPractica");
        eventHub.$off("onDuplicateCuposPractica");
        eventHub.$off("onDeleteCuposPractica");
    },
}
</script>


