<template>
    <div class="container-fluid">
        <loading v-if="loading"/>
        <div class="row">
            <div class="col">
                <div
                    class="card shadow-sm border-2 border-right-0 border-bottom-0 border-left-0 border-danger"
                >
                    <div class="card-body pt-2">
                        <div class="d-flex">
                            <div class="p-2">
                                <h4>{{ propsToPass.titulo }}</h4>
                            </div>
                            <div class="ml-auto p-2">
                                <help-button v-bind:element="propsToPass.element"/>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse bd-highlight">

                            <div class="p-2 bd-highlight">
                                <button class="btn btn-primary" @click="onDialogFormNew">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Nuevo
                                </button>

                            </div>
                        </div>
                        <!-- CUERPO-->
                        <hr>
                        <H5>Ejemplo calendario</H5>
                        <div class="row">


                        <div class="col-md-12">

                        </div>

                        </div>
                        <!-- CUERPO-->
                    </div>
                </div>
            </div>
        </div>

        <kendo-window
            :ref="'form_programacion'"
            :width="'80%'"
            :height="'auto'"
            :title="this.tituloKendoWindowsFormNuevo"
            :visible="false"
            :modal="true"
            style="display:none;"
            :scrollable="false"
            :actions="actions"
        >
            <ficha-programacion></ficha-programacion>
        </kendo-window>
    </div>
</template>

<script>

import {KendoWindow} from "@progress/kendo-window-vue-wrapper";
import HelpButton from "../common/HelpButton";
import FichaProgramacion from "./form/fichaProgramacion";
export default {
    components: {
        FichaProgramacion,
        HelpButton,
        KendoWindow,
    },
    computed: {
        windowFormNuevo() {
            return this.$refs["form_programacion"];
        }
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
    data: function () {
        return {
            actions: ["Maximize", "Close"],
            tituloKendoWindowsFormNuevo:"NUEVA PROGRAMACIÓN ",
            loading: false,
            propsToPass: {
                titulo: "Programación Practica",
                ayuda: "lorem ",
                element: "PROGRAMACION_PRACTICA",
            },
        }}

}
</script>

