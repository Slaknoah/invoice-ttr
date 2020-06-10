<template>
    <div class="container">
        <div id="auth-page" class="row">
            <div class="col m8 l4 s10 offset-m2 offset-l4 offset-s1">
                <div class="panel panel-default">
                    <h5 class="panel-heading">Сброс пароля</h5>

                    <div class="panel-body">
                        <form class="form-horizontal" action="" @submit.prevent="resetPassword">
                            <div class="input-field">
                                <label for="email">E-Mail</label>
                                <input id="email" type="email" class="validate" v-model="email" required autofocus>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.email"></BaseValidationError>
                            </div>

                            <div class="input-field">
                                <label for="password">Пароль</label>
                                <input id="password" type="password" class="validate" v-model="password" required>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.password"></BaseValidationError>
                            </div>
                            
                            <div class="input-field">
                                <label for="password_confirmation">Подтвердите пароль</label>
                                <input id="password_confirmation" type="password" class="validate" v-model="password_confirmation" required>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.password_confirmation"></BaseValidationError>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Сбросить пароль
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