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
                        <label class="required">RUN</label>
                        <input
                            class="form-control"
                            type="text"
                            data-vv-as="RUN"
                            ID="RUN"
                            name="RUN"
                            v-model="form.RUN"
                            v-on:keyup="searchRUN"
                            placeholder="Ej: 17589236 (sin digito verificador)"
                            v-validate="'required|max:50'"
                            :class="{'is-invalid': errors.has('RUN')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('RUN') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Nombre</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="NOMBRE"
                            name="NOMBRE"
                            v-model="form.NOMBRE"
                            placeholder="Nombre"
                            v-validate="'required|max:100'"
                            data-vv-as="NOMBRE"
                            :class="{'is-invalid': errors.has('NOMBRE')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('NOMBRE') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Apellido</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="APELLIDO"
                            name="APELLIDO"
                            v-model="form.APELLIDO"
                            placeholder="Apellido"
                            v-validate="'required|max:100'"
                            data-vv-as="APELLIDO"
                            :class="{'is-invalid': errors.has('APELLIDO')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('APELLIDO') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            ID="EMAIL"
                            name="EMAIL"
                            v-model="form.EMAIL"
                            placeholder="Ej: ejemplo@ucsc.cl"
                            v-validate="'required|max:200'"
                            data-vv-as="Email"
                            :class="{'is-invalid': errors.has('EMAIL')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('EMAIL') }}</div>
                    </div>
                </div>
                    <div class="form-group col-md-6">
                        <label class="required">Titulo</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="TITULO"
                            name="TITULO"
                            v-model="form.TITULO"
                            placeholder="Ej: Educadora diferencial"
                            v-validate="'required|max:100'"
                            data-vv-as="TITULO"
                            :class="{'is-invalid': errors.has('TITULO')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('TITULO') }}</div>
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
                titulo: "Profesor Tutor",
                element: "PROFESOR_TUTOR",
            },
            form: {
                ID: 0,
                RUN: null,
                NOMBRE: null,
                APELLIDO: null,
                EMAIL: null,
                TITULO: null,
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
                ? "Editar Profesor tutor"
                : "Nuevo Profesor tutor";
        },
    },
    created: function () {
        this.loading = false;

        eventHub.$on("LoadingOff", () => {
            this.loading = false;
        });

        eventHub.$on("onEdit", (data) => {



            this.form.ID = data.obj.ID;
            this.form.RUN = data.obj.RUN;
            this.form.NOMBRE = data.obj.NOMBRE;
            this.form.APELLIDO = data.obj.APELLIDO;
            this.form.EMAIL = data.obj.EMAIL;
            this.form.TITULO = data.obj.TITULO;


            this.form.EDITAR_FORMULARIO = true;
            this.$nextTick(() => {

                this.windowForm.kendoWidget().center().open();
            });
        });
        eventHub.$on("onDelete", (data) => {
            this.form.ID = data.obj.ID;
            this.form.RUN = data.obj.RUN;
            kendo
                .confirm(AlertMessage.CONFIRMACION.ELIMINACION + this.form.RUN + " ?")
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
        searchRUN() {
            var keyword = this.form.RUN;

            if (keyword != null && keyword.length > 0) {
                console.log(keyword);
            }
        },
        resetForm() {
            this.form.ID = 0;
            this.form.RUN = null;
            this.form.NOMBRE = null;
            this.form.APELLIDO = null;
            this.form.EMAIl = null;
            this.form.TITULO = null;
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
            formData.append("RUN", this.form.RUN);
            formData.append("NOMBRE", this.form.NOMBRE);
            formData.append("APELLIDO", this.form.APELLIDO);
            formData.append("EMAIL", this.form.EMAIl);
            formData.append("TITULO", this.form.TITULO);

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
                        this.form.RUN = response.data.data.run;
                        this.form.NOMBRE = response.data.data.nombre;
                        this.form.APELLIDO = response.data.data.apellido;
                        this.form.EMAIl = response.data.data.email;
                        this.form.TITULO = response.data.data.titulo;

                        this.windowForm.kendoWidget().close();
                        console.log("axios");
                        console.log(this.form);
                        toastr.success(AlertMessage.FORMULARIO.SAVE_EXITO);
                        eventHub.$emit(
                            !this.form.EDITAR_FORMULARIO
                                ? "onAddTogridElement"
                                : "onEditTogridElement",
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

                        eventHub.$emit("onDeleteToGridElement", {
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
        eventHub.$off("LoadingOff");
        eventHub.$off("onEdit");
        eventHub.$off("onDelete");

    }
}
</script>


