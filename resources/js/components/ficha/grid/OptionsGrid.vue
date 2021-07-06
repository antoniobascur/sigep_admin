<template>
    <div class="btn-group" role="group">
        <button type="button" title="Editar" class="btn btn-primary" @click="onEditficha">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </button>
        <button type="button" title="Eliminar" class="btn btn-primary" @click="onDeleteficha">
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
        onEditficha() {
            eventHub.$emit("onEditficha", { obj: this.templateArgs });
            //alert("Editar" + this.templateArgs.id);
        },
        onDeleteficha() {
            //alert("Ver" + this.templateArgs.id);
            eventHub.$emit("onDeleteficha", { obj: this.templateArgs });
        },
    },
};
</script>
