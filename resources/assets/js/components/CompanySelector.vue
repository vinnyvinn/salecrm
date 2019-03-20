<template>
	<modal name="company-selector" height="auto" @before-open="setData">
		<div class="card mb-0">
			<div class="card-header">
				<h5>This is header</h5>
			</div>
			<div class="card-block">
				<select class="form-control" v-model="company">
					<option value="">Select a Company</option>
					<option :value="company.id" v-for="(company, i) in companies">{{ company.name }}</option>
				</select>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary" @click.prevent="submitForm">save</button>
			</div>
		</div>
	</modal>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
	// import 
	export default {
		props: ['getUrl', 'postUrl'],
		created() {
			eventBus.$on('modal-triggered', params => {
				console.log(params);
			});
			axios.get(this.getUrl)
			.then(response => {
				if (response.data.status === 'success') {
					this.companies = response.data.data;
				}
			});
		},
		data() {
			return {
				companies:[],
				company: '',
				prospectId: ''
			}
		},
		methods: {
			submitForm() {
				axios.post(this.postUrl + '/' + this.prospectId , {
					'company': this.company
				})
				.then(response => {
					if (response.data.status == 'success') {
						window.location.reload();
					}
				});
			},
			setData(event){
                this.prospectId = event.params;
            }
		}
	}
</script>
