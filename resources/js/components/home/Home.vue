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
                        <!-- CUERPO-->
                        <hr>

                        <div class="row">
                            <div class="col-md-3">
                                <label class="required">Año </label>

                                <kendo-dropdownlist
                                    :ref="'ANIO'"
                                    class="form-control"
                                    name="ANIO"
                                    v-model="filtro.ANIO"
                                    :data-source="dsAnio"
                                    :data-text-field="'ANIO'"
                                    :data-value-field="'ANIO'"
                                    :optionLabel="'Seleccione'"
                                    :filter="'contains'"
                                    :class="{'is-invalid': errors.has('dsAnio')}"
                                ></kendo-dropdownlist>

                            </div>
                            <div class="col-md-3">
                                <label class="required">Carrera </label>

                                <kendo-dropdownlist
                                    :ref="'CARRERA'"
                                    class="form-control"
                                    name="CARRERA"
                                    v-model="filtro.CARRERA"
                                    :data-source="dsCarrera"
                                    :data-text-field="'CARRERA'"
                                    :data-value-field="'UA'"
                                    :optionLabel="'Seleccione'"
                                    :filter="'contains'"
                                    :class="{'is-invalid': errors.has('dsCarrera')}"
                                ></kendo-dropdownlist>

                            </div>
                            <div class="col-md-3">
                                <label class="required">Nivel </label>

                                <kendo-dropdownlist
                                    :ref="'NIVEL'"
                                    class="form-control"
                                    name="NIVEL"
                                    v-model="filtro.NIVEL"
                                    :data-source="dsNivel"
                                    :data-text-field="'NIVEL'"
                                    :data-value-field="'NIVEL'"
                                    :optionLabel="'Seleccione'"
                                    :filter="'contains'"
                                    :class="{'is-invalid': errors.has('dsNivel')}"
                                ></kendo-dropdownlist>

                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary" >
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Filtrar
                                </button>
                            </div>

                        </div>
                        <br>
                        <H5>Información del estado de practicas</H5>
                    <div>
                        <StepByStep :dsSteps="this.arrayStep"></StepByStep>
                    </div>
                        <hr>
                        <!-- CUERPO-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Loading from "../common/Loading";
import HelpButton from "../common/HelpButton";
import StepByStep from "../common/StepByStep";
    export default {
        components: {
            HelpButton,
            Loading,
            StepByStep
        },
        data: function () {
            return {
                arrayStep: [
                    {"id": 1,"name": "step1","state":"active"},
                    {"id": 2,"name": "step2","state":"active"},
                    {"id": 3,"name": "step3","state":"active"},
                    {"id": 4,"name": "step4","state":"active"},
                    {"id": 5,"name": "step5","state":""},
                    {"id": 6,"name": "step6","state":""},
                ],
                loading: true,
                propsToPass: {
                    titulo: "Home Principal",
                    ayuda: "lorem ",
                    element: "HOME",
                },
                filtro:{
                    ANIO: null,
                    CARRERA: null,
                    NIVEL: null
                },
                dsAnio:[],
                dsCarrera:[],
                dsNivel:[]
            }
    },
        created: function () {
            this.loading = false;
        }
    }
</script>


