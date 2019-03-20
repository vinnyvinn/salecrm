<template>
	
</template>
<script>
	export default {
		props: {
        postUrl: {
            default: ''
        },
        message: {
            default: ''
        }
    },
    methods: {
        created() {
            if (this.message === undefined) {
                this.message = ''
            }
        },
        toggleStatus() {
            if (confirm(this.message)) {
                var request = axios.post(this.postUrl);

                request.then((response) => {
                    if (response.data.status === 'success') {
                        window.location.reload(false);
                    }
                });
            }

            return null;
        }
    }
	}
</script>