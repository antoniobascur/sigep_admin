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
                                    Nueva Ficha
                                </button>
                            </div>
                        </div>
                        <!--<Grid></Grid>
                        TODO:Contenido-->
                    </div>
                </div>
            </div>
        </div>
        <!--        TODO:kendo-windows-Nuevo Estado solicitud-->
        <kendo-window
            :ref="'form'"
            :width="'80%'"
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
                    <div class="form-group col-md-12">
                        <label class="required">Carrera o Programa</label>
                        <input
                            class="form-control"
                            type="text"
                            data-vv-as="CARRERA_PROGRAMA"
                            ID="CARRERA_PROGRAMA"
                            name="CARRERA_PROGRAMA"
                            v-model="form.CARRERA_PROGRAMA"
                            v-on:keyup="searchTipoSolicitud"
                            placeholder="Ej: Educación Diferencial"
                            v-validate="'required|max:50'"
                            :class="{'is-invalid': errors.has('CARRERA_PROGRAMA')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('CARRERA_PROGRAMA') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Nombre Educador(a) en formación o Profesor(a) en formación</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="EDUCADOR"
                            name="EDUCADOR"
                            v-model="form.EDUCADOR"
                            placeholder="Ej: Descripción ..."
                            v-validate="'required|max:100'"
                            data-vv-as="EDUCADOR"
                            :class="{'is-invalid': errors.has('EDUCADOR')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('EDUCADOR') }}</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">RUT</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="RUT"
                            name="RUT"
                            v-model="form.RUT"
                            placeholder="Ej: 9.999.999-9"
                            v-validate="'required|max:100'"
                            data-vv-as="RUT"
                            :class="{'is-invalid': errors.has('RUT')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('RUT') }}</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">E mail</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="MAIL"
                            name="MAIL"
                            v-model="form.MAIL"
                            placeholder="Ej: ejemplo@email.com..."
                            v-validate="'required|max:100'"
                            data-vv-as="MAIL"
                            :class="{'is-invalid': errors.has('MAIL')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('MAIL') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Dirección</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="DIRECCION"
                            name="DIRECCION"
                            v-model="form.DIRECCION"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="DIRECCION"
                            :class="{'is-invalid': errors.has('DIRECCION')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('DIRECCION') }}</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Comuna</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="COMUNA"
                            name="COMUNA"
                            v-model="form.COMUNA"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="COMUNA"
                            :class="{'is-invalid': errors.has('COMUNA')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('COMUNA') }}</div>
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
                    <div class="form-group col-md-9">
                        <label class="required">Profesor(a) Tutor responsable UCSC</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="PROFESOR_TUTOR"
                            name="PROFESOR_TUTOR"
                            v-model="form.PROFESOR_TUTOR"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="PROFESOR_TUTOR"
                            :class="{'is-invalid': errors.has('PROFESOR_TUTOR')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('PROFESOR_TUTOR') }}</div>
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
                    <div class="form-group col-md-12">
                        <label class="required">Dependencia Administrativa</label><br>
                        <input type="checkbox" id="particular" value="particular" v-model="checkedDependencia">
                        <label for="particular">Particular</label>
                        <input type="checkbox" id="subvencionado" value="subvencionado" v-model="checkedDependencia">
                        <label for="subvencionado">P. Subvencionado</label>
                        <input type="checkbox" id="municipalizado" value="municipalizado" v-model="checkedDependencia">
                        <label for="municipalizado">Municipalizado</label>
                        <input type="checkbox" id="corporado" value="corporado" v-model="checkedDependencia">
                        <label for="corporado">Corporado</label>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="required">Enseñanza</label><br>
                        <input type="radio" id="media" value="media" v-model="picked">
                        <label for="media">Media</label>
                        <input type="radio" id="hc" value="hc" v-model="picked">
                        <label for="hc">HC</label>
                        <input type="radio" id="tp" value="tp" v-model="picked">
                        <label for="tp">Media</label>
                        <input type="radio" id="basica" value="basica" v-model="picked">
                        <label for="basica">Básica</label>
                        <input type="radio" id="parv" value="parv" v-model="picked">
                        <label for="parv">Ed. Parvularia</label>
                        <input type="radio" id="otra" value="otra" v-model="picked">
                        <label for="hc">Otra</label>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Dirección</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="DIRECCION_CP"
                            name="DIRECCION_CP"
                            v-model="form.DIRECCION_CP"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="DIRECCION_CP"
                            :class="{'is-invalid': errors.has('DIRECCION_CP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('DIRECCION_CP') }}</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Comuna</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="COMUNA_CP"
                            name="COMUNA_CP"
                            v-model="form.COMUNA_CP"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="COMUNA_CP"
                            :class="{'is-invalid': errors.has('COMUNA_CP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('COMUNA_CP') }}</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Teléfono</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="TELEFONO_CP"
                            name="TELEFONO_CP"
                            v-model="form.TELEFONO_CP"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="TELEFONO_CP"
                            :class="{'is-invalid': errors.has('TELEFONO_CP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('TELEFONO_CP') }}</div>
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
                titulo: "Ficha Adscripción",
                element: "FICHA_ADSCRIPCION",
            },
            form: {
                ID: 0,
                CARRERA_PROGRAMA: null,
                EDUCADOR: null,
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
                ? "Editar Ficha Adscripción"
                : "Nueva Ficha Adscripción";
        },
    },
    created: function () {
        this.loading = false;

        eventHub.$on("LoadingOff", () => {
            this.loading = false;
        });

        eventHub.$on("onEdit", (data) => {

            this.form.ID = data.obj.ID;
            this.form.CARRERA_PROGRAMA = data.obj.CARRERA_PROGRAMA;
            this.form.EDUCADOR = data.obj.EDUCADOR;
            this.form.EDITAR_FORMULARIO = true;
            this.$nextTick(() => {

                this.windowForm.kendoWidget().center().open();
            });
        });
        eventHub.$on("onDelete", (data) => {
            this.form.ID = data.obj.ID;
            this.form.CARRERA_PROGRAMA = data.obj.CARRERA_PROGRAMA;
            kendo
                .confirm(AlertMessage.CONFIRMACION.ELIMINACION + this.form.CARRERA_PROGRAMA + " ?")
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
        searchTipoSolicitud() {
            var keyword = this.form.CARRERA_PROGRAMA;

            if (keyword != null && keyword.length > 0) {
                console.log(keyword);
            }
        },
        resetForm() {
            this.form.ID = 0;
            this.form.CARRERA_PROGRAMA = null;
            this.form.EDUCADOR = null;
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
            formData.append("CARRERA_PROGRAMA", this.form.CARRERA_PROGRAMA);
            formData.append("EDUCADOR", this.form.EDUCADOR);


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
                        this.form.CARRERA_PROGRAMA = response.data.data.CARRERA_PROGRAMA;
                        this.form.EDUCADOR = response.data.data.EDUCADOR;

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
