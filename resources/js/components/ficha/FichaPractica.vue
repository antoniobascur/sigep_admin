<template>

    <kendo-tabstrip>
        <ul>
            <li class="k-state-active">
                Ficha de Adscripción
            </li>
            <li>
                Two
            </li>
            <li>
                Three
            </li>
        </ul>
        <div>
            <ficha-adscripcion></ficha-adscripcion>
        </div>
        <div>
            <ficha-evaluacion></ficha-evaluacion>
        </div>
        <div>
        </div>
    </kendo-tabstrip>

</template>

<script>
import { TabStrip } from '@progress/kendo-layout-vue-wrapper';
import HelpButton from "../common/HelpButton";
import Loading from "../common/Loading";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import {DateInput} from "@progress/kendo-vue-dateinputs";
import {KendoWindow} from "@progress/kendo-window-vue-wrapper";
import Grid from "../centroPractica/grid/Grid";
import fichaAdscripcion from "./form/fichaAdscripcion";
import fichaEvaluacion from "./form/fichaEvaluacion";
import FichaAdscripcion from "./form/fichaAdscripcion";
import FichaEvaluacion from "./form/fichaEvaluacion";
export default {
    components: {
        FichaEvaluacion,
        FichaAdscripcion,
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
            loading: true,
            submit: false,
            propsToPass: {
                titulo: "Centros de practicas",
                ayuda: "lorem ",
                element: "CENTRO_PRACTICAS",
            },
            dsRegiones: [],
            dsComunas: [],

        }
    }
}
</script>

