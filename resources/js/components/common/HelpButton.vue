<template>
    <div class="float-right">
        <button type="button" class="help-button" v-on:click="showWindow">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
        </button>
        <!-- TODO: estrategia de ocultar window -->
        <kendo-window
            :ref="'helpWindow'"
            :width="'50%'"
            :height="'auto'"
            :title="'Ayuda: ' + this.titulo"
            :visible="false"
            :modal="true"
            style="display:none"
        >
            <div class="row">
                <div class="col-md-12">
                    <p class="text-justify" v-html="this.mensaje"></p>
                </div>
            </div>
        </kendo-window>
    </div>
</template>

<script>
import { KendoWindow } from "@progress/kendo-window-vue-wrapper";
import HelpMessage from "./json/HelpMessage.json";
export default {
    data() {
        return {
            mensaje: null,
            titulo: null,
        };
    },
    components: {
        KendoWindow,
    },
    props: ["element", "title"],
    computed: {
        window() {
            return this.$refs["helpWindow"];
        },
    },
    methods: {
        showWindow() {
            this.mensaje = HelpMessage[this.element].HELP;
            this.titulo = HelpMessage[this.element].TITULO;
            this.$nextTick(() => {
                let window = this.window.kendoWidget();
                window.center().open();
            });
        },
    },
};
</script>
