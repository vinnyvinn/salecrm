<template>
    <modal name="opportunity-filter" height="auto">
        <div class="mb-0 card">
            <form :action="postUrl">
                <div class="card-header">
                    <h5>Select Status</h5>
                </div>
                <div class="card-body">
                    <multiselect v-model="form.status" :options="options"></multiselect>
                    <input type="hidden" name="stage" v-model="form.status">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">set</button>
                </div>
            </form>
        </div>
    </modal>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
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
                axios.get(this.postUrl + '/' + this.opportunityId, this.form)
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
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>

</style>