<template>
    <div>
        <kendo-grid
            ref="Grid"
            :data-source="dsData"
            :scrollable="false"
            :pageable="pageable"
            :skip="skip"
            :take="take"
            :total="total"
            :columnMenu="true"
            :filterable="true"
            :sortable="true"
            :no-records-template="noRecordsTemplate"
            @pagechange="pageChangeHandler"
        >
            <kendo-grid-column field="ID" title="<b>ID</b>"></kendo-grid-column>
            <kendo-grid-column field="ANIO" title="<b>ANIO</b>"></kendo-grid-column>
            <kendo-grid-column field="PERIODO" title="<b>PERIODO</b>"></kendo-grid-column>
            <kendo-grid-column field="CARRERA" title="<b>CARRERA</b>"></kendo-grid-column>
            <kendo-grid-column field="NIVEL_PRACTICA" title="<b>NIVEL_PRACTICA</b>" ></kendo-grid-column>
            <kendo-grid-column field="TIPO_PRACTICA" title="<b>TIPO_PRACTICA</b>"></kendo-grid-column>
            <kendo-grid-column field="CUPOS" title="<b>CUPOS</b>" :template="cuposTemplate"></kendo-grid-column>
            <kendo-grid-column field="ESTADO" title="<b>ESTADO</b>" :template="estadoTemplate"></kendo-grid-column>
            <kendo-grid-column title="<b>Acciones</b>" :template="actionsTemplate" :width="70"></kendo-grid-column>
        </kendo-grid>
    </div>
</template>

<script>
import {Grid} from "@progress/kendo-grid-vue-wrapper";
import OptionsGrid from "./OptionsGrid";
import CuposGrid from "./CuposGrid";
import EstadoGrid from "./EstadoGrid";
import eventHub from "../../../eventHub";
import NoRecords from "../../common/NoRecords";
import Urls from "../../common/json/Urls.json";
export default {
    components: {
        Grid,
    },
    data: function () {
        return {
            propsToPass: {
                titulo: "Programación de practicas",
                ayuda: "lorem ",
                element: "PROGRAMACION_PRACTICA",
            },
            pageable: {
                pageSize: 10,
                buttonCount: 3,
            },
            skip: 0,
            take: 10
        }
    },
    computed: {
        dsProgramacionPracticas() {
            return this.$store.state.dsProgramacionPracticas;
        },
        dsData: {
            get() {
                return this.$store.state.dsProgramacionPracticas.data;
            },
            set(val) {
                this.$store.state.dsProgramacionPracticas.data = val;
            },
        },

        total() {
            return this.dataItems ? this.dataItems.length : 0;
        },
    },
    methods: {
        getData() {
            eventHub.$emit("LoadingOff",{obj:true});
            let url = Urls[this.propsToPass.element].GET_ALL;
            axios
                .get(url, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": window.csrf_token,
                    },
                })
                .then((response) => {
                    //console.log(response.data.data);
                    if (response.data.data.length > 0) {
                        this.$store.state.dsProgramacionPracticas.data = response.data.data;
                    }
                    eventHub.$emit("LoadingOff",{obj:false});
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {


                });
        },
        pageChangeHandler: function (event) {
            this.skip = event.page.skip;
            this.take = event.page.take;

        },
        estadoTemplate(e){

            return {
                template: Vue.component("estados", EstadoGrid),
                templateArgs: e,
            };
        },
        cuposTemplate(e) {
            return {
                template: Vue.component("cupos", CuposGrid),
                templateArgs: e,
            };
        },
        actionsTemplate(e) {
            return {
                template: Vue.component("actions", OptionsGrid),
                templateArgs: e,
            };
        },
        noRecordsTemplate(e) {
            return {
                template: Vue.component("no-records", NoRecords),
            };
        },
    },
    created() {
        this.getData();

        eventHub.$on("updateToGrid", (data) => {
            this.getData();
        });
    },
    beforeDestroy() {
        eventHub.$off("updateToGrid");

    },
}
</script>

<style scoped>

</style>
