<template>
        
</template>

<script>
export default {
    name: 'Logout',
    created() {
        this.$store.dispatch('destroyToken')
            .then((res) => {
                M.toast({html: res.data.message});
                this.$router.push({ name: 'login'} );
            }).catch(err => {
                this.$router.push({ name: 'login'} );
                M.toast({html: err.response.data.message });
            });
    }
}
</script>