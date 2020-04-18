<template>
   <div class="container">
        <div id="auth-page" class="row">
            <div class="col m8 l4 s10 offset-m2 offset-l4 offset-s1">
                <div class="panel panel-default">
                    <h5 class="panel-heading">{{ $t("auth.register_title")}}</h5>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" @submit.prevent="register">
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">{{ $t("auth.name") }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" v-model="name" required autofocus>
                                    <BaseValidationError v-if="hasValidationError" :errors="validationErrors.name"></BaseValidationError>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">{{ $t("auth.email") }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required>
                                    <BaseValidationError v-if="hasValidationError" :errors="validationErrors.email"></BaseValidationError>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">{{ $t("auth.pass") }}</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" v-model="password" required>
                                    <BaseValidationError v-if="hasValidationError" :errors="validationErrors.password"></BaseValidationError>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ $t("auth.register_btn") }}
                                    </button>
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
    import BaseValidationError from "../../components/BaseValidationError";
    export default {
        name: 'Register',
        components: {BaseValidationError},
        data() {
            return {
                name: null,
                email: null,
                password: null,
            }
        },
        methods: {
            register() {
                this.$store.dispatch('register', {
                    name: this.name,
                    email: this.email, 
                    password: this.password
                })
                .then((response) => {
                    M.toast({html: response});
                    this.$router.push({name: 'login'});
                }) 
                .catch(error => {
                    this.showError(error.response);
                }); 
            }
        },
    }
</script>