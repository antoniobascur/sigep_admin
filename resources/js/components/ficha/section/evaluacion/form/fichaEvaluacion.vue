<template>
    <div>
        <form ID="form" class="modal-form form-inline" @submit.prevent="validate">
            <hr>
            <div class="row">

                   <h4 class="col-md-12">Evaluación a el/la Educador(a) o Profesor(a) Colaborador(a) del	establecimiento</h4>
                   <div class="form-group col-md-12">
                       <div  class="col-md-8" >
                           <label class="required text-left">El o la educador (a) /profesor (a) manifiesta compromiso ético y formativo en su rol de colaborador (a).
                           </label><br>
                       </div>
                       <div class="col-md-4">
                           <kendo-dropdownlist
                               :ref="'Evaluacion_p1'"
                               class="form-control"
                               name="Evaluacion_p1"
                               v-model="form.Evaluacion_p1"
                               :data-source="dsOpcionesEvaluacion"
                               :data-text-field="'name'"
                               :data-value-field="'name'"
                               :optionLabel="'Seleccione'"
                               :filter="'contains'"
                               :class="{'is-invalid': errors.has('dsOpcionesEvaluacion')}"
                           ></kendo-dropdownlist>
                       </div>
                   </div>
                    <div class="form-group col-md-12">
                        <div  class="col-md-8" >
                            <label class="required text-left">El o la educador (a) /profesor (a) colaborador (a) genera un ambiente facilitador para promover mi reflexión pedagógica.
                            </label><br>
                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Evaluacion_p2'"
                                class="form-control"
                                name="Evaluacion_p2"
                                v-model="form.Evaluacion_p2"
                                :data-source="dsOpcionesEvaluacion"
                                :data-text-field="'name'"
                                :data-value-field="'name'"
                                :optionLabel="'Seleccione'"
                                :filter="'contains'"
                                :class="{'is-invalid': errors.has('dsOpcionesEvaluacion')}"
                            ></kendo-dropdownlist>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div  class="col-md-8" >
                            <label class="required text-left">El o la educador (a) /profesor (a) me guía en el diseño, implementación y evaluación de propuestas pedagógicas pertinentes a los y las estudiantes y al contexto
                            </label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Evaluacion_p3'"
                                class="form-control"
                                name="Evaluacion_p3"
                                v-model="form.Evaluacion_p3"
                                :data-source="dsOpcionesEvaluacion"
                                :data-text-field="'name'"
                                :data-value-field="'name'"
                                :optionLabel="'Seleccione'"
                                :filter="'contains'"
                                :class="{'is-invalid': errors.has('dsOpcionesEvaluacion')}"
                            ></kendo-dropdownlist>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div  class="col-md-8" >
                            <label class="required text-left">El o la educador (a) /profesor (a) me guía en el proceso de autoevaluación de mi propio desempeño pedagógico.
                            </label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Evaluacion_p4'"
                                class="form-control"
                                name="Evaluacion_p4"
                                v-model="form.Evaluacion_p4"
                                :data-source="dsOpcionesEvaluacion"
                                :data-text-field="'name'"
                                :data-value-field="'name'"
                                :optionLabel="'Seleccione'"
                                :filter="'contains'"
                                :class="{'is-invalid': errors.has('dsOpcionesEvaluacion')}"
                            ></kendo-dropdownlist>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div  class="col-md-8 " >
                            <label class="required text-left">El o la educador (a) /profesor (a) me realiza observaciones y sugerencias para mejorar mi desempeño docente.
                            </label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Evaluacion_p5'"
                                class="form-control"
                                name="Evaluacion_p5"
                                v-model="form.Evaluacion_p5"
                                :data-source="dsOpcionesEvaluacion"
                                :data-text-field="'name'"
                                :data-value-field="'name'"
                                :optionLabel="'Seleccione'"
                                :filter="'contains'"
                                :class="{'is-invalid': errors.has('dsOpcionesEvaluacion')}"
                            ></kendo-dropdownlist>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div  class="col-md-8" >
                            <label class="required text-left">El o la educador (a) /profesor (a) colaborador (a) reflexiona sobre el alcance que tales observaciones y sugerencias han tenido en mi práctica.
                            </label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Evaluacion_p6'"
                                class="form-control"
                                name="Evaluacion_p6"
                                v-model="form.Evaluacion_p6"
                                :data-source="dsOpcionesEvaluacion"
                                :data-text-field="'name'"
                                :data-value-field="'name'"
                                :optionLabel="'Seleccione'"
                                :filter="'contains'"
                                :class="{'is-invalid': errors.has('dsOpcionesEvaluacion')}"
                            ></kendo-dropdownlist>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div  class="col-md-8" >
                            <label class="required text-left">El o la educador (a) /profesor (a) colaborador (a )se preocupa por integrarme en las distintas actividades del establecimiento educacional y de su comunidad.
                            </label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Evaluacion_p7'"
                                class="form-control"
                                name="Evaluacion_p7"
                                v-model="form.Evaluacion_p7"
                                :data-source="dsOpcionesEvaluacion"
                                :data-text-field="'name'"
                                :data-value-field="'name'"
                                :optionLabel="'Seleccione'"
                                :filter="'contains'"
                                :class="{'is-invalid': errors.has('dsOpcionesEvaluacion')}"
                            ></kendo-dropdownlist>
                        </div>
                    </div>

                <br>
                    <h4 class="col-md-12 mt-2">Evaluación al centro de	práctica</h4>
                    <div class="form-group col-md-12">
                        <div  class="col-md-8" >
                            <label class="required text-left">El centro de práctica y su equipo profesional, han favorecido mi integración al nuevo contexto educativo</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Evaluacion_p9'"
                                class="form-control"
                                name="Evaluacion_p9"
                                v-model="form.Evaluacion_p9"
                                :data-source="dsOpcionesEvaluacion"
                                :data-text-field="'name'"
                                :data-value-field="'name'"
                                :optionLabel="'Seleccione'"
                                :filter="'contains'"
                                :class="{'is-invalid': errors.has('dsOpcionesEvaluacion')}"
                            ></kendo-dropdownlist>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div  class="col-md-8" >
                            <label class="required text-left">El centro de práctica constituye un espacio adecuado de gestión y formación para mi aprendizaje	como futuro	profesor</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Evaluacion_p10'"
                                class="form-control"
                                name="Evaluacion_p10"
                                v-model="form.Evaluacion_p10"
                                :data-source="dsOpcionesEvaluacion"
                                :data-text-field="'name'"
                                :data-value-field="'name'"
                                :optionLabel="'Seleccione'"
                                :filter="'contains'"
                                :class="{'is-invalid': errors.has('dsOpcionesEvaluacion')}"
                            ></kendo-dropdownlist>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <div  class="col-md-8" >
                            <label class="required text-left">El centro de práctica me permite desarrollar la	colaboración, intervenciones pedagógicas y/u otras actividades	exigidas por la	universidad</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Evaluacion_p11'"
                                class="form-control"
                                name="Evaluacion_p11"
                                v-model="form.Evaluacion_p11"
                                :data-source="dsOpcionesEvaluacion"
                                :data-text-field="'name'"
                                :data-value-field="'name'"
                                :optionLabel="'Seleccione'"
                                :filter="'contains'"
                                :class="{'is-invalid': errors.has('dsOpcionesEvaluacion')}"
                            ></kendo-dropdownlist>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div  class="col-md-8" >
                            <label class="required text-left">El centro de práctica respeta mis tiempos destinados por la	universidad, a las tareas propias del nivel	de práctica	que	desarrollo</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Evaluacion_p12'"
                                class="form-control"
                                name="Evaluacion_p12"
                                v-model="form.Evaluacion_p12"
                                :data-source="dsOpcionesEvaluacion"
                                :data-text-field="'name'"
                                :data-value-field="'name'"
                                :optionLabel="'Seleccione'"
                                :filter="'contains'"
                                :class="{'is-invalid': errors.has('dsOpcionesEvaluacion')}"
                            ></kendo-dropdownlist>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div  class="col-md-8 text-left" >
                            <label class="required text-left">Los	alumnos del	centro de práctica al que asisto se	involucran en las actividades que realizo</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Evaluacion_p13'"
                                class="form-control"
                                name="Evaluacion_p13"
                                v-model="form.Evaluacion_p13"
                                :data-source="dsOpcionesEvaluacion"
                                :data-text-field="'name'"
                                :data-value-field="'name'"
                                :optionLabel="'Seleccione'"
                                :filter="'contains'"
                                :class="{'is-invalid': errors.has('dsOpcionesEvaluacion')}"
                            ></kendo-dropdownlist>
                        </div>
                    </div>

                <h5 class="col-md-12 mt-2">Comentarios</h5>
            <div class="col-md-12">

                <editor :resizable-content="true"
                        :resizable-toolbar="true"
                        :value="htmlText"
                        style="height:80px"
                        rows="10"
                        cols="30"
                        :pdf="pdf"
                        v-model="form.Evaluacion_p14"

                >
                    <!--                    <editor-tool :name="'fontName'"></editor-tool>-->
                    <editor-tool :name="'fontSize'"></editor-tool>

                    <editor-tool :name="'bold'"></editor-tool>
                    <editor-tool :name="'italic'"></editor-tool>
                    <editor-tool :name="'underline'"></editor-tool>

                    <editor-tool :name="'insertUnorderedList'"></editor-tool>
                    <editor-tool :name="'insertOrderedList'"></editor-tool>
                    <editor-tool :name="'indent'"></editor-tool>
                    <editor-tool :name="'outdent'"></editor-tool>

                    <editor-tool :name="'justifyLeft'"></editor-tool>
                    <editor-tool :name="'justifyCenter'"></editor-tool>
                    <editor-tool :name="'justifyRight'"></editor-tool>
                    <editor-tool :name="'justifyFull'"></editor-tool>

                    <editor-tool :name="'viewHtml'"></editor-tool>
                    <editor-tool :name="'pdf'"></editor-tool>

                </editor>
                <br>
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

import {DateInput} from "@progress/kendo-vue-dateinputs";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import Urls from "../../../../common/json/Urls.json";
import AlertMessage from "../../../../common/json/AlertMessage.json";
import eventHub from "../../../../../eventHub";
import OpcionesEvaluacion from "../../../../common/json/OpcionesEvaluacion.json";
import { Editor, EditorTool } from '@progress/kendo-editor-vue-wrapper';


export default {
    components: {
        Editor,
        MultiSelect,
        DateInput,
    },
    data: function () {
        return{
            submit:false,
            dsOpcionesEvaluacion:[]

        }

    },
    computed: {
        form() {
            return this.$store.state.fichaEvaluacion;
        },
    },
    created: function () {
        this.getOpcionesEvaluacion();
    },
    methods: {
        getOpcionesEvaluacion(){
            this.dsOpcionesEvaluacion=OpcionesEvaluacion.OpcionesEvaluacion;
        },
        resetForm() {
            this.form.ID = 0;
            this.form.RUT = null;
            this.form.NOMBRE = null;
            this.form.CENTRO_PRACTICA = false;
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




    }
}
</script>

<style scoped>
label { float: left!important; }
</style>
