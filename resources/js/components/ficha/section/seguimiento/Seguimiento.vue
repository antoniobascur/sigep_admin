<template>
    <div>
        <div class="d-flex flex-row-reverse bd-highlight">

            <div class="p-2 bd-highlight">
                <button class="btn btn-primary" @click="onDialogFormNew">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Nueva
                </button>

            </div>
        </div>

        <div class="col-md-12">
            <Grid></Grid>
        </div>
        <kendo-window
            :ref="'form_nuevo'"
            :width="'70%'"
            :height="'auto'"
            :title="this.tituloKendoWindowsFormNuevo"
            :visible="false"
            :modal="true"
            :resizable= "true"
            style="display:none;"
            :scrollable="false"
            :actions="actions"
        >

            <FichaSeguimiento></FichaSeguimiento>

        </kendo-window>
    </div>

</template>

<script>
import FichaSeguimiento from "./form/fichaSeguimiento";
import HelpButton from "../../../common/HelpButton";
import Loading from "../../../common/Loading";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import {DateInput} from "@progress/kendo-vue-dateinputs";
import {KendoWindow} from "@progress/kendo-window-vue-wrapper";
import Grid from "./grid/Grid";
import {TabStrip} from "@progress/kendo-layout-vue-wrapper";
export default {
    components: {
        FichaSeguimiento,
        HelpButton,
        Loading,
        MultiSelect,
        DateInput,
        KendoWindow,
        Grid,
        TabStrip
    },
    data: function () {
        return {
            actions: ["Maximize", "Close"],
            loading: false,
            submit: false,
            tituloKendoWindowsFormNuevo: "NUEVA FICHA SEGUIMIENTO ",
            tituloKendoWindowsFormActualizar: "VER FICHA ",
            propsToPass: {
                titulo: "Ficha Practica",
                ayuda: "lorem ",
                element: "FICHA_SEGUIMIENTO",
            },
            dsRegiones: [],
            dsComunas: [],
            form: {
                EDITAR_FORMULARIO: false,
                OTRO: false

            }

        }
    },
    computed: {
        windowFormNuevo() {
            return this.$refs["form_nuevo"];
        },
    },

    methods: {
        resetForm() {

        },
        onDialogFormNew() {
            this.$nextTick(() => {
                this.windowFormNuevo.kendoWidget().center().open();
            });
        },

    },
}
</script>

<style scoped>

</style>
