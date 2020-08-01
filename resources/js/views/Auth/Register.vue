<template>
   <div class="container">
       <div id="register-page" class="row auth-page">
           <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
               <form class="login-form" method="POST" @submit.prevent="register">
                   <div class="row">
                       <div class="input-field col s12">
                           <h5 class="ml-4">{{ $t("auth.register_title") }}</h5>
                           <p class="ml-4">{{ $t("auth.register_subtitle") }}</p>
                       </div>
                   </div>
                   <div class="row margin">
                       <div class="input-field col s12">
                           <i class="material-icons prefix pt-2">person_outline</i>
                           <input id="username" type="text" v-model="name" required autofocus>
                           <label for="username" class="center-align">{{ $t("auth.name") }}</label>
                           <BaseValidationError v-if="hasValidationError" :errors="validationErrors.name"></BaseValidationError>
                       </div>
                   </div>
                   <div class="row margin">
                       <div class="input-field col s12">
                           <i class="material-icons prefix pt-2">mail_outline</i>
                           <input id="email" type="email" v-model="email" required>
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
                   <div class="row">
                       <div class="input-field col s12">
                           <button type="submit"
                                   class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">
                               {{ $t("auth.register_btn") }}
                           </button>
                       </div>
                   </div>
                   <div class="row">
                       <div class="input-field col s12">
                           <p class="margin medium-small">
                               <router-link :to="{ name: 'login'}">{{ $t("auth.go_to_login") }}</router-link>
                           </p>
                       </div>
                   </div>
               </form>
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

<style lang="scss">
    #register-page {
        .card-panel.border-radius-6.register-card{
            margin-left: 0 !important;
        }
    }
</style>