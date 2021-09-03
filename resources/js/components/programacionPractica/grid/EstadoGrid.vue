<template>
    <div>
        <div  v-if="this.templateArgs.ESTADO==='ACTIVO'">
                <button type="button" class="btn btn-success btn-sm" @click="onChangeEstado">   <i class="fa fa-toggle-on" aria-hidden="true"></i>Activo</button>
        </div>
        <div v-if="this.templateArgs.ESTADO==='INACTIVO'">
            <button type="button" class="btn btn-warning btn-sm" @click="onChangeEstado">   <i class="fa fa-toggle-off" aria-hidden="true"></i>Inactivo</button>
        </div>

    </div>
</template>

<script>
import eventHub from "../../../eventHub";

export default {
    data() {
        return {
            templateArgs: {},
        };
    },
    methods: {
        onChangeEstado() {
            eventHub.$emit("onChangeEstado", { obj: this.templateArgs });
            //alert("Editar" + this.templateArgs.ID);
        },

    },
}
</script>
