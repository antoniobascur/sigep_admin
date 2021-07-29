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
                    <div class="form-group col-md-6">
                        <label class="required">Nivel de práctica</label>
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
                        <div class="form-group col-md-3">
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
                    <div class="form-group col-md-9">
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
                        <div id="dependencia" class="form-group col-md-12" >
                            <label class="required">Dependencia Administrativa</label><br>
                            <input type="radio" id="Particular" v-model="form.DEPENDENCIA" value="Particular" name="dependencia">
                            <label for="Particular">Particular</label>
                            <input type="radio" id="subvencionado"v-model="form.DEPENDENCIA" value="subvencionado" name="dependencia">
                            <label for="subvencionado">Particular Subvencionado</label>
                            <input type="radio" id="municipal" v-model="form.DEPENDENCIA" value="municipal" name="dependencia">
                            <label for="municipal">Municipal</label>
                            <input type="radio" id="servicio_local_andalien" v-model="form.DEPENDENCIA" value="servicio_local_andalien" name="dependencia">
                            <label for="servicio_local_andalien">Servicio Local de Educación Pública Andalién Sur</label>
                            <input type="radio" id="daem_talcahuano" v-model="form.DEPENDENCIA" value="daem_talcahuano" name="dependencia">
                            <label for="daem_talcahuano">Daem Talcahuano</label>
                            <input type="radio" id="daem_hualpen" v-model="form.DEPENDENCIA" value="daem_hualpen" name="dependencia">
                            <label for="daem_hualpen">Daem Hualpén</label>
                            <input type="radio" id="daem_san_pedro" v-model="form.DEPENDENCIA" value="daem_san_pedro" name="dependencia">
                            <label for="daem_san_pedro">Daem San Pedro</label>
                            <input type="radio" id="daem_coronel" v-model="form.DEPENDENCIA" value="daem_coronel" name="dependencia">
                            <label for="daem_coronel">Daem Coronel</label>
                            <input type="radio" id="daem_lota" v-model="form.DEPENDENCIA" value="daem_lota" name="dependencia">
                            <label for="daem_lota">Daem Lota</label>
                            <input type="radio" id="daem_penco" v-model="form.DEPENDENCIA" value="daem_penco" name="dependencia">
                            <label for="daem_penco">Daem Penco</label>
                            <input type="radio" id="daem_tome" v-model="form.DEPENDENCIA" value="daem_tome" name="dependencia">
                            <label for="daem_tome">Daem Tomé</label>
                            <input type="radio" id="arzobispado" v-model="form.DEPENDENCIA" value="arzobispado" name="dependencia">
                            <label for="arzobispado">Arzobispado de Concepción</label>
                            <input type="radio" id="junji" v-model="form.DEPENDENCIA" value="junji" name="dependencia">
                            <label for="junji">JUNJI</label>
                            <input type="radio" id="cepas" v-model="form.DEPENDENCIA" value="cepas" name="dependencia">
                            <label for="cepas">CEPAS</label>
                            <input type="radio" id="hogar_cristo" v-model="form.DEPENDENCIA" value="hogar_cristo" name="dependencia">
                            <label for="hogar_cristo">Hogar de Cristo</label>
                            <input type="radio" id="integra" v-model="form.DEPENDENCIA" value="integra" name="dependencia">
                            <label for="integra">Integra</label>
                            <input type="radio" id="coemco" v-model="form.DEPENDENCIA" value="coemco" name="dependencia">
                            <label for="coemco">Coemco</label>
                            <input type="radio" id="otro" v-model="form.DEPENDENCIA" value="otro" name="dependencia">
                            <label for="otro">Otro</label>
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
import {DateInput} from "@progress/kendo-vue-dateinputs";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import Urls from "../../common/json/Urls.json";
import AlertMessage from "../../common/json/AlertMessage.json";
import eventHub from "../../../eventHub";


export default {
    components: {
        Loading,
        MultiSelect,
        DateInput,
    },
    data: function () {
        return{
            submit:false,
            dsCarrera:[]

        }

    },
    computed: {
        form() {
            return this.$store.state.fichaAutogestion;
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

            if (keyword != null && keyword.length > 3) {
                //traer informacion del CENTRO PRACTICA
                console.log(keyword);
                console.log('traer informacion del Centro de práctica');
                this.getEstablecimiento(keyword)
            }
        },
        getEstablecimiento(id){
            let url = Urls["CENTRO_PRACTICAS"].GET+id;
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
