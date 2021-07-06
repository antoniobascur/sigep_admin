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
                    <label class="required">Nombre Educador(a) en formación</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="NOMBRE"
                        name="NOMBRE"
                        v-model="form.NOMBRE"
                        placeholder="Ej: Descripción ..."
                        v-validate="'required|max:100'"
                        data-vv-as="NOMBRE"
                        :class="{'is-invalid': errors.has('NOMBRE')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('NOMBRE') }}</div>
                </div>

                <div class="form-group col-md-3">
                    <label class="required">Email</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="EMAIL"
                        name="EMAIL"
                        v-model="form.EMAIL"
                        placeholder="Ej: ejemplo@email.com..."
                        v-validate="'required|max:100'"
                        data-vv-as="EMAIL"
                        :class="{'is-invalid': errors.has('EMAIL')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('EMAIL') }}</div>
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
            </div>

                <h4>Información Asignatura </h4>
            <div class="row">
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
            </div>
                <h4>Información Centro de práctica </h4>
            <div class="row">
                <div class="form-group col-md-12">
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
                    <input type="radio" id="Particular" v-model="form.DEPENDENCIA" value="Particular" name="dependencia">
                    <label for="Particular">Particular</label>
                    <input type="radio" id="subvencionado"v-model="form.DEPENDENCIA" value="subvencionado" name="dependencia">
                    <label for="subvencionado">P. Subvencionado</label>
                    <input type="radio" id="municipalizado" v-model="form.DEPENDENCIA" value="municipalizado" name="dependencia">
                    <label for="municipalizado">Municipalizado</label>
                    <input type="radio" id="corporado" v-model="form.DEPENDENCIA" value="corporado" name="dependencia">
                    <label for="corporado">Corporado</label>
                </div>
                <div class="form-group col-md-12">
                    <label class="required">Enseñanza</label><br>
                    <input type="radio" id="media" v-model="form.ENSENANZA" value="media" name="ensenanza">
                    <label for="media">Media</label>
                    <input type="radio" id="hc" v-model="form.ENSENANZA" value="hc" name="ensenanza">
                    <label for="hc">HC</label>
                    <input type="radio" id="tp" v-model="form.ENSENANZA" value="tp" name="ensenanza">
                    <label for="tp">Basica</label>
                    <input type="radio" id="basica" v-model="form.ENSENANZA" value="basica" name="ensenanza">
                    <label for="basica">Básica</label>
                    <input type="radio" id="parv" v-model="form.ENSENANZA" value="parv" name="ensenanza">
                    <label for="parv">Ed. Parvularia</label>
                    <input type="radio" id="otra" v-model="form.ENSENANZA" value="otra" name="ensenanza">
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
                    <label class="required">Nombre Director(a)</label>
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
                    <label class="required">Email Director(a)</label>
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
                    <label class="required">Email Jefe(a) de UTP</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="EMAIL_UTP_CP"
                        name="EMAIL_UTP_CP"
                        v-model="form.EMAIL_UTP_CP"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="EMAIL_UTP_CP"
                        :class="{'is-invalid': errors.has('EMAIL_UTP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('EMAIL_UTP_CP') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Nombre Profesor(a) Colaborador(a) Centro de Práctica</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="NOMBRE_PROF_COLABORADOR_CP"
                        name="NOMBRE_PROF_COLABORADOR_CP"
                        v-model="form.NOMBRE_PROF_COLABORADOR_CP"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="NOMBRE_PROF_COLABORADOR_CP"
                        :class="{'is-invalid': errors.has('NOMBRE_PROF_COLABORADOR_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('NOMBRE_PROF_COLABORADOR_CP') }}</div>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">RUT Profesor(a) Colaborador(a) Centro de práctica</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="RUT_PROF_COLABORADOR_CP"
                        name="RUT_PROF_COLABORADOR_CP"
                        v-model="form.RUT_PROF_COLABORADOR_CP"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="RUT_PROF_COLABORADOR_CP"
                        :class="{'is-invalid': errors.has('RUT_PROF_COLABORADOR_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('RUT_PROF_COLABORADOR_CP') }}</div>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">Email Profesor(a) Colaborador(a) Centro de práctica</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="EMAIL_PROF_COLABORADOR_CP"
                        name="EMAIL_PROF_COLABORADOR_CP"
                        v-model="form.EMAIL_PROF_COLABORADOR_CP"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="EMAIL_PROF_COLABORADOR_CP"
                        :class="{'is-invalid': errors.has('EMAIL_PROF_COLABORADOR_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('EMAIL_PROF_COLABORADOR_CP') }}</div>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">Teléfono de Contacto</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="TELEFONO_PROF_COLABORADOR_CP"
                        name="TELEFONO_PROF_COLABORADOR_CP"
                        v-model="form.TELEFONO_PROF_COLABORADOR_CP"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="TELEFONO_PROF_COLABORADOR_CP"
                        :class="{'is-invalid': errors.has('TELEFONO_PROF_COLABORADOR_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('TELEFONO_PROF_COLABORADOR_CP') }}</div>
                </div>
                <div class="form-group col-md-9">
                    <label class="required">Título</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="TITULO_PROF_COLABORADOR_CP"
                        name="TITULO_PROF_COLABORADOR_CP"
                        v-model="form.TITULO_PROF_COLABORADOR_CP"
                        placeholder=""
                        v-validate="'required|max:100'"
                        data-vv-as="TITULO_PROF_COLABORADOR_CP"
                        :class="{'is-invalid': errors.has('TITULO_PROF_COLABORADOR_CP')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('TITULO_PROF_COLABORADOR_CP') }}</div>
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
            this.form.CARRERA = null;
            this.form.NOMBRE = null;
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
                        this.form.NOMBRE = response.data.data[0].NOMBRE + " " +response.data.data[0].APELLIDO ;
                        this.form.EMAIL = response.data.data[0].EMAIL;
                        this.form.CARRERA = response.data.data[0].UA;
                        this.form.DIRECCION = response.data.data[0].DIRECCION;
                        this.form.TELEFONO = response.data.data[0].TELEFONO;
                        this.form.COMUNA = response.data.data[0].COMUNA;


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
                        this.form.DEPENDENCIA = response.data.data[0].DEPENDENCIA_ADMINISTRATIVA;
                        this.form.ENSENANZA = response.data.data[0].TIPO_ENSENANZA;
                        this.form.DIRECCION_CP = response.data.data[0].DIRECCION;
                        this.form.TELEFONO_CP = response.data.data[0].TELEFONO;
                        this.form.COMUNA_CP = response.data.data[0].COMUNA;
                        this.form.DIRECTOR_CP = response.data.data[0].NOMBRE_DIRECTOR;
                        this.form.EMAIL_DIRECTOR_CP = response.data.data[0].EMAIL_DIRECTOR;
                        this.form.NOMBRE_UTP_CP = response.data.data[0].NOMBRE_JEFE_UTP;
                        this.form.EMAIL_UTP_CP = response.data.data[0].EMAIL_JEFE_UTP;
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

