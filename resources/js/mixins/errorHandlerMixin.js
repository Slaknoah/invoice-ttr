export default  {
    data() {
        return {
            validationErrors: {},
        }
    },
    computed: {
        hasValidationError() {
            return !!Object.entries(this.validationErrors).length;
        }
    },
    methods: {
        logoutUser() {
            this.$store.dispatch('destroyToken').then((res) => {
                this.$router.push({ name: 'login'} );
            }).catch(err => {
                this.$router.push({ name: 'login'} );
            });
        },
        showError(errorResponse) {
            if(errorResponse) {
                M.toast({html: errorResponse.data.message });
                if(errorResponse.status == 422) {
                    this.validationErrors = errorResponse.data.errors;
                } else {
                    this.validationErrors = {};
                }
                if(errorResponse.status == 401) {
                    if(this.$store.getters.getRefreshToken.length) {
                        this.$store.dispatch('refreshToken', {
                            refresh_token: this.$store.getters.getRefreshToken, 
                        }).then(res => {
                            this.$router.go();
                        })
                        .catch(err => {
                            this.logoutUser();
                        })
                    } else {
                        this.logoutUser();
                    }
                };
            }
        }
    },
}