<template>
    <div class="container-fluid">
        <loading v-if="loading"/>
        <div class="row">
            <div class="col">
                <div class="card shadow-sm border-2 border-right-0 border-bottom-0 border-left-0 border-danger">
                    <div class="card-body pt-2">
                        <!--TODO:Header-->
                        <div class="d-flex">
                            <div class="p-2">
                                <h4>{{ propsToPass.titulo }}</h4>
                            </div>
                            <div class="ml-auto p-2">
                                <help-button v-bind:element="propsToPass.element"/>
                            </div>
                        </div>
                        <!--TODO:Header-->
                        <!--TODO:Contenido-->
                        <div class="d-flex flex-row-reverse bd-highlight">

                            <div class="p-2 bd-highlight">
                                <button class="btn btn-primary" @click="onDialogFormNew">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Nueva Ficha
                                </button>

                            </div>
                        </div>
                    <Grid></Grid>
                        <!--TODO:Contenido-->
                    </div>
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

                    <Principal></Principal>

                </kendo-window>
            </div>

            <kendo-window
                :ref="'form_actualizar'"
                :width="'70%'"
                :height="'auto'"
                :title="this.tituloKendoWindowsFormActualizar"
                :visible="false"
                :modal="true"
                style="display:none;"
                :scrollable="false"
                :actions="actions"
            >
                <H5>Información Ficha: {{this.form.ID }}</h5>
                <!--          <div>

                            <div>
                                 <ul id="progressbar" class="text-center">
                                     <li class="active" id="step1">
                                         <div class="d-none d-md-block">STEP 1</div>
                                     </li>
                                     <li class="active" id="step2">
                                         <div class="d-none d-md-block">STEP 2</div>
                                     </li>
                                     <li class="" id="step3">
                                         <div class="d-none d-md-block">STEP 3</div>
                                     </li>
                                     <li class="" id="step4">
                                         <div class="d-none d-md-block">STEP 4</div>
                                     </li>
                                     <li class="" id="step5">
                                         <div class="d-none d-md-block">STEP 5</div>
                                     </li>
                                     <li class="" id="step6">
                                         <div class="d-none d-md-block">STEP 5</div>
                                     </li>
                                 </ul>
                             </div>

                    <hr>
                </div>-->
                <kendo-tabstrip>
                    <ul>
                        <li class="k-state-active">Ficha Visita Centro Práctica</li>
                        <li>Ficha Tríada Informativa</li>
                        <li>Ficha Seguimiento</li>
                        <li>Ficha Evaluación</li>
                        <li>Control de Asistencia</li>
                    </ul>
                    <div>
                        <VisitaCentro></VisitaCentro>
                    </div>
                    <div>
                        <Triada></Triada>

                    </div>
                    <div>
                        <Seguimiento></Seguimiento>
                    </div>
                     <div>
                         <Evaluacion></Evaluacion>
                     </div>
                    <div>
                        <Asistencia></Asistencia>
                    </div>
                </kendo-tabstrip>

            </kendo-window>
        </div>
    </div>
</template>

<script>
import {TabStrip} from '@progress/kendo-layout-vue-wrapper';
import HelpButton from "../common/HelpButton";
import Loading from "../common/Loading";
import {MultiSelect} from "@progress/kendo-dropdowns-vue-wrapper";
import {DateInput} from "@progress/kendo-vue-dateinputs";
import {KendoWindow} from "@progress/kendo-window-vue-wrapper";
import Grid from "./grid/Grid";



import Regions from "../common/json/Regions.json";
import VisitaCentro from "./section/visitaCentro/VisitaCentro";
import Triada from "./section/triada/Triada";
import Seguimiento from "./section/seguimiento/Seguimiento";
import Evaluacion from "./section/evaluacion/Evaluacion";
import Principal from "./section/principal/Principal";
import Asistencia from "./section/controlAsistencia/Asistencia";
import eventHub from "../../eventHub";

export default {
    components: {
        Principal,
        Asistencia,
        Seguimiento,
        Triada,
        VisitaCentro,
        Evaluacion,
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
            TIPO_FICHA: "ADSCRIPCION",
            tituloKendoWindowsFormNuevo: "NUEVA FICHA ",
            tituloKendoWindowsFormActualizar: "VER FICHA ",
            propsToPass: {
                titulo: "Ficha Practica",
                ayuda: "lorem ",
                element: "FICHA_PRACTICA",
            },
            dsRegiones: [],
            dsComunas: [],
            form: {
                EDITAR_FORMULARIO: false,
                ADSCRIPCION: false,
                AUTOGESTION: false,
                CONTINUIDAD: false,
                OTRO: false

            }

        }
    },
    computed: {
        windowFormNuevo() {
            return this.$refs["form_nuevo"];
        },
        windowFormActualizar() {
            return this.$refs["form_actualizar"];
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
        onDialogFormUpdate() {
            this.$nextTick(() => {
                this.windowFormActualizar.kendoWidget().center().open();
            });
        }
    },
    created: function () {
        eventHub.$on("closeKendoWindows", () => {
            this.windowFormNuevo.kendoWidget().close();
            this.windowFormActualizar.kendoWidget().close();
        });
        eventHub.$on("LoadingOff", (data) => {

            this.loading = data.obj;
        });
        eventHub.$on("onOpenFichas", (data) => {

            this.form.ID = data.obj.ID;


           // this.getDataCupos(data.obj.ID);
            this.form.EDITAR_FORMULARIO = true;

            console.log("se hizo click");
            this.tituloKendoWindowsFormNuevo="EDITAR CUPO";

            this.$nextTick(() => {
                this.windowFormActualizar.kendoWidget().center().open();

            });


        });
    }
}
</script>

<style>
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: #455A64;
    padding-left: 0px;
    margin-top: 30px
}

#progressbar li {
    list-style-type: none;
    width: 16.66%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar #step1:before {
    content: "1";
}

#progressbar #step2:before {
    content: "2";
}

#progressbar #step3:before {
    content: "3";
}

#progressbar #step4:before {
    content: "4";
}

#progressbar #step5:before {
    content: "5";
}

#progressbar #step6:before {
    content: "6";
}

#progressbar li:before {
    width: 40px;
    height: 40px;
    line-height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    background: #455A64;
    border-radius: 50%;
    margin: auto;
    color: #fff;
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: #455A64;
    position: absolute;
    left: 0;
    top: 21px;
    z-index: -1
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    position: absolute;
    left: -50%
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    position: absolute;
    left: 50%
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: red
}
</style>

