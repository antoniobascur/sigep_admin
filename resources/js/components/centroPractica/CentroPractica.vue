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
        <!--        TODO:kendo-windows-Nuevo centro de practicas-->
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
                        <label class="required">RBD</label>
                        <input
                            class="form-control"
                            type="text"
                            data-vv-as="RBD"
                            ID="RBD"
                            name="RBD"
                            v-model="form.RBD"
                            v-on:keyup="searchEstablecimiento"
                            placeholder="Ej: 213213"
                            v-validate="'required|max:50'"
                            :class="{'is-invalid': errors.has('RBD')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('RBD') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Nombre Establecimiento</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="NOMBRE_ESTABLECIMIENTO"
                            name="NOMBRE_ESTABLECIMIENTO"
                            v-model="form.NOMBRE_ESTABLECIMIENTO"
                            placeholder="Ej: Colegio ..."
                            v-validate="'required|max:100'"
                            data-vv-as="Nombre Establecimiento"
                            :class="{'is-invalid': errors.has('NOMBRE_ESTABLECIMIENTO')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('NOMBRE_ESTABLECIMIENTO') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required">Dependencia Administrativa</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="DEPENDENCIA_ADMINISTRATIVA"
                            name="DEPENDENCIA_ADMINISTRATIVA"
                            v-model="form.DEPENDENCIA_ADMINISTRATIVA"
                            placeholder="Ej: Colegio ..."
                            v-validate="'required|max:100'"
                            data-vv-as="Dependencia Administrativa"
                            :class="{'is-invalid': errors.has('DEPENDENCIA_ADMINISTRATIVA')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('DEPENDENCIA_ADMINISTRATIVA') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Tipo Enseñanza</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="TIPO_ENSENANZA"
                            name="TIPO_ENSENANZA"
                            v-model="form.TIPO_ENSENANZA"
                            placeholder="Ej: Colegio ..."
                            v-validate="'required|max:100'"
                            data-vv-as="Tipo Enseñanza"
                            :class="{'is-invalid': errors.has('TIPO_ENSENANZA')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('TIPO_ENSENANZA') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required">Región</label>
                        <kendo-dropdownlist
                            class="form-control"
                            name="REGION"
                            ID="REGION"
                            v-model="form.REGION"
                            @select="getComunas"
                            :data-source="dsRegiones"
                            :data-text-field="'name'"
                            :data-value-field="'name'"
                            :optionLabel="'Seleccione'"
                            :filter="'contains'"
                            :class="{'is-invalid': errors.has('dsRegiones')}"
                        ></kendo-dropdownlist>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Comuna</label>
                        <kendo-dropdownlist
                            :ref="'COMUNA'"
                            class="form-control"
                            name="COMUNA"
                            v-model="form.COMUNA"
                            :data-source="dsComunas"
                            :data-text-field="'name'"
                            :data-value-field="'name'"
                            :optionLabel="'Seleccione'"
                            :filter="'contains'"
                            :class="{'is-invalid': errors.has('dsComunas')}"
                        ></kendo-dropdownlist>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required">Dirección</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="DIRECCION"
                            name="DIRECCION"
                            v-model="form.DIRECCION"
                            placeholder="Ej: DIRECCION 1212 ..."
                            v-validate="'required|max:200'"
                            data-vv-as="Direccion"
                            :class="{'is-invalid': errors.has('DIRECCION')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('DIRECCION') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Teléfono</label>
                        <input
                            type="number"
                            class="form-control"
                            ID="TELEFONO"
                            name="TELEFONO"
                            v-model="form.TELEFONO"
                            placeholder="Ej: 977021212 ..."
                            v-validate="'required|max:200'"
                            data-vv-as="Teléfono"
                            :class="{'is-invalid': errors.has('TELEFONO')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('TELEFONO') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required">Nombre Director</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="NOMBRE_DIRECTOR"
                            name="NOMBRE_DIRECTOR"
                            v-model="form.NOMBRE_DIRECTOR"
                            placeholder="Ej: Juan Ejemplo ..."
                            v-validate="'required|max:200'"
                            data-vv-as="Nombre Director"
                            :class="{'is-invalid': errors.has('NOMBRE_DIRECTOR')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('NOMBRE_DIRECTOR') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Email Director</label>
                        <input
                            type="email"
                            class="form-control"
                            ID="EMAIL_DIRECTOR"
                            name="EMAIL_DIRECTOR"
                            v-model="form.EMAIL_DIRECTOR"
                            placeholder="Ej: Ejemplo@ucsc.cl ..."
                            v-validate="'required|max:200'"
                            data-vv-as="Email"
                            :class="{'is-invalid': errors.has('EMAIL_DIRECTOR')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('EMAIL_DIRECTOR') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required">Nombre Jefe UTP</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="NOMBRE_JEFE_UTP"
                            name="NOMBRE_JEFE_UTP"
                            v-model="form.NOMBRE_JEFE_UTP"
                            placeholder="Ej: Juan Ejemplo ..."
                            v-validate="'required|max:200'"
                            data-vv-as="Nombre Jefe UTP"
                            :class="{'is-invalid': errors.has('NOMBRE_JEFE_UTP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('NOMBRE_JEFE_UTP') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Email Jefe UTP</label>
                        <input
                            type="email"
                            class="form-control"
                            ID="EMAIL_JEFE_UTP"
                            name="EMAIL_JEFE_UTP"
                            v-model="form.EMAIL_JEFE_UTP"
                            placeholder="Ej: Ejemplo@ucsc.cl ..."
                            v-validate="'required|max:200'"
                            data-vv-as="Email"
                            :class="{'is-invalid': errors.has('EMAIL_JEFE_UTP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('EMAIL_JEFE_UTP') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required">Grupo Practica</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="GRUPO_PRACTICA"
                            name="GRUPO_PRACTICA"
                            v-model="form.GRUPO_PRACTICA"
                            placeholder="Ej: EJemplo ..."
                            v-validate="'required|max:200'"
                            data-vv-as="Grupo Practica"
                            :class="{'is-invalid': errors.has('GRUPO_PRACTICA')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('GRUPO_PRACTICA') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Cupos Practica</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="CUPOS_PRACTICA"
                            name="CUPOS_PRACTICA"
                            v-model="form.CUPOS_PRACTICA"
                            placeholder="Ej: 5 ..."
                            v-validate="'required|max:200'"
                            data-vv-as="Cupos Practica"
                            :class="{'is-invalid': errors.has('CUPOS_PRACTICA')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('CUPOS_PRACTICA') }}</div>
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
import Regions from "../common/json/Regions.json";
import Communes from "../common/json/Communes.json";
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
                titulo: "Centros de practicas",
                ayuda: "lorem ",
                element: "CENTRO_PRACTICAS",
            },
            dsRegiones: [],
            dsComunas: [],
            form: {
                ID: 0,
                NOMBRE_ESTABLECIMIENTO: null,
                NOMBRE_DIRECTOR: null,
                RBD: null,
                DEPENDENCIA_ADMINISTRATIVA: null,
                NOMBRE_JEFE_UTP: null,
                TELEFONO: null,
                CUPOS_PRACTICA: null,
                GRUPO_PRACTICA: null,
                EMAIL_DIRECTOR: null,
                TIPO_ENSENANZA: null,
                COMUNA: null,
                DIRECCION: null,
                REGION: null,
                EMAIL_JEFE_UTP: null,
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
                ? "Editar Centro de practica"
                : "Nuevo Centro de practica";
        },
    },
    created: function () {
        //this.loading = false;
        this.getRegion();
       this.dsComunas=Communes.communes;
        eventHub.$on("LoadingOff", () => {
            this.loading = false;
        });

        eventHub.$on("onEditCentroPractica", (data) => {

                this.$nextTick(() => {
                    var infoRegion = Regions.regions.find(record => record.name === data.obj.REGION);
                    this.dsComunas = infoRegion.communes;
                    this.form.COMUNA = data.obj.COMUNA;

                });

            this.form.ID = data.obj.ID;
            this.form.NOMBRE_ESTABLECIMIENTO = data.obj.NOMBRE_ESTABLECIMIENTO;
            this.form.NOMBRE_DIRECTOR = data.obj.NOMBRE_DIRECTOR;
            this.form.RBD = data.obj.RBD;
            this.form.DEPENDENCIA_ADMINISTRATIVA = data.obj.DEPENDENCIA_ADMINISTRATIVA;
            this.form.NOMBRE_JEFE_UTP = data.obj.NOMBRE_JEFE_UTP;
            this.form.TELEFONO = data.obj.TELEFONO;
            this.form.CUPOS_PRACTICA = data.obj.CUPOS_PRACTICA;
            this.form.GRUPO_PRACTICA = data.obj.GRUPO_PRACTICA;
            this.form.EMAIL_DIRECTOR = data.obj.EMAIL_DIRECTOR;
            this.form.TIPO_ENSENANZA = data.obj.TIPO_ENSENANZA;

            this.form.DIRECCION = data.obj.DIRECCION;
            this.form.REGION = data.obj.REGION;
            this.form.EMAIL_JEFE_UTP = data.obj.EMAIL_JEFE_UTP;

            this.form.COMUNA = data.obj.COMUNA;

            this.form.EDITAR_FORMULARIO = true;
            this.$nextTick(() => {

                this.windowForm.kendoWidget().center().open();
            });
        });
        eventHub.$on("onDeleteCentroPractica", (data) => {
            this.form.ID = data.obj.ID;
            this.form.RBD = data.obj.RBD;
            kendo
                .confirm(AlertMessage.CONFIRMACION.ELIMINACION + this.form.RBD + " ?")
                .then((result) => {
                    this.delete();
                });
        });
    },
    methods: {
        getRegion() {
            this.dsRegiones = Regions["regions"];
        },
        getComunas(value) {
            this.dsComunas = value.dataItem.communes;
        },
        onDialogForm() {

            this.$nextTick(() => {
                (!this.form.EDITAR_FORMULARIO)?this.resetForm():"";
                this.windowForm.kendoWidget().center().open();
            });
        },
        searchEstablecimiento() {
            var keyword = this.form.RBD;

            if (keyword != null && keyword.length > 0) {
                console.log(keyword);
            }
        },
        resetForm() {
            this.form.ID = 0;
            this.form.NOMBRE_ESTABLECIMIENTO = null;
            this.form.NOMBRE_DIRECTOR = null;
            this.form.RBD = null;
            this.form.DEPENDENCIA_ADMINISTRATIVA = null;
            this.form.NOMBRE_JEFE_UTP = null;
            this.form.TELEFONO = null;
            this.form.CUPOS_PRACTICA = null;
            this.form.GRUPO_PRACTICA = null;
            this.form.EMAIL_DIRECTOR = null;
            this.form.TIPO_ENSENANZA = null;
            this.form.COMUNA = null;
            this.form.DIRECCION = null;
            this.form.REGION = null;
            this.form.EMAIL_JEFE_UTP = null;
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
            formData.append("NOMBRE_ESTABLECIMIENTO", this.form.NOMBRE_ESTABLECIMIENTO);
            formData.append("NOMBRE_DIRECTOR", this.form.NOMBRE_DIRECTOR);
            formData.append("RBD", this.form.RBD);
            formData.append("DEPENDENCIA_ADMINISTRATIVA", this.form.DEPENDENCIA_ADMINISTRATIVA);
            formData.append("NOMBRE_JEFE_UTP", this.form.NOMBRE_JEFE_UTP);
            formData.append("TELEFONO", this.form.TELEFONO);
            formData.append("CUPOS_PRACTICA", this.form.CUPOS_PRACTICA);
            formData.append("GRUPO_PRACTICA", this.form.GRUPO_PRACTICA);
            formData.append("EMAIL_DIRECTOR", this.form.EMAIL_DIRECTOR);
            formData.append("TIPO_ENSENANZA", this.form.TIPO_ENSENANZA);
            formData.append("COMUNA", this.form.COMUNA);
            formData.append("DIRECCION", this.form.DIRECCION);
            formData.append("REGION", this.form.REGION);
            formData.append("EMAIL_JEFE_UTP", this.form.EMAIL_JEFE_UTP);

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
                        this.form.NOMBRE_ESTABLECIMIENTO = response.data.data.nombreEstablecimiento;
                        this.form.NOMBRE_DIRECTOR = response.data.data.nombreDirector;
                        this.form.RBD = response.data.data.rbd;
                        this.form.DEPENDENCIA_ADMINISTRATIVA = response.data.data.dependenciaAdministrativa;
                        this.form.NOMBRE_JEFE_UTP = response.data.data.nombreJefeUtp;
                        this.form.TELEFONO = response.data.data.telefono;
                        this.form.CUPOS_PRACTICA = response.data.data.cuposPractica;
                        this.form.GRUPO_PRACTICA = response.data.data.grupoPractica;
                        this.form.EMAIL_DIRECTOR = response.data.data.emailDirector;
                        this.form.TIPO_ENSENANZA = response.data.data.tipoEnsenanza;
                        this.form.COMUNA = response.data.data.comuna;
                        this.form.DIRECCION = response.data.data.direccion;
                        this.form.REGION = response.data.data.region;
                        this.form.EMAIL_JEFE_UTP = response.data.data.emailJefeUtp;
                        this.windowForm.kendoWidget().close();
                        console.log("axios");
                        console.log(this.form);
                        toastr.success(AlertMessage.FORMULARIO.SAVE_EXITO);
                        eventHub.$emit(
                            !this.form.EDITAR_FORMULARIO
                                ? "onAddTogridElementCentroPractica"
                                : "onEditCentroPracticaTogridElement",
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

                        eventHub.$emit("onDeleteCentroPracticaToGridElement", {
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
        //eventHub.$off("LoadingOff");
        eventHub.$off("onEditCentroPractica");
        eventHub.$off("onDeleteCentroPractica");

    }
}
</script>


