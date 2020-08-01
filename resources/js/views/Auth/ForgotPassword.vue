<template >
    <div class="container">
        <div id="forgot-page" class="row auth-page">
            <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 forgot-card bg-opacity-8">
                <form class="login-form" action="" @submit.prevent="sendResetLink">
                    <div class="row">
                        <div class="input-field col s12">
                            <h5 class="ml-4">{{ $t("auth.forgot_title") }}</h5>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-2">person_outline</i>
                            <input id="email"
                                   type="email"
                                   class="validate"
                                   v-model="email"
                                   required autofocus>
                            <label for="email" class="center-align">{{ $t("auth.email") }}</label>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.email"></BaseValidationError>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">
                                {{ $t("auth.forgot_btn") }}
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6 m6 l6">
                            <p class="margin medium-small">
                                <router-link :to="{ name: 'login'}">{{ $t("auth.login_btn") }}</router-link>
                            </p>
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
            email: ''
        }
    },
    methods: {
        sendResetLink() {
            this.$store.dispatch('sendResetLink', {
                email: this.email, 
            })
            .then(response => {
                M.toast({html: response.data.message});
            })
            .catch(error => {
                this.showError(error.response);
            })
        }
    },
}
</script>

<style lang="scss">
    #forgot-page{
        .card-panel.border-radius-6.forgot-card{
            margin-left: 0 !important;
        }
    }
</style>