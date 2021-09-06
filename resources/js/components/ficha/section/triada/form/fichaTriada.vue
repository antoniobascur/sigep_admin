<template>
    <div>
        <form ID="form" class="modal-form" @submit.prevent="validate">
            <h4>Información Seminario Tríadico </h4>
            <div class="row">

                <div class="form-group col-md-3">
                    <label class="required">Fecha seminario</label>
                    <input
                        type="date"
                        class="form-control"
                        ID="FECHA_SEMINARIO"
                        name="FECHA_SEMINARIO"
                        v-model="form.FECHA_SEMINARIO"
                        placeholder=""
                        v-validate="'required'"
                        data-vv-as="FECHA_SEMINARIO"
                        :class="{'is-invalid': errors.has('FECHA_SEMINARIO')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('FECHA_SEMINARIO') }}</div>
                </div>
                <h5 class="col-md-12 mt-2">Asistentes</h5>
                <div class="col-md-12">

                    <editor :resizable-content="true"
                            :resizable-toolbar="true"
                            :value="htmlText"
                            style="height:80px"
                            rows="10"
                            cols="30"
                            :pdf="pdf"
                            v-model="form.ASISTENTES"

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
                <h5 class="col-md-12 mt-2">Principales temáticas</h5>
                <div class="col-md-12">

                    <editor :resizable-content="true"
                            :resizable-toolbar="true"
                            :value="htmlText"
                            style="height:80px"
                            rows="10"
                            cols="30"
                            :pdf="pdf"
                            v-model="form.TEMATICAS_TRIADA"

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

                <h5 class="col-md-12 mt-2">Reflexiones generaless</h5>
                <div class="col-md-12">

                    <editor :resizable-content="true"
                            :resizable-toolbar="true"
                            :value="htmlText"
                            style="height:80px"
                            rows="10"
                            cols="30"
                            :pdf="pdf"
                            v-model="form.REFLEXIONES_TRIADA"

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
            return this.$store.state.fichaTriadica;
        },
    },

    created: function () {

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



    }
}
</script>

<style scoped>

</style>
