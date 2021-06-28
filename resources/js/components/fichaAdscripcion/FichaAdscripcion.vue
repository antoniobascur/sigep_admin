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
                        <select
                            v-model="form.CARRERA_PROGRAMA"
                            @change=""
                            id="CARRERA_PROGRAMA"
                            data-old=""
                            name="CARRERA_PROGRAMA"
                            class="form-control selectpicker"
                        >
                            <option disabled value="">Seleccione una Carrera</option>
                            <option value="ED_DIFERENCIAL">EDUCACIÓN DIFERENCIAL</option>
                            <option value="ED_MATEMATICAS">EDUCACIÓN MEDIA EN MATEMÁTICAS</option>
                        </select>

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
                            v-on:keyup="searchEducador"
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
                    <div id="dependencia" class="form-group col-md-12" >
                        <label class="required">Dependencia Administrativa</label><br>
                        <input type="radio" id="particular" value="particular" name="dependencia">
                        <label for="particular">Particular</label>
                        <input type="radio" id="subvencionado" value="subvencionado" name="dependencia">
                        <label for="subvencionado">P. Subvencionado</label>
                        <input type="radio" id="municipalizado" value="municipalizado" name="dependencia">
                        <label for="municipalizado">Municipalizado</label>
                        <input type="radio" id="corporado" value="corporado" name="dependencia">
                        <label for="corporado">Corporado</label>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="required">Enseñanza</label><br>
                        <input type="radio" id="media" value="media" name="enseñanza">
                        <label for="media">Media</label>
                        <input type="radio" id="hc" value="hc" name="enseñanza">
                        <label for="hc">HC</label>
                        <input type="radio" id="tp" value="tp" name="enseñanza">
                        <label for="tp">Media</label>
                        <input type="radio" id="basica" value="basica" name="enseñanza">
                        <label for="basica">Básica</label>
                        <input type="radio" id="parv" value="parv" name="enseñanza">
                        <label for="parv">Ed. Parvularia</label>
                        <input type="radio" id="otra" value="otra" name="enseñanza">
                        <label for="otra">Otra</label>
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
                    <div class="form-group col-md-6">
                        <label class="required">Nombre del Director(a)</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="DIRECTOR_CP"
                            name="DIRECTOR_CP"
                            v-model="form.DIRECTOR_CP"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="DIRECTOR_CP"
                            :class="{'is-invalid': errors.has('DIRECTOR_CP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('DIRECTOR_CP') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">E mail (Director)</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="EMAIL_DIRECTOR_CP"
                            name="EMAIL_DIRECTOR_CP"
                            v-model="form.EMAIL_DIRECTOR_CP"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="EMAIL_DIRECTOR_CP"
                            :class="{'is-invalid': errors.has('EMAIL_DIRECTOR_CP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('EMAIL_DIRECTOR_CP') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Nombre Jefe(a) de UTP</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="NOMBRE_UTP_CP"
                            name="NOMBRE_UTP_CP"
                            v-model="form.NOMBRE_UTP_CP"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="NOMBRE_UTP_CP"
                            :class="{'is-invalid': errors.has('NOMBRE_UTP_CP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('NOMBRE_UTP_CP') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">E mail (Jefe(a) de UTP)</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="EMAIL_UTP"
                            name="EMAIL_UTP"
                            v-model="form.EMAIL_UTP"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="EMAIL_UTP"
                            :class="{'is-invalid': errors.has('EMAIL_UTP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('EMAIL_UTP') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required">Nombre Educador(a) o Profesor(a) Colaborador(a) Centro de Práctica</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="NOMBRE_EDUCADOR_CP"
                            name="NOMBRE_EDUCADOR_CP"
                            v-model="form.NOMBRE_EDUCADOR_CP"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="NOMBRE_EDUCADOR_CP"
                            :class="{'is-invalid': errors.has('NOMBRE_EDUCADOR_CP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('NOMBRE_EDUCADOR_CP') }}</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">RUT</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="RUT_EDUCADOR_CP"
                            name="RUT_EDUCADOR_CP"
                            v-model="form.RUT_EDUCADOR_CP"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="RUT_EDUCADOR_CP"
                            :class="{'is-invalid': errors.has('RUT_EDUCADOR_CP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('NOMBRE_EDUCADOR_CP') }}</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">E mail</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="MAIL_EDUCADOR_CP"
                            name="MAIL_EDUCADOR_CP"
                            v-model="form.MAIL_EDUCADOR_CP"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="MAIL_EDUCADOR_CP"
                            :class="{'is-invalid': errors.has('MAIL_EDUCADOR_CP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('MAIL_EDUCADOR_CP') }}</div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required">Teléono de Contacto</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="TELEFONO_EDUCADOR_CP"
                            name="TELEFONO_EDUCADOR_CP"
                            v-model="form.TELEFONO_EDUCADOR_CP"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="TELEFONO_EDUCADOR_CP"
                            :class="{'is-invalid': errors.has('TELEFONO_EDUCADOR_CP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('TELEFONO_EDUCADOR_CP') }}</div>
                    </div>
                    <div class="form-group col-md-9">
                        <label class="required">Título</label>
                        <input
                            type="text"
                            class="form-control"
                            ID="TITULO_EDUCADOR_CP"
                            name="TITULO_EDUCADOR_CP"
                            v-model="form.TITULO_EDUCADOR_CP"
                            placeholder=""
                            v-validate="'required|max:100'"
                            data-vv-as="TITULO_EDUCADOR_CP"
                            :class="{'is-invalid': errors.has('TITULO_EDUCADOR_CP')}"
                        />
                        <div class="invalid-feedback">{{ errors.first('TELEFONO_EDUCADOR_CP') }}</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="required">Egresado de la UCSC</label><br>
                        <input type="radio" id="si" value="si" name="egresado_ucsc">
                        <label for="si">Sí</label>
                        <input type="radio" id="no" value="no" name="egresado_ucsc">
                        <label for="no">No</label>
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
                RUT: null,
                MAIL: null,
                DIRECCION: null,
                COMUNA: null,
                TELEFONO: null,
                PROFESOR_TUTOR: null,
                NIVEL_PRACTICA: null,
                CENTRO_PRACTICA: null,
                DEPENDENCIA: null,
                ENSEÑANZA: null,
                DIRECCION_CP: null,
                COMUNA_CP: null,
                TELEFONO_CP: null,
                DIRECTOR_CP: null,
                EMAIL_DIRECTOR_CP: null,
                NOMBRE_UTP_CP: null,
                EMAIL_UTP: null,
                NOMBRE_EDUCADOR_CP: null,
                RUT_EDUCADOR_CP: null,
                MAIL_EDUCADOR_CP: null,
                TELEFONO_EDUCADOR_CP: null,
                TITULO_EDUCADOR_CP: null,
                EGRESADO_UCSC: null,

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
        searchEducador() {
            var keyword = this.form.EDUCADOR;

            if (keyword != null && keyword.length > 0) {
                //traer informacion del estudiante
                //console.log(keyword);
                console.log('traer informacion del estudiante');
            }
        },

        getCarreras(){

        },

        saveForm() {
            let url = Urls[this.propsToPass.element].SAVE;
            let formData = new FormData();
            //obtengo valores radio buttons
            //VALIDAR SELECCION !!!
            this.form.DEPENDENCIA = $('input[name="dependencia"]:checked').val();
            this.form.ENSEÑANZA = $('input[name="enseñanza"]:checked').val();
            this.form.EGRESADO_UCSC = $('input[name="egresado_ucsc"]:checked').val();

            formData.append("ID", this.form.ID);
            formData.append("CARRERA_PROGRAMA", this.form.CARRERA_PROGRAMA);
            formData.append("EDUCADOR", this.form.EDUCADOR);
            formData.append("RUT", this.form.RUT);
            formData.append("MAIL", this.form.MAIL);
            formData.append("DIRECCION", this.form.DIRECCION);
            formData.append("COMUNA", this.form.COMUNA);
            formData.append("TELEFONO", this.form.TELEFONO);
            formData.append("PROFESOR_TUTOR", this.form.PROFESOR_TUTOR);
            formData.append("NIVEL_PRACTICA", this.form.NIVEL_PRACTICA);
            formData.append("CENTRO_PRACTICA", this.form.CENTRO_PRACTICA);
            formData.append("DEPENDENCIA", this.form.DEPENDENCIA);
            formData.append("ENSEÑANZA", this.form.ENSEÑANZA);
            formData.append("DIRECCION_CP", this.form.DIRECCION_CP);
            formData.append("COMUNA_CP", this.form.COMUNA_CP);
            formData.append("TELEFONO_CP", this.form.TELEFONO_CP);
            formData.append("DIRECTOR_CP", this.form.DIRECTOR_CP);
            formData.append("EMAIL_DIRECTOR_CP", this.form.EMAIL_DIRECTOR_CP);
            formData.append("NOMBRE_UTP_CP", this.form.NOMBRE_UTP_CP);
            formData.append("EMAIL_UTP", this.form.EMAIL_UTP);
            formData.append("NOMBRE_EDUCADOR_CP", this.form.NOMBRE_EDUCADOR_CP);
            formData.append("RUT_EDUCADOR_CP", this.form.RUT_EDUCADOR_CP);
            formData.append("MAIL_EDUCADOR_CP", this.form.MAIL_EDUCADOR_CP);
            formData.append("TELEFONO_EDUCADOR_CP", this.form.TELEFONO_EDUCADOR_CP);
            formData.append("TITULO_EDUCADOR_CP", this.form.TITULO_EDUCADOR_CP);
            formData.append("EGRESADO_UCSC", this.form.EGRESADO_UCSC);
            console.log(this.form);

            axios.post(url, formData, {
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
