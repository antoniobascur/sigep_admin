<template>
    <div class="container-fluid">
        <loading v-if="loading"/>
        <div class="row">
            <div class="col">
                <div
                    class="card shadow-sm border-2 border-right-0 border-bottom-0 border-left-0 border-danger"
                >

                    <div class="card-body pt-2">
                        <!--TODO:Header-->
                        <div class="d-flex">
                            <div class="p-2">
                                 <h4>{{ propsToPass.titulo }}</h4>
                            </div>
                            <div class="ml-auto p-2">
                                <help-button v-bind:element="propsToPass.element"/>
                            </div>
                        </div>
                        <!--TODO:Header-->
                        <!--TODO:Contenido-->
                        <div class="d-flex flex-row-reverse bd-highlight">

                            <div class="p-2 bd-highlight">
                                <button class="btn btn-primary" @click="onDialogForm">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Nuevo
                                </button>
                            </div>
                        </div>
                        <Grid></Grid>
                        <!--TODO:Contenido-->
                    </div>
                </div>
            </div>
        </div>
        <!--        TODO:kendo-windows-Nuevo Estado solicitud-->
        <kendo-window
            :ref="'form'"
            :width="'50%'"
            :height="'auto'"
            :title="this.tituloKendoWindows"
            :visible="false"
            :modal="true"
            style="display:none;"
            :scrollable="true"
            :actions="actions"
        >
            <form ID="form" class="modal-form" @submit.prevent="validate">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required">Estado</label>
                        <input
                            class="form-control"
                            type="text"
                            data-vv-as="ESTADO"
                            ID="ESTADO"
                            name="ESTADO"
                            v-model="form.ESTADO"
                            v-on:keyup="searchEstado"
                            placeholder="Ej: Validado"
                            v-validate="'required|max:50'"
                            :class="{'is-invalid': errors.has('ESTADO')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('ESTADO') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Descripción</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="DESCRIPCION"
                            name="DESCRIPCION"
                            v-model="form.DESCRIPCION"
                            placeholder="Ej: Descrip ..."
                            v-validate="'required|max:100'"
                            data-vv-as="Descripcion"
                            :class="{'is-invalid': errors.has('DESCRIPCION')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('DESCRIPCION') }}</div>
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
        </kendo-window>
        <!--        TODO:kendo-windows-->
    </div>
</template>

<script>
import Loading from "../common/Loading";
import HelpButton from "../common/HelpButton";
import {KendoWindow} from "@progress/kendo-window-vue-wrapper";
import {DateInput} from "@progress/kendo-vue-dateinputs";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import Urls from "../common/json/Urls.json";
import AlertMessage from "../common/json/AlertMessage.json";
import eventHub from "../../eventHub";
import Grid from "./grid/Grid";

export default {
    components: {
        HelpButton,
        Loading,
        MultiSelect,
        DateInput,
        KendoWindow,
        Grid
    },
    data: function () {
        return {
            actions: ["Maximize", "Close"],
            loading: true,
            submit: false,
            propsToPass: {
                titulo: "Estado Solicitud",
                element: "ESTADO_SOLICITUD",
            },
            form: {
                ID: 0,
                ESTADO: null,
                DESCRIPCION: null,
                EDITAR_FORMULARIO: false,

            },
        }
    },
    computed: {
        windowForm() {
            return this.$refs["form"];
        },
        tituloKendoWindows() {
            return this.form.EDITAR_FORMULARIO
                ? "Editar Estado solicitud"
                : "Nuevo Estado solicitud";
        },
    },
    created: function () {
         //this.loading = false;

        eventHub.$on("LoadingOff", () => {
            this.loading = false;
        });

        eventHub.$on("onEditEstadoSolicitud", (data) => {
            console.log("dentro de on edit");
            console.log(data);
            this.form.ID = data.obj.ID;
            this.form.ESTADO = data.obj.ESTADO;
            this.form.DESCRIPCION = data.obj.DESCRIPCION;


            this.form.EDITAR_FORMULARIO = true;
            this.$nextTick(() => {

                this.windowForm.kendoWidget().center().open();
            });
        });
        eventHub.$on("onDeleteEstadoSolicitud", (data) => {
            this.form.ID = data.obj.ID;
            this.form.ESTADO = data.obj.ESTADO;
            kendo
                .confirm(AlertMessage.CONFIRMACION.ELIMINACION + this.form.ESTADO + " ?")
                .then((result) => {
                    this.delete();
                });
        });
    },
    methods: {

        onDialogForm() {

            this.$nextTick(() => {
                (!this.form.EDITAR_FORMULARIO)?this.resetForm():"";
                this.windowForm.kendoWidget().center().open();
            });
        },
        searchEstado() {
            var keyword = this.form.ESTADO;

            if (keyword != null && keyword.length > 0) {
                console.log(keyword);
            }
        },
        resetForm() {
            this.form.ID = 0;
            this.form.ESTADO = null;
            this.form.DESCRIPCION = null;
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
        saveForm() {

            let url = Urls[this.propsToPass.element].SAVE;
            let formData = new FormData();
            formData.append("ID", this.form.ID);
            formData.append("ESTADO", this.form.ESTADO);
            formData.append("DESCRIPCION", this.form.DESCRIPCION);


            axios
                .post(url, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    this.loading = true;
                    this.submit = false;


                    if (response.status) {
                        this.form.ID = response.data.data.id;
                        this.form.ESTADO = response.data.data.estado;
                        this.form.DESCRIPCION = response.data.data.descripcion;

                        this.windowForm.kendoWidget().close();
                        console.log("axios");
                        console.log(this.form);
                        toastr.success(AlertMessage.FORMULARIO.SAVE_EXITO);
                        eventHub.$emit(
                            !this.form.EDITAR_FORMULARIO
                                ? "onAddTogridElementEstadoSolicitud"
                                : "onEditEstadoSolicitudTogridElement",
                            {obj: this.form}
                        );
                    }

                })
                .catch(function (error) {
                    this.loading = false;
                    toastr.error(
                        AlertMessage.FORMULARIO.SAVE_ERROR
                    );
                    console.log("ERROR:", error);
                    onError();
                });
        },
        delete() {

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
                    this.loading = true;
                    this.submit = false;

                    if (response.status) {
                        this.windowForm.kendoWidget().close();
                        this.form.ID = response.data.data;

                        eventHub.$emit("onDeleteEstadoSolicitudToGridElement", {
                            obj: this.form,
                        });
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
    beforeDestroy() {
        eventHub.$off("onEditEstadoSolicitud");
        eventHub.$off("onDeleteEstadoSolicitud");

    }
}
</script>


