<template>
    <div class="btn-group" role="group">
        <button type="button" title="Editar" class="btn btn-primary" @click="onEditEstadoSolicitud">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </button>
        <button type="button" title="Eliminar" class="btn btn-primary" @click="onDeleteEstadoSolicitud">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button>
    </div>
</template>

<script>
import eventHub from "../../../eventHub";
export default {
    components: {},
    data() {
        return {
            templateArgs: {},
        };
    },

    methods: {
        onEditEstadoSolicitud() {
            eventHub.$emit("onEditEstadoSolicitud", { obj: this.templateArgs });
            console.log(this.templateArgs);
        },
        onDeleteEstadoSolicitud() {
            alert(this.templateArgs);
            eventHub.$emit("onDeleteEstadoSolicitud", { obj: this.templateArgs });
        },
    },
};
</script>
