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
            <kendo-grid-column field="ESTADO" title="<b>ESTADO</b>"></kendo-grid-column>
            <kendo-grid-column field="DESCRIPCION" title="<b>DESCRIPCION</b>"></kendo-grid-column>
            <kendo-grid-column title="<b>Acciones</b>" :template="actionsTemplate" :width="70"></kendo-grid-column>
        </kendo-grid>
    </div>
</template>

<script>
import {Grid} from "@progress/kendo-grid-vue-wrapper";
import OptionsGrid from "./OptionsGrid";

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
                element: "ESTADO_SOLICITUD",
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
        dsEstadoSolicitud() {
            return this.$store.state.dsEstadoSolicitud;
        },
        dsData: {
            get() {
                return this.$store.state.dsEstadoSolicitud.data;
            },
            set(val) {
                this.$store.state.dsEstadoSolicitud.data = val;
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
                        this.$store.state.dsEstadoSolicitud.data = response.data.data;
                    }
                })
                .catch(function (error) {
                    console.log("ERROR:", error);
                    onError();
                })
                .finally(() => {
                    eventHub.$emit("LoadingOff");
                });
        },
        pageChangeHandler: function (event) {
            this.skip = event.page.skip;
            this.take = event.page.take;

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

        eventHub.$on("onAddTogridElementEstadoSolicitud", (data) => {
            this.getData();
         /*   this.$store.state.dsCentroPracticas.data = this.$store.state.dsCentroPracticas.data.concat(
                data.obj
            );*/
        });
        eventHub.$on("onEditEstadoSolicitudTogridElement", (data) => {
            this.getData();
     /*      data = data.obj;
            console.log(data);
            var items = this.$store.state.dsCentroPracticas.data;
            let index = items.findIndex((item) => item.ID == data.ID);
            items.splice(index, 1, data);
            this.$store.state.dsCentroPracticas.data = items;*/
        });
        eventHub.$on("onDeleteEstadoSolicitudToGridElement", (data) => {

         var items = this.$store.state.dsEstadoSolicitud.data;
            let index = items.findIndex((item) => item.ID == data.obj.ID);
            items.splice(index, 1);
            this.$store.state.dsEstadoSolicitud.data = items;
            this.getData();
        });
    },
    beforeDestroy() {
        eventHub.$off("onAddTogridElementEstadoSolicitud");
        eventHub.$off("onEditEstadoSolicitudTogridElement");

    },
}
</script>


