<template>
    <div>

        <form ID="form" class="modal-form form-inline"  @submit.prevent="validate">

                <div class="form-group col-md-3">
                    <label class="required">FECHA</label>
                    <input
                        type="date"
                        class="form-control"
                        ID="FECHA_SEGUIMIENTO"
                        name="FECHA_SEGUIMIENTO"
                        v-model="form.FECHA_SEGUIMIENTO"
                        placeholder=""
                        v-validate="'required'"
                        data-vv-as="FECHA_SEGUIMIENTO"
                        :class="{'is-invalid': errors.has('FECHA_SEGUIMIENTO')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('FECHA_SEGUIMIENTO') }}</div>
                </div>

                <div class=" col-md-12">
                    <h4>Ámbitos	de	observación</h4>

                    <div class="form-group col-md-12">
                        <div  class="col-md-8" >
                            <label class="required text-left">Asiste con puntualidad</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Seguimiento_p1'"
                                class="form-control"
                                name="Seguimiento_p1"
                                v-model="form.Seguimiento_p1"
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
                            <label class="required text-left">Su presentación	personal es adecuada según las normas del establecimiento</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Seguimiento_p2'"
                                class="form-control"
                                name="Seguimiento_p2"
                                v-model="form.Seguimiento_p2"
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
                            <label class="required text-left">Se adapta a las normas del centro de practica</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Seguimiento_p2'"
                                class="form-control"
                                name="Seguimiento_p2"
                                v-model="form.Seguimiento_p2"
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
                            <label class="required text-left">Informa de sus tareas y responsabilidades como practicante</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Seguimiento_p3'"
                                class="form-control"
                                name="Seguimiento_p3"
                                v-model="form.Seguimiento_p3"
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
                            <label class="required text-left">Informa	de manera oportuna y formal	su ausencia	en el centro de	práctica</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Seguimiento_p4'"
                                class="form-control"
                                name="Seguimiento_p4"
                                v-model="form.Seguimiento_p4"
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
                            <label class="required text-left">Respalda con la	debida documentación su	ausencia en	el centro práctica</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Seguimiento_p5'"
                                class="form-control"
                                name="Seguimiento_p5"
                                v-model="form.Seguimiento_p5"
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
                            <label class="required text-left">Mantiene buenas	relaciones con docentes	de aula, directivos	y asistentes de	la educación</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Seguimiento_p6'"
                                class="form-control"
                                name="Seguimiento_p6"
                                v-model="form.Seguimiento_p6"
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
                            <label class="required text-left">Demuestra empatía y	se relaciona adecuadamente con las alumnas y los alumnos</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Seguimiento_p7'"
                                class="form-control"
                                name="Seguimiento_p7"
                                v-model="form.Seguimiento_p7"
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
                            <label class="required text-left">Manifiesta disposición hacia el	trabajo	colaborativo y en equipo</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Seguimiento_p8'"
                                class="form-control"
                                name="Seguimiento_p8"
                                v-model="form.Seguimiento_p8"
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
                            <label class="required text-left">Realiza	responsablemente las tareas	encomendadas</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Seguimiento_p9'"
                                class="form-control"
                                name="Seguimiento_p9"
                                v-model="form.Seguimiento_p9"
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
                            <label class="required text-left">Demuestra iniciativa y proactividad</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Seguimiento_p10'"
                                class="form-control"
                                name="Seguimiento_p10"
                                v-model="form.Seguimiento_p10"
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
                            <label class="required text-left">Recepciona las valoraciones y las críticas en forma positiva</label><br>

                        </div>
                        <div class="col-md-4">
                            <kendo-dropdownlist
                                :ref="'Seguimiento_p11'"
                                class="form-control"
                                name="Seguimiento_p11"
                                v-model="form.Seguimiento_p11"
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
                                v-model="form.Seguimiento_p12"

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

                    <h5 class="col-md-12 mt-2">Aspectos a mejorar</h5>
                    <div class="col-md-12">

                        <editor :resizable-content="true"
                                :resizable-toolbar="true"
                                :value="htmlText"
                                style="height:80px"
                                rows="10"
                                cols="30"
                                :pdf="pdf"
                                v-model="form.Seguimiento_p13"

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
            dsCarrera:[]

        }

    },
    computed: {
        form() {
            return this.$store.state.fichaSeguimiento;
        },
    },

    created: function () {
        this.getOpcionesEvaluacion();
    },
    methods: {

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
        getOpcionesEvaluacion(){
            this.dsOpcionesEvaluacion=OpcionesEvaluacion.OpcionesEvaluacion;
        },

    }
}
</script>
<style scoped>
label { float: left!important; }
</style>
