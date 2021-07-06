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
                                    Nuevo
                                </button>
                                <button class="btn btn-success" @click="onDialogFormUpdate">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Actualizar
                                </button>
                            </div>
                        </div>
                        <Grid></Grid>
                        <!--TODO:Contenido-->
                    </div>
                </div>
            </div>

            <kendo-window
                :ref="'form_nuevo'"
                :width="'80%'"
                :height="'auto'"
                :title="this.tituloKendoWindowsFormNuevo"
                :visible="false"
                :modal="true"
                style="display:none;"
                :scrollable="false"
                :actions="actions"
            >
                <H5>Seleccione Tipo de Ficha</H5>
                <div id="tipoficha" class="form-group col-md-12">
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="ADSCRIPCION" v-model="TIPO_FICHA" value="ADSCRIPCION" name="ADSCRIPCION">
                        <label class="required form-check-label font-weight-bold">&nbsp;&nbsp;Adscripción</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="AUTOGESTION" v-model="TIPO_FICHA" value="AUTOGESTION" name="AUTOGESTION">
                        <label for="AUTOGESTION" class="form-check-label font-weight-bold">&nbsp;&nbsp;Autogestión</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" id="CONTINUIDAD" v-model="TIPO_FICHA" value="CONTINUIDAD" name="CONTINUIDAD">
                        <label for="CONTINUIDAD" class="form-check-label font-weight-bold">&nbsp;&nbsp;Continuidad</label>
                    </div>

                </div>


                <div>
                    <div v-if="this.TIPO_FICHA!=null">
                        <hr>
                        <h3 class="text-center" >{{this.tituloKendoWindowsFormNuevo +'DE '+ this.TIPO_FICHA}}</h3>
                        <hr>
                    </div>


                    <ficha-adscripcion v-if="TIPO_FICHA=='ADSCRIPCION'"></ficha-adscripcion>

                    <ficha-autogestion v-if="TIPO_FICHA=='AUTOGESTION'"></ficha-autogestion>

                    <ficha-continuidad v-if="TIPO_FICHA=='CONTINUIDAD'"></ficha-continuidad>
                </div>



            </kendo-window>

        <kendo-window
            :ref="'form_actualizar'"
            :width="'80%'"
            :height="'auto'"
            :title="this.tituloKendoWindowsFormActualizar"
            :visible="false"
            :modal="true"
            style="display:none;"
            :scrollable="false"
            :actions="actions"
        >

            <div >

                <hr>
                <H5>Información Ficha: 1</H5>

                <div>
                    <ul id="progressbar" class="text-center">
                        <li class="active" id="step1"><div class="d-none d-md-block">STEP 1</div></li>
                        <li class="active" id="step2"><div class="d-none d-md-block">STEP 2</div></li>
                        <li class="" id="step3"><div class="d-none d-md-block">STEP 3</div></li>
                        <li class="" id="step4"><div class="d-none d-md-block">STEP 4</div></li>
                        <li class="" id="step5"><div class="d-none d-md-block">STEP 5</div></li>
                        <li class="" id="step6"><div class="d-none d-md-block">STEP 5</div></li>
                    </ul>
                </div>

                <hr>
            </div>



        <kendo-tabstrip>
            <ul>
                <li class="k-state-active" >
                    Ficha de Adscripción
                </li>
                <li>
                    Ficha Autogestion
                </li>
                <li>
                    Ficha Continuidad
                </li>
                <li>
                    Ficha Evaluacion
                </li>
            </ul>


            <div>
                <ficha-adscripcion></ficha-adscripcion>
            </div>
            <div>
                <ficha-autogestion></ficha-autogestion>
            </div>
            <div>
                <ficha-continuidad></ficha-continuidad>

            </div>

            <div>
                <ficha-evaluacion></ficha-evaluacion>
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
import Grid from "../ficha/grid/Grid";
import FichaAdscripcion from "./form/fichaAdscripcion";
import FichaEvaluacion from "./form/fichaEvaluacion";
import FichaContinuidad from "./form/fichaContinuidad";
import FichaAutogestion from "./form/fichaAutogestion";
import Regions from "../common/json/Regions.json";

export default {
    components: {
        FichaAutogestion,
        //   FichaContinuidad,
        FichaEvaluacion,
        FichaContinuidad,
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
            loading: false,
            submit: false,
            TIPO_FICHA: "ADSCRIPCION",
            tituloKendoWindowsFormNuevo:"NUEVA FICHA ",
            tituloKendoWindowsFormActualizar:"VER FICHA ",
            propsToPass: {
                titulo: "Ficha Practica",
                ayuda: "lorem ",
                element: "FICHA_ADSCRIPCION",
            },
            dsRegiones: [],
            dsComunas: [],
            form: {
                EDITAR_FORMULARIO: false,
                ADSCRIPCION:false,
                AUTOGESTION:false,
                CONTINUIDAD:false,
                OTRO:false

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
        onDialogFormUpdate(){
            this.$nextTick(() => {
                this.windowFormActualizar.kendoWidget().center().open();
            });
        }
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

