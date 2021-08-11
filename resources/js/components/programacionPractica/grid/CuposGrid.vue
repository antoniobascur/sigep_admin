<template>
    <div>
        <button type="button" class="btn btn-info btn-sm" @click="onViewCupos">   <i class="fa fa-shopping-cart" aria-hidden="true"></i>Ver Cupos</button>
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
        onViewCupos() {
            eventHub.$emit("onViewCupos", { obj: this.templateArgs });
            //alert("Editar" + this.templateArgs.ID);
        },

    },
}
</script>
