<template >
    <div class="container">
        <div id="auth-page" class="row">
            <div class="col m8 l4 s10 offset-m2 offset-l4 offset-s1">
                <div class="panel panel-default">
                    <h5 class="panel-heading">Сброс пароля</h5>

                    <div class="panel-body">
                        <form class="form-horizontal" action="" @submit.prevent="sendResetLink">
                            <div class="input-field">
                                <label for="email">E-Mail</label>
                                <input id="email" type="email" class="validate" v-model="email" required autofocus>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.email"></BaseValidationError>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Отправить ссылку сброса
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