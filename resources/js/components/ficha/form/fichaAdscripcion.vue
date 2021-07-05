<template>
    <div>
        <form ID="form" class="modal-form" @submit.prevent="validate">


                <h4>Información Educador(a) en formación </h4>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="required">RUT</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="RUT"
                        name="RUT"
                        v-model="form.RUT"
                        placeholder="Ej: 9.999.999-9"
                        v-on:keyup="searchEstudiante"
                        v-validate="'required|max:100'"
                        data-vv-as="RUT"
                        :class="{'is-invalid': errors.has('RUT')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('RUT') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Carrera o Programa</label>

                    <kendo-dropdownlist
                        :ref="'CARRERA_PROGRAMA'"
                        class="form-control"
                        name="CARRERA_PROGRAMA"
                        v-model="form.CARRERA_PROGRAMA"
                        :data-source="dsCarrera"
                        :data-text-field="'CARRERA'"
                        :data-value-field="'UA'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsCarrera')}"
                    ></kendo-dropdownlist>

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
                <h4>Información Asignatura </h4>
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
                <h4>Centro de practica </h4>
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
    </div>
   </template>

<script>

import Loading from "../../common/Loading";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import {DateInput} from "@progress/kendo-vue-dateinputs";
import AlertMessage from "../../common/json/AlertMessage.json";
import Urls from "../../common/json/Urls.json";
import eventHub from "../../../eventHub";

export default {
    components: {
        Loading,
        MultiSelect,
        DateInput
    },
    data: function () {
        return{
            submit:false,
            dsCarrera:[]

        }

    },
    computed: {
        form() {
            return this.$store.state.ficha;
        },
    },
    created: function () {
        this.getCarreras();
    },
    methods: {

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

        searchEstudiante() {
            var keyword = this.form.RUT;

            if (keyword != null && keyword.length > 7) {
                //traer informacion del estudiante
                //console.log(keyword);
                console.log('traer informacion del estudiante');
                this.getEstudiante(keyword)
            }
        },
        getEstudiante(id){
            let url = Urls["ESTUDIANTES"].GET+id;
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
                        this.form.EDUCADOR = response.data.data[0].NOMBRE + " " +response.data.data[0].APELLIDO ;
                        this.form.MAIL = response.data.data[0].EMAIL;
                        this.form.CARRERA_PROGRAMA = response.data.data[0].UA;

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
                    //console.log(response.data.data);
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
    }
}
</script>

