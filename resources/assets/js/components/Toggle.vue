<template>
    
</template>

<script>
    import {GmapMap} from 'vue2-google-maps';
    export default {
        name: "Toggle",
        props: ['oldValue'],
        created() {
            this.showCompanyForm = this.oldValue;
        },
        methods: {
            emitShit() {
                if (this.showCompanyForm) {
                    eventBus.$emit('shown');
                }
            }
        },
        data() {
            return {
                showCompanyForm: false
            }
        }
    }
</script>

<style scoped>

</style>