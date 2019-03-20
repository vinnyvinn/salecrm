<template>

</template>
<script>
	export default {
		props: ['modalName', 'rowData'],
		methods: {
			showModal() {
				this.$modal.show(this.modalName, this.rowData);
			}
		}
	}
</script>