<template>
    <div class="btn-group" role="group">
        <button type="button" title="Editar" class="btn btn-primary" @click="onEditCentroPractica">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </button>
        <button type="button" title="Eliminar" class="btn btn-primary" @click="onDeleteCentroPractica">
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
        onEditCentroPractica() {
            eventHub.$emit("onEditCentroPractica", { obj: this.templateArgs });
            //alert("Editar" + this.templateArgs.id);
        },
        onDeleteCentroPractica() {
            //alert("Ver" + this.templateArgs.id);
            eventHub.$emit("onDeleteCentroPractica", { obj: this.templateArgs });
        },
    },
};
</script>
