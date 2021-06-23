<template>
    <div class="container-fluid">
        <loading v-if="loading"/>
        <div class="row">
            <div class="col">
                <div
                    class="card shadow-sm border-2 border-right-0 border-bottom-0 border-left-0 border-danger"
                >
                    <div class="card-body pt-2">
                        <div class="d-flex">
                            <div class="p-2">
                                <h4>{{ propsToPass.titulo }}</h4>
                            </div>
                            <div class="ml-auto p-2">
                                <help-button v-bind:element="propsToPass.element"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Loading from "../common/Loading";
import HelpButton from "../common/HelpButton";
    export default {
        components: {
            HelpButton,
            Loading,
        },
        data: function () {
            return {
                loading: true,
                propsToPass: {
                    titulo: "Titulo Home",
                    ayuda: "lorem ",
                    element: "HOME",
                },
            }
    },
        created: function () {
            this.loading = false;
        }
    }
</script>

<style scoped>

</style>
