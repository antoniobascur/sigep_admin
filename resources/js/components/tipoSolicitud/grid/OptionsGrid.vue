<template>
    <div class="btn-group" role="group">
        <button type="button" title="Editar" class="btn btn-primary" @click="onEdit">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </button>
        <button type="button" title="Eliminar" class="btn btn-primary" @click="onDelete">
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
        onEdit() {
            eventHub.$emit("onEditTipoSolicitud", { obj: this.templateArgs });
            //alert("Editar" + this.templateArgs.id);
        },
        onDelete() {
            //alert("Ver" + this.templateArgs.id);
            eventHub.$emit("onDeleteTipoSolicitud", { obj: this.templateArgs });
        },
    },
};
</script>
