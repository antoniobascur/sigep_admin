<template>
    <div>
        <h5>Nueva Visita Centro Práctica </h5>
        <ficha-visita></ficha-visita>
    </div>

</template>

<script>
import FichaVisita from "./form/fichaVisita";
import HelpButton from "../../../common/HelpButton";
import Loading from "../../../common/Loading";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import {DateInput} from "@progress/kendo-vue-dateinputs";
import {KendoWindow} from "@progress/kendo-window-vue-wrapper";
import Grid from "../../grid/Grid";
import {TabStrip} from "@progress/kendo-layout-vue-wrapper";
export default {
    components: {
        FichaVisita,
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
            tituloKendoWindowsFormNuevo: "NUEVA VISITA CENTRO ",
            tituloKendoWindowsFormActualizar: "VER FICHA ",
            propsToPass: {
                titulo: "Ficha Practica",
                ayuda: "lorem ",
                element: "FICHA_VISITA",
            },
            dsRegiones: [],
            dsComunas: [],
            form: {
                EDITAR_FORMULARIO: false,
                OTRO: false

            }

        }
    }
}
</script>

<style scoped>

</style>
