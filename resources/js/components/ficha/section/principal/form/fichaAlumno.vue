<template>
    <div>
        <form ID="form" class="modal-form" @submit.prevent="validate">
            <h4>Información Educador(a) en formación </h4>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="required">RUT</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="RUT"
                        name="RUT"
                        v-model="form.RUT"
                        placeholder="Ej: 9.999.999-9"
                        v-on:keyup="searchEstudiante"
                        v-validate="'required|max:100'"
                        data-vv-as="RUT"
                        :class="{'is-invalid': errors.has('RUT')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('RUT') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Nombre Estudiante</label>
                    <input
                        type="text"
                        class="form-control"
                        ID="NOMBRE_ESTUDIANTE"
                        name="NOMBRE_ESTUDIANTE"
                        v-model="form.NOMBRE_ESTUDIANTE"
                        placeholder="Ej: Antonio"

                        v-validate="'required|max:100'"
                        data-vv-as="NOMBRE_ESTUDIANTE"
                        :class="{'is-invalid': errors.has('RUT')}"
                    />
                    <div class="invalid-feedback">{{ errors.first('NOMBRE_ESTUDIANTE') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">Carrera </label>

                    <kendo-dropdownlist
                        :ref="'CARRERA'"
                        class="form-control"
                        name="CARRERA"
                        v-model="form.CARRERA"
                        :data-source="dsCarrera"
                        :data-text-field="'CARRERA'"
                        :data-value-field="'UA'"
                        :optionLabel="'Seleccione'"
                        :filter="'contains'"
                        :class="{'is-invalid': errors.has('dsCarrera')}"
                    ></kendo-dropdownlist>

                    <div class="invalid-feedback">{{ errors.first('CARRERA') }}</div>
                </div>

            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "fichaAlumno"
}
</script>

<style scoped>

</style>
