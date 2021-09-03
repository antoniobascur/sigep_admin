<template>
    <div>
        <h5>Información de la Continuidad </h5>
        <div class="row">
            <div class="form-group col-md-4">
                <label class="required">Cantidad de veces que el estudiante ha realizado práctica en el
                    establecimiento</label>
                <input
                    type="text"
                    class="form-control"
                    ID="CANTIDAD_VECES"
                    name="CANTIDAD_VECES"
                    v-model="form.CANTIDAD_VECES"
                    placeholder=""
                    v-validate="'required|max:100'"
                    data-vv-as="TELEFONO_CP"
                    :class="{'is-invalid': errors.has('CANTIDAD_VECES')}"
                />
                <div class="invalid-feedback">{{ errors.first('CANTIDAD_VECES') }}</div>
            </div>

            <div id="exalumno" class="form-group col-md-2">
                <label class="required">Ex alumno establecimiento</label><br>
                <input type="radio" id="si" value="si" v-model="form.EX_ALUMNO_ESTABLECIMIENTO" name="exalumno">
                <label for="si">Si</label>
                <input type="radio" id="no" value="no" v-model="form.EX_ALUMNO_ESTABLECIMIENTO" name="exalumno">
                <label for="no">No</label>
            </div>

            <div class="form-group col-md-6">
                <label class="required">Razones para solicitar continuidad</label>
                <input
                    type="text"
                    class="form-control"
                    ID="RAZON_CONTINUIDAD"
                    name="RAZON_CONTINUIDAD"
                    v-model="form.RAZON_CONTINUIDAD"
                    placeholder=""
                    v-validate="'required|max:100'"
                    data-vv-as="RAZON_CONTINUIDAD"
                    :class="{'is-invalid': errors.has('RAZON_CONTINUIDAD')}"
                />
                <div class="invalid-feedback">{{ errors.first('RAZON_CONTINUIDAD') }}</div>
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


export default {
    components: {
        Loading,
        MultiSelect,
        DateInput,
    },
    data: function () {
        return {
            submit: false,
            dsCarrera: []

        }

    },
    computed: {
        form() {
            return this.$store.state.fichaContinuidad;
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


                    if (response.data.data.length > 0) {

                        console.log(response);
                        this.form.CENTRO_PRACTICA = response.data.data[0].NOMBRE_ESTABLECIMIENTO;
                        this.form.DEPENDENCIA = response.data.data[0].DEPENDENCIA_ADMINISTRATIVA;
                        this.form.DIRECCION_CP = response.data.data[0].DIRECCION;
                        this.form.TELEFONO_CP = response.data.data[0].TELEFONO;
                        this.form.DIRECTOR_CP = response.data.data[0].NOMBRE_DIRECTOR;
                        this.form.EMAIL_DIRECTOR_CP = response.data.data[0].EMAIL_DIRECTOR;

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
