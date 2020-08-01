<template>
    <div class="container">
        <div id="reset-page" class="row auth-page">
            <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 reset-card bg-opacity-8">
                <form class="login-form" action="" @submit.prevent="resetPassword">
                    <div class="row">
                        <div class="input-field col s12">
                            <h5 class="ml-4">{{ $t("auth.reset_title") }}</h5>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-2">mail_outline</i>
                            <input id="email" type="email" v-model="email" required autofocus>
                            <label for="email">{{ $t("auth.email") }}</label>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.email"></BaseValidationError>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-2">lock_outline</i>
                            <input id="password" type="password" v-model="password" required>
                            <label for="password">{{ $t("auth.pass") }}</label>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.password"></BaseValidationError>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-2">lock_outline</i>
                            <input id="password_confirmation" type="password" class="validate" v-model="password_confirmation" required>
                            <label for="password_confirmation">{{ $t("auth.pass_confirm") }}</label>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.password_confirmation"></BaseValidationError>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit"
                                    class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">
                                {{ $t("auth.reset_btn") }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            token: '',
            email: '',
            password: '',
            password_confirmation: ''
        }
    },
    methods: {
        resetPassword() {
            this.$store.dispatch('resetPassword', {
                token: this.token,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
            .then(response => {
                M.toast({html: response.data.message});
                this.$router.push({name: 'login'});
            })
            .catch(error => {
                this.showError(error.response);
            });
        },
    },
    created() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        this.token =  urlParams.get('token');
        this.email = urlParams.get('email');
    }
}
</script>

<style lang="scss">
    #reset-page {
        .card-panel.border-radius-6.reset-card{
            margin-left: 0 !important;
        }
    }
</style>