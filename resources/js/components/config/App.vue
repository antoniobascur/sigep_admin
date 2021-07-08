<template>
    <div id="app-wrapper">
        <app-sidebar :config="config" />

        <div id="app-container">
            <!--<Breadcrumb/>-->

            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import AppSidebar from "app-sidebar";
    export default {
        components: {
            AppSidebar,
            // Breadcrumb
        },
        created() {
            this.getMenuAdmin();
        },
        data() {
            return {
                config: {},

            };
        },
        methods: {
            getMenuAdmin() {
                this.config = {
                    title: "SIGEP",
                    items: [
                        {
                            name: "Home", // nombre del enlace, en este caso será mostrado como 'Ítem 1'
                            type: "item", // tipo del ítem, puede ser 'item', 'dropdown' y 'header', si no especifica, por defecto pasa a ser 'item'
                            icon: "fa-home", // ícono que acompaña al enlace, de momento solo está soportado Font Awesome 4.7
                            // desactiva tooltip para ese ítem solamente
                            href: "home", // describe la dirección del link al presionar el ítem. Si en la configuración del sidebar se especifica que se usa Vue Router, href debe contener el nombre de la ruta, en caso contrario, debe contener la ruta absoluta
                            router: true, // si el sidebar está configurado para usar Vue Router, si se añade la propiedad 'router' en false, no se utilizará Vue Router para este elemento
                        },  {
                            name: "CentroPractica", // nombre del enlace, en este caso será mostrado como 'Ítem 1'
                            type: "item", // tipo del ítem, puede ser 'item', 'dropdown' y 'header', si no especifica, por defecto pasa a ser 'item'
                            icon: "fa fa-university", // ícono que acompaña al enlace, de momento solo está soportado Font Awesome 4.7
                            // desactiva tooltip para ese ítem solamente
                            href: "centroPractica", // describe la dirección del link al presionar el ítem. Si en la configuración del sidebar se especifica que se usa Vue Router, href debe contener el nombre de la ruta, en caso contrario, debe contener la ruta absoluta
                            router: true, // si el sidebar está configurado para usar Vue Router, si se añade la propiedad 'router' en false, no se utilizará Vue Router para este elemento
                        },  {
                            name: "EstadoSolicitud", // nombre del enlace, en este caso será mostrado como 'Ítem 1'
                            type: "item", // tipo del ítem, puede ser 'item', 'dropdown' y 'header', si no especifica, por defecto pasa a ser 'item'
                            icon: "fa fa-certificate", // ícono que acompaña al enlace, de momento solo está soportado Font Awesome 4.7
                            // desactiva tooltip para ese ítem solamente
                            href: "estadoSolicitud", // describe la dirección del link al presionar el ítem. Si en la configuración del sidebar se especifica que se usa Vue Router, href debe contener el nombre de la ruta, en caso contrario, debe contener la ruta absoluta
                            router: true, // si el sidebar está configurado para usar Vue Router, si se añade la propiedad 'router' en false, no se utilizará Vue Router para este elemento
                        }, {
                            name: "ProfesorTutor", // nombre del enlace, en este caso será mostrado como 'Ítem 1'
                            type: "item", // tipo del ítem, puede ser 'item', 'dropdown' y 'header', si no especifica, por defecto pasa a ser 'item'
                            icon: "fa fa-graduation-cap", // ícono que acompaña al enlace, de momento solo está soportado Font Awesome 4.7
                            // desactiva tooltip para ese ítem solamente
                            href: "profesorTutor", // describe la dirección del link al presionar el ítem. Si en la configuración del sidebar se especifica que se usa Vue Router, href debe contener el nombre de la ruta, en caso contrario, debe contener la ruta absoluta
                            router: true, // si el sidebar está configurado para usar Vue Router, si se añade la propiedad 'router' en false, no se utilizará Vue Router para este elemento
                        },  {
                            name: "TipoSolicitud", // nombre del enlace, en este caso será mostrado como 'Ítem 1'
                            type: "item", // tipo del ítem, puede ser 'item', 'dropdown' y 'header', si no especifica, por defecto pasa a ser 'item'
                            icon: "fa fa-check-circle", // ícono que acompaña al enlace, de momento solo está soportado Font Awesome 4.7
                            // desactiva tooltip para ese ítem solamente
                            href: "tipoSolicitud", // describe la dirección del link al presionar el ítem. Si en la configuración del sidebar se especifica que se usa Vue Router, href debe contener el nombre de la ruta, en caso contrario, debe contener la ruta absoluta
                            router: true, // si el sidebar está configurado para usar Vue Router, si se añade la propiedad 'router' en false, no se utilizará Vue Router para este elemento
                        }, {
                            name: "FichaPractica", // nombre del enlace, en este caso será mostrado como 'Ítem 1'
                            type: "item", // tipo del ítem, puede ser 'item', 'dropdown' y 'header', si no especifica, por defecto pasa a ser 'item'
                            icon: "fa fa-file-text", // ícono que acompaña al enlace, de momento solo está soportado Font Awesome 4.7
                            // desactiva tooltip para ese ítem solamente
                            href: "fichaPractica", // describe la dirección del link al presionar el ítem. Si en la configuración del sidebar se especifica que se usa Vue Router, href debe contener el nombre de la ruta, en caso contrario, debe contener la ruta absoluta
                            router: true, // si el sidebar está configurado para usar Vue Router, si se añade la propiedad 'router' en false, no se utilizará Vue Router para este elemento
                        },
                        {
                            name: "ProgramacionPractica", // nombre del enlace, en este caso será mostrado como 'Ítem 1'
                            type: "item", // tipo del ítem, puede ser 'item', 'dropdown' y 'header', si no especifica, por defecto pasa a ser 'item'
                            icon: "fa fa-cogs", // ícono que acompaña al enlace, de momento solo está soportado Font Awesome 4.7
                            // desactiva tooltip para ese ítem solamente
                            href: "programacionPractica", // describe la dirección del link al presionar el ítem. Si en la configuración del sidebar se especifica que se usa Vue Router, href debe contener el nombre de la ruta, en caso contrario, debe contener la ruta absoluta
                            router: true, // si el sidebar está configurado para usar Vue Router, si se añade la propiedad 'router' en false, no se utilizará Vue Router para este elemento
                        },
/*{
                            name: "Ficha de Autogestión", // nombre del enlace, en este caso será mostrado como 'Ítem 1'
                            type: "dropdown", // tipo del ítem, puede ser 'item', 'dropdown' y 'header', si no especifica, por defecto pasa a ser 'item'
                            icon: "fa fa-certificate", // ícono que acompaña al enlace, de momento solo está soportado Font Awesome 4.7
                            // desactiva tooltip para ese ítem solamente
                            href: "#", // describe la dirección del link al presionar el ítem. Si en la configuración del sidebar se especifica que se usa Vue Router, href debe contener el nombre de la ruta, en caso contrario, debe contener la ruta absoluta
                            router: false, // si el sidebar está configurado para usar Vue Router, si se añade la propiedad 'router' en false, no se utilizará Vue Router para este elemento
                        },
*/
                    ],
                };
            },
        },
    }
</script>

<style scoped>

</style>
