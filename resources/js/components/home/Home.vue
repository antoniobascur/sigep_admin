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
                            <ul id="progressbar" class="text-center">
                                <li class="active" id="step1"><div class="d-none d-md-block">Especificidades de las prácticas</div></li>
                                <li class="active" id="step2"><div class="d-none d-md-block">Calendario Semestral</div></li>
                                <li class="active" id="step3"><div class="d-none d-md-block">Proceso Autogestión / Continuidad</div></li>
                                <li class="" id="step4"><div class="d-none d-md-block">Visita Centro Práctica</div></li>
                                <li class="" id="step5"><div class="d-none d-md-block">Asignación y Adscripción</div></li>
                                <li class="" id="step6"><div class="d-none d-md-block">Carta de presentación</div></li>
                            </ul>
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
    export default {
        components: {
            HelpButton,
            Loading,
        },
        data: function () {
            return {
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
    background: red!important;
    background-color: red!important;
}
</style>
