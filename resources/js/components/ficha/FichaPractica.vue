<template>
    <!--<div>
          <H5>Seleccione Tipo de ficha</H5>
          <div id="tipoficha" class="form-group col-md-12" >
              <label class="required">Adscripción</label><br>
              <input type="radio" id="ADSCRIPCION" v-model="TIPO_FICHA" value="ADSCRIPCION" name="ADSCRIPCION">
              <label for="AUTOGESTION">Autogestión</label>
              <input type="radio" id="AUTOGESTION"v-model="TIPO_FICHA"  value="AUTOGESTION" name="AUTOGESTION">
            <label for="CONTINUIDAD">Continuidad</label>
              <input type="radio" id="CONTINUIDAD"v-model="TIPO_FICHA"  value="CONTINUIDAD" name="CONTINUIDAD">

      </div>
-->

    <kendo-tabstrip>
        <ul>
            <li class="k-state-active" > <!--v-else-if="TIPO_FICHA === 'ADSCRIPCION'">-->

                Ficha de Adscripción
            </li>
            <li>
                Ficha Autogestion
            </li>
            <li>
                Ficha Continuidad
            </li>
        </ul>


        <div>
            <ficha-adscripcion></ficha-adscripcion>
        </div>

        <div>
           <ficha-evaluacion></ficha-evaluacion>
        </div>

        <div>
        <!--    <ficha-continuidad></ficha-continuidad>
        -->
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
import FichaAdscripcion from "./form/fichaAdscripcion";
import FichaEvaluacion from "./form/fichaEvaluacion";
//import FichaContinuidad from "./form/fichaContinuidad";

//import FichaAutogestion from "./form/fichaAutogestion";

export default {
    components: {
     //   FichaContinuidad,
        FichaEvaluacion,
//      FichaAutogestion,
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
            TIPO_FICHA: null,
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

