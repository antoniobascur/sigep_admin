<template>
    <div class="btn-group" role="group">
        <button type="button" title="Duplicar" class="btn btn-primary" @click="onDuplicateCuposPractica">
            <i class="fa fa-files-o" aria-hidden="true"></i>
        </button>
        <button type="button" title="Editar" class="btn btn-primary" @click="onEditCuposPractica">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </button>
        <button type="button" title="Eliminar" class="btn btn-primary" @click="onDeleteCuposPractica">
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
        onEditCuposPractica() {
            eventHub.$emit("onEditCuposPractica", { obj: this.templateArgs });
            //alert("Editar" + this.templateArgs.ID);
        },
        onDeleteCuposPractica() {
           // alert("Ver" + this.templateArgs.ID);
            eventHub.$emit("onDeleteCuposPractica", { obj: this.templateArgs });
        },
        onDuplicateCuposPractica() {
       // alert("Duplicar" + this.templateArgs.ID);
        eventHub.$emit("onDuplicateCuposPractica", { obj: this.templateArgs });
        },
    },
};
</script>
