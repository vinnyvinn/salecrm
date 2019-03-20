<template>
    <modal name="status-picker" height="auto" @before-open="setData">
        <div class="mb-0 card">
            <div class="card-header">
                <h5>Select Status</h5>
            </div>
            <div class="card-body">
                <multiselect v-model="form.status" :options="options"></multiselect>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary float-right" @click.prevent="setStatus">set</button>
            </div>
        </div>
    </modal>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
        name: "StatusPicker",
        components: {
            Multiselect
        },
        props: ['statuses', 'postUrl'],
        created() {
           this.options = this.statuses;
        },
        data() {
            return {
                options: [],
                opportunityId: '',
                form: {
                    status: '',
                    errors: {}
                }
            }
        },
        methods: {
            setStatus() {
                axios.post(this.postUrl + '/' + this.opportunityId, this.form)
                    .then(response => {
                        console.log(response);
                        if (response.data.status === 'success') {
                            window.location.reload();
                        }

                        if (response.data.status === 'won') {
                            window.location.href = response.data.url;
                        }
                    });
            },
            setData(event) {
                this.opportunityId = event.params.id;
            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>

</style>