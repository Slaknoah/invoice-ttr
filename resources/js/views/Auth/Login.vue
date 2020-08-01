<template>
    <div class="container">
        <div id="login-page" class="row auth-page">
            <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                <form class="login-form" action="" @submit.prevent="login">
                    <div class="row">
                        <div class="input-field col s12">
                            <h5 class="ml-4">{{ $t("auth.login_title") }}</h5>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-2">person_outline</i>
                            <input id="email"
                                   type="email"
                                   class="validate"
                                   v-model="username"
                                   autocomplete="on"
                                   required autofocus>
                            <label for="email" class="center-align">{{ $t("auth.email") }}</label>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.username"></BaseValidationError>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-2">lock_outline</i>
                            <input id="password"
                                   type="password"
                                   class="validate"
                                   v-model="password"
                                   autocomplete="on"
                                   required>
                            <label for="password">{{ $t("auth.pass") }}</label>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.password"></BaseValidationError>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">
                                {{ $t("auth.login_btn") }}
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6 m6 l6">
                            <p class="margin medium-small">
                                <router-link :to="{ name: 'register'}">{{ $t("auth.go_to_register") }}</router-link>
                            </p>
                        </div>
                        <div class="input-field col s6 m6 l6">
                            <p class="margin right-align medium-small">
                                <router-link :to="{ name: 'forgot-password'}">{{ $t("auth.go_to_forgot") }}</router-link>
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
                username: '',
                password: ''
            }
        },
        methods: {
            login() {
                this.$store.dispatch('retrieveToken', {
                    username: this.username, 
                    password: this.password
                })
                .then(() => {
                    this.$router.push({name: 'dashboard'});
                }) 
                .catch(error => {
                    this.showError(error.response);
                }); 
            }
        },
    }
</script>

<style lang="scss">
    #login-page{
        .card-panel.border-radius-6.login-card{
            margin-left: 0 !important;
        }
    }
</style>