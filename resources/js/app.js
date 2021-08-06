/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



require('./bootstrap');

// vee validate
import VeeValidate, {
    Validator
} from "vee-validate";

Vue.use(VeeValidate, {
    events: ''
});

import es from "vee-validate/dist/locale/es";

Validator.localize("es", es);

import Vue from "vue";
import VueRouter from "vue-router";
import Vuex from "vuex";

Vue.use(VueRouter);
Vue.use(Vuex);


import {
    TreeView,
    TreeViewItem,
    TreeViewInstaller
} from '@progress/kendo-treeview-vue-wrapper';


// estilos kendo
// TODO: borrar en producción
import '@progress/kendo-theme-default/dist/all.css';


//kendo Grid
import {
    Grid,
    GridInstaller
} from '@progress/kendo-grid-vue-wrapper';
import {
    Window,
    WindowInstaller
} from '@progress/kendo-window-vue-wrapper'

import '@progress/kendo-ui/js/kendo.window'
import {
    Upload,
    UploadInstaller
} from '@progress/kendo-upload-vue-wrapper'
import {
    MaskedTextBox,
    NumericTextBox,
    ColorPicker,
    Slider,
    RangeSlider,
    Switch,
    InputsInstaller
} from '@progress/kendo-inputs-vue-wrapper'

import '@progress/kendo-ui/js/cultures/kendo.culture.es-CL.js';

kendo.culture("es-CL");
import {
    AutoComplete,
    ComboBox,
    DropDownList,
    MultiSelect,
    MultiColumnComboBox,
    MultiColumnComboBoxColumn,
    DropdownsInstaller
} from '@progress/kendo-dropdowns-vue-wrapper'
import {
    Chart,
    ChartSeriesItem,
    Sparkline,
    SparklineSeriesItem,
    StockChart,
    ChartInstaller
} from '@progress/kendo-charts-vue-wrapper'


import '@progress/kendo-ui';
import {
    DataSource,
    HierarchicalDataSource,
    GanttDataSource,
    GanttDependencyDataSource,
    PivotDataSource,
    SchedulerDataSource,
    TreeListDataSource,
    DataSourceInstaller
} from '@progress/kendo-datasource-vue-wrapper'

import {
    DateInput,
    Calendar,
    DatePicker
} from '@progress/kendo-vue-dateinputs';

import {
    DialogInstaller
} from '@progress/kendo-dialog-vue-wrapper'
// kendo lang es
import '@progress/kendo-ui/js/messages/kendo.messages.es-CL';
import { TabStrip,LayoutInstaller } from '@progress/kendo-layout-vue-wrapper'
import { SchedulerInstaller } from '@progress/kendo-scheduler-vue-wrapper'
//Vue.use(DateinputsInstaller)
import { EditorInstaller } from '@progress/kendo-editor-vue-wrapper'

Vue.use(EditorInstaller)
Vue.use(SchedulerInstaller)
Vue.use(DialogInstaller)
Vue.use(ChartInstaller)
Vue.use(UploadInstaller)
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(GridInstaller);
Vue.use(Window)
Vue.use(DropdownsInstaller)
Vue.use(TreeViewInstaller)
Vue.use(DataSourceInstaller);
Vue.use(InputsInstaller)
Vue.use(DatePicker)
Vue.use(LayoutInstaller)

import {state} from './store/state';
// vuex
const store = new Vuex.Store({
    state
});

// carga vistas
import App from "./components/config/App";
import Home from "./components/home/Home";
import CentroPractica from "./components/centroPractica/CentroPractica";
import EstadoSolicitud from "./components/estadoSolicitud/EstadoSolicitud";
import ProfesorTutor from "./components/profesorTutor/ProfesorTutor";
import TipoSolicitud from "./components/tipoSolicitud/TipoSolicitud";
import FichaPractica from "./components/ficha/FichaPractica";
import ProgramacionPractica from "./components/programacionPractica/ProgramacionPractica";
import CuposPractica from "./components/cuposPractica/CuposPractica";
// configuración de router
let router = new VueRouter({
   // base: process.env.MIX_ROUTER_BASE,
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },{
            path: '/centroPractica',
            name: 'centroPractica',
            component: CentroPractica
        }
        ,{
            path: '/estadoSolicitud',
            name: 'estadoSolicitud',
            component: EstadoSolicitud
        },{
            path: '/profesorTutor',
            name: 'profesorTutor',
            component: ProfesorTutor
        },{
            path: '/tipoSolicitud',
            name: 'tipoSolicitud',
            component: TipoSolicitud
        },{
            path: '/fichaPractica',
            name: 'fichaPractica',
            component: FichaPractica
        },{
            path: '/programacionPractica',
            name: 'programacionPractica',
            component: ProgramacionPractica
        },{
            path: '/cuposPractica',
            name: 'cuposPractica',
            component: CuposPractica
        }
    ]
});

// instancia maestra
new Vue({
    el: '#app',
    components: { App },
    store,
    router
});

// mixins
Vue.mixin({
    methods: {
        /**
         * Concatena una sección de la url junto a la base, para obtener assets públicos
         * @param {string} slug Sección de la url a concatenar
         * @returns {string}
         */
        url(slug) {
            const path = require('path');
            return path.join(process.env.MIX_APP_URL, slug).replace(':/', '://');
        }
    }
});
