<template>
  <div>
    <h5>Nueva Ficha Evaluación </h5>
    <FichaEvaluacion></FichaEvaluacion>
  </div>

</template>

<script>
import FichaEvaluacion from "./form/fichaEvaluacion";
import HelpButton from "../../../common/HelpButton";
import Loading from "../../../common/Loading";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import {DateInput} from "@progress/kendo-vue-dateinputs";
import {KendoWindow} from "@progress/kendo-window-vue-wrapper";
import Grid from "../../grid/Grid";
import {TabStrip} from "@progress/kendo-layout-vue-wrapper";
export default {
  components: {
    FichaEvaluacion,
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
      tituloKendoWindowsFormNuevo: "NUEVA FICHA EVALUACION ",
      tituloKendoWindowsFormActualizar: "VER FICHA ",
      propsToPass: {
        titulo: "Ficha Practica",
        ayuda: "lorem ",
        element: "FICHA_EVALUACION",
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


