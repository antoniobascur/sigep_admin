<template>
    <div>
        <h5>Nueva Tríada </h5>
        <FichaTriada></FichaTriada>
    </div>

</template>

<script>
import FichaTriada from "./form/fichaTriada";
import HelpButton from "../../../common/HelpButton";
import Loading from "../../../common/Loading";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import {DateInput} from "@progress/kendo-vue-dateinputs";
import {KendoWindow} from "@progress/kendo-window-vue-wrapper";
import Grid from "../../grid/Grid";
import {TabStrip} from "@progress/kendo-layout-vue-wrapper";
export default {
    components: {
        FichaTriada,
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
                element: "FICHA_TRIADA",
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
