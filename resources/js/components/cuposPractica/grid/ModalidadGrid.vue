<template>
    <div>
        <span v-if="this.templateArgs.MODALIDAD===1">
            Individual
        </span>
        <span v-if="this.templateArgs.MODALIDAD===2">
            Duplas
        </span>
        <span v-if="this.templateArgs.MODALIDAD===3">
            Trios
        </span>
    </div>
</template>

<script>
export default {
    data() {
        return {
            templateArgs: {},
        };
    },
}
</script>


