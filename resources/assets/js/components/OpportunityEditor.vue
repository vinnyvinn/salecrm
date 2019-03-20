<template>
    <modal  name="opportunity-editor" height="auto">
        <div class="card mb-0">
            <div class="card-header">
                <h5>  Add Opportunity</h5>
            </div>
            <div class="card-body">
                <form action="#" @submit.prevent>
                    <div class="form-group">
                        <label>Title</label>
                        <input v-model="form.title" type="text" class="form-control">
                        <span class="text-danger" v-if="form.errors.hasOwnProperty('title')">{{ form.errors.title[0] }}</span>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="">Assigned To</label>
                            <select class="form-control" v-model="form.assigned_to">
                                <option value="">Select Assignee</option>
                                <option :value="option.id" v-for="(option, index) in users" >{{ option.name }}</option>
                            </select>
                            <span class="text-danger" v-if="form.errors.hasOwnProperty('assigned_to')">{{ form.errors.assigned_to[0] }}</span>
                        </div>
                        <div class="col-md-6">
                            <label for="">Deadline</label>
                            <input v-model="form.deadline" type="date" class="form-control">
                            <span class="text-danger" v-if="form.errors.hasOwnProperty('deadline')">{{ form.errors.deadline[0] }}</span>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label>Opportunity Value</label>
                            <input type="number" v-model="form.opportunity_value" name="" id="" class="form-control">
                            <span class="text-danger" v-if="form.errors.hasOwnProperty('opportunity_value')">{{ form.errors.opportunity_value[0] }}</span>
                        </div>
                        <div class="col-md-6">
                            <label>Probability</label>
                            <div class="input-group">
                                <input  max="100" v-model="form.probability" type="number" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                            </div>
                            <span class="text-danger" v-if="form.errors.hasOwnProperty('probability')">{{ form.errors.probability[0] }}</span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Types</label>
                        <select name="" class="form-control" v-model="form.type">
                            <option value="">Select a Type</option>
                            <option :value="key" v-for="(value, key) in types">{{ value }}</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div v-if="form.type == 'other'" class="form-group">
                        <input class="form-control" v-model="form.type_description" cols="30" rows="2"/>
                    </div>
                    <div class="form-group">
                        <label>Competitors</label>
                        <vue-tags-input
                                v-model="form.company"
                                placeholder="add company and press enter"
                                :tags="form.companies"
                                @tags-changed="newTags => form.companies = newTags"
                        />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-primary float-right" @click="submitForm">save</button>
                    </div>
                </form>
            </div>
        </div>
    </modal>
</template>
<script>
    import VueTagsInput from '@johmun/vue-tags-input';
    export default {
        props: ['postUrl', 'users', 'types'],
        name: "OpportunityEditor",
        created() {
            this.assignees = this.users;
        },
        components: {
            VueTagsInput,
        },
        methods: {
            submitForm() {

                axios.post(this.postUrl, {
                    deadline: this.form.deadline,
                    assigned_to: this.form.assigned_to,
                    title: this.form.title,
                    target_value: this.form.target_value,
                    probability: this.form.probability,
                    opportunity_value: this.form.opportunity_value,
                    competitors: this.form.companies,
                    type: this.form.type,
                    type_description: this.form.type == 'other' ? this.type_description : null
                })
                    .then(response => {
                        if(response.data.status === 'success') {
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.form.errors = error.response.data.errors;
                        }
                    });
            }
        },
        data(){
            return {
                company: '',
                assignees: [],
                form: {
                    deadline: '',
                    assigned_to: '',
                    title: '',
                    target_value: '',
                    probability: '',
                    opportunity_value: '',
                    errors:{},
                    companies: [],
                    type: ''
                }
            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    .vue-tags-input {
        width:100%;
    }
</style>