<template>
    <div>
        <h5>Información Centro de práctica </h5>
        <div class="row">
            <div class="form-group col-md-3">
                <label class="required">RBD</label>
                <input
                    type="text"
                    class="form-control"
                    ID="RBD_CP"
                    name="RBD_CP"
                    v-model="form.RBD_CP"
                    placeholder=""
                    v-on:keyup="searchEstablecimiento"
                    v-validate="'required|max:100'"
                    data-vv-as="RBD"
                    :class="{'is-invalid': errors.has('RBD_CP')}"
                />
                <div class="invalid-feedback">{{ errors.first('RBD_CP') }}</div>
            </div>
            <div class="form-group col-md-9">
                <label class="required">Nombre del Centro de Práctica</label>
                <input
                    type="text"
                    class="form-control"
                    ID="NOMBRE_CP"
                    name="NOMBRE_CP"
                    v-model="form.NOMBRE_CP"
                    placeholder=""
                    v-validate="'required|max:100'"
                    data-vv-as="NOMBRE_CP"
                    :class="{'is-invalid': errors.has('NOMBRE_CP')}"
                />
                <div class="invalid-feedback">{{ errors.first('NOMBRE_CP') }}</div>
            </div>
            <div class="form-group col-md-6">
                <label class="required">Comuna</label>
                <kendo-dropdownlist
                    :ref="'COMUNA_cp'"
                    class="form-control"
                    name="COMUNA_cp"
                    v-model="form.COMUNA_cp"
                    :data-source="dsComunas"
                    :data-text-field="'name'"
                    :data-value-field="'name'"
                    :optionLabel="'Seleccione'"
                    :filter="'contains'"
                    :class="{'is-invalid': errors.has('dsComunas')}"
                ></kendo-dropdownlist>
            </div>
            <div id="dependencia" class="form-group col-md-6">
                <label class="required">Dependencia Administrativa</label><br>

                <kendo-dropdownlist
                    :ref="'DEPENDENCIA_CP'"
                    class="form-control"
                    name="DEPENDENCIA_CP"
                    v-model="form.DEPENDENCIA_CP"
                    :data-source="dsDependencia"
                    :data-text-field="'name'"
                    :data-value-field="'name'"
                    :optionLabel="'Seleccione'"
                    :filter="'contains'"
                    :class="{'is-invalid': errors.has('dsDependencia')}"
                ></kendo-dropdownlist>

                <div class="invalid-feedback">{{ errors.first('DEPENDENCIA_CP') }}</div>

            </div>
            <div class="form-group col-md-6">
                <label class="required">Nombre del Director(a) / que valida la pasantía</label>
                <input
                    type="text"
                    class="form-control"
                    ID="DIRECTIVO_CP"
                    name="DIRECTIVO_CP"
                    v-model="form.DIRECTIVO_CP"
                    placeholder=""
                    v-validate="'required|max:100'"
                    data-vv-as="DIRECTIVO_CP"
                    :class="{'is-invalid': errors.has('DIRECTIVO_CP')}"
                />
                <div class="invalid-feedback">{{ errors.first('DIRECTIVO_CP') }}</div>
            </div>
            <div class="form-group col-md-6">
                <label class="required">Cargo directivo dentro de la institución:</label>
                <input
                    type="text"
                    class="form-control"
                    ID="CARGO_DIRECTIVO_CP"
                    name="CARGO_DIRECTIVO_CP"
                    v-model="form.CARGO_DIRECTIVO_CP"
                    placeholder=""
                    v-validate="'required|max:100'"
                    data-vv-as="CARGO_DIRECTIVO_CP"
                    :class="{'is-invalid': errors.has('CARGO_DIRECTIVO_CP')}"
                />
                <div class="invalid-feedback">{{ errors.first('CARGO_DIRECTIVO_CP') }}</div>
            </div>
            <div class="form-group col-md-3">
                <label class="required">Teléfono Contacto</label>
                <input
                    type="text"
                    class="form-control"
                    ID="TELEFONO_CONTACTO_CP"
                    name="TELEFONO_CONTACTO_CP"
                    v-model="form.TELEFONO_CONTACTO_CP"
                    placeholder=""
                    v-validate="'required|max:100'"
                    data-vv-as="TELEFONO_CONTACTO_CP"
                    :class="{'is-invalid': errors.has('TELEFONO_CONTACTO_CP')}"
                />
                <div class="invalid-feedback">{{ errors.first('TELEFONO_CONTACTO_CP') }}</div>
            </div>
            <div class="form-group col-md-3">
                <label class="required">Email Contacto</label>
                <input
                    type="text"
                    class="form-control"
                    ID="EMAIL_CONTACTO_CP"
                    name="EMAIL_CONTACTO_CP"
                    v-model="form.EMAIL_CONTACTO_CP"
                    placeholder=""
                    v-validate="'required|max:100'"
                    data-vv-as="EMAIL_CONTACTO_CP"
                    :class="{'is-invalid': errors.has('EMAIL_CONTACTO_CP')}"
                />
                <div class="invalid-feedback">{{ errors.first('TELEFONO_CP') }}</div>
            </div>


            <div class="form-group col-md-6">
                <label class="required">Nombre Educador(a) o Profesor(a) Colaborador(a) Centro de Práctica</label>
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
                <label class="required">Email Profesor(a) Colaborador(a) Centro de práctica </label>
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
                <label class="required">Función dentro de la institución </label>
                <input
                    type="text"
                    class="form-control"
                    ID="FUNCION_PROF_COLABORADOR_CP"
                    name="FUNCION_PROF_COLABORADOR_CP"
                    v-model="form.FUNCION_PROF_COLABORADOR_CP"
                    placeholder=""
                    v-validate="'required|max:100'"
                    data-vv-as="EMAIL_PROF_COLABORADOR_CP"
                    :class="{'is-invalid': errors.has('FUNCION_PROF_COLABORADOR_CP')}"
                />
                <div class="invalid-feedback">{{ errors.first('FUNCION_PROF_COLABORADOR_CP') }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import Loading from "../../../../common/Loading";
import {DateInput} from "@progress/kendo-vue-dateinputs";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import Urls from "../../../../common/json/Urls.json";
import AlertMessage from "../../../../common/json/AlertMessage.json";
import eventHub from "../../../../../eventHub";
import DependenciaAdministrativa from "../../../../common/json/DependenciaAdministrativa.json";
import Communes from "../../../../common/json/Communes.json";


export default {
    components: {
        Loading,
        MultiSelect,
        DateInput,
    },
    data: function () {
        return {
            submit: false,
            dsDependencia: [],
            dsComunas: [],
        }

    },
    computed: {
        form() {
            return this.$store.state.fichaAutogestion;
        },
    },

    created: function () {
        this.getDependencia();
        this.dsComunas = Communes.communes;
    },
    methods: {
        getDependencia() {
            this.dsDependencia = DependenciaAdministrativa.DependenciaAdministrativa;
        },
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
        getEstudiante(id) {
            let url = Urls["ESTUDIANTES"].GET + id;
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
                        this.form.NOMBRE = response.data.data[0].NOMBRE + " " + response.data.data[0].APELLIDO;
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
        getCarreras() {
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

            if (keyword != null && keyword.length > 3) {
                //traer informacion del CENTRO PRACTICA
                console.log(keyword);
                console.log('traer informacion del Centro de práctica');
                this.getEstablecimiento(keyword)
            }
        },
        getEstablecimiento(id) {
            let url = Urls["CENTRO_PRACTICAS"].GET + id;
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
                    console.log(response);

                    if (response.data.data.length > 0) {

                        console.log(response);
                        this.form.CENTRO_PRACTICA = response.data.data[0].NOMBRE_ESTABLECIMIENTO;
                        this.form.DEPENDENCIA = response.data.data[0].DEPENDENCIA_ADMINISTRATIVA;
                        this.form.DIRECCION_CP = response.data.data[0].DIRECCION;
                        this.form.TELEFONO_CP = response.data.data[0].TELEFONO;
                        this.form.DIRECTOR_CP = response.data.data[0].NOMBRE_DIRECTOR;

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
