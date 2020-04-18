<template>
    <div class="container">
        <div id="auth-page" class="row">
            <div class="col m8 l4 s10 offset-m2 offset-l4 offset-s1">
                <div class="panel panel-default">
                    <h5 class="panel-heading">{{ $t("auth.login_title") }}</h5>

                    <div class="panel-body">
                        <form class="form-horizontal" action="" @submit.prevent="login">
                            <div class="input-field">
                                <input id="email" type="email" class="validate" v-model="username" required autofocus>
                                <label for="email">{{ $t("auth.email") }}</label>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.username"></BaseValidationError>
                            </div>

                            <div class="input-field">
                                <label for="password">{{ $t("auth.pass") }}</label>
                                <input id="password" type="password" class="validate" v-model="password" required>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.password"></BaseValidationError>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ $t("auth.login_btn") }}
                                    </button>

                                    <router-link class="btn btn-link" :to="{ name: 'forgot-password'}"> {{ $t("auth.forgot_pass_trigger") }}</router-link>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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