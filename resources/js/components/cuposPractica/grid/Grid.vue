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
        <kendo-grid-column field="MODALIDAD" title="<b>MODALIDAD</b>" :template="modalidadTemplate"></kendo-grid-column>
        <kendo-grid-column field="RBD_CENTRO_PRACTICA" title="<b>RBD_CENTRO_PRACTICA</b>"></kendo-grid-column>
        <kendo-grid-column field="TIPO_PRACTICA" title="<b>TIPO_PRACTICA</b>"></kendo-grid-column>
        <kendo-grid-column field="ESTADO" title="<b>ESTADO</b>"></kendo-grid-column>
        <kendo-grid-column title="<b>Acciones</b>" :template="actionsTemplate" :width="70"></kendo-grid-column>
    </kendo-grid>
</div>
</template>

<script>
import {Grid} from "@progress/kendo-grid-vue-wrapper";
import OptionsGrid from "./OptionsGrid";
import ModalidadGrid from "./ModalidadGrid";
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
                titulo: "Centros de practicas",
                ayuda: "lorem ",
                element: "CUPOS_PRACTICA",
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
        dsCuposPracticas() {
            return this.$store.state.dsCuposPracticas;
        },
        dsData: {
            get() {
                return this.$store.state.dsCuposPracticas.data;
            },
            set(val) {
                this.$store.state.dsCuposPracticas.data = val;
            },
        },

        total() {
            return this.dataItems ? this.dataItems.length : 0;
        },
    },
    methods: {
        getData() {

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
                        this.$store.state.dsCuposPracticas.data = response.data.data;
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
        modalidadTemplate(e) {
            return {
                template: Vue.component("modalidad", ModalidadGrid),
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


