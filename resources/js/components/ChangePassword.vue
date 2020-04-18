<template>
    <BaseModal :link="modalLink"> 
        <form class="col s12" @submit.prevent="changePassword">
            <div class="modal-content">
                <h4>Изменение пароля</h4>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">vpn_key</i>
                        <input id="current_password" type="password" v-model="current_password" class="validate" >
                        <label for="current_password">{{ $t('profile.current_password') }}</label>
                        <BaseValidationError v-if="hasValidationError" :errors="validationErrors.current_password"></BaseValidationError>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">vpn_key</i>
                        <input id="new_password" type="password" v-model="new_password" class="validate">
                        <label for="new_password">{{ $t('profile.new_password') }}</label>
                        <BaseValidationError v-if="hasValidationError" :errors="validationErrors.new_password"></BaseValidationError>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">vpn_key</i>
                        <input id="new_password_confirmation" type="password" v-model="new_password_confirmation" class="validate">
                        <label for="new_password_confirmation">{{ $t('profile.repeat_password') }}</label>
                        <BaseValidationError v-if="hasValidationError" :errors="validationErrors.new_password_confirmation"></BaseValidationError>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="Javascript.void(0);" @click.prevent class="modal-close btn-flat waves-effect">{{ $t('general.close_modal') }}</a>
                <button class="btn waves-effect" type="submit">{{ $t('profile.save_pass_btn') }}</button>
            </div>
        </form>
    </BaseModal>
</template>

<script>
import formMixin from "../mixins/formMixin";
import { EventBus } from '../event-bus';

export default {
    data() {
        return {
            current_password: '',
            new_password: '',
            new_password_confirmation: ''
        }
    },
    methods: {
        changePassword() {
            this.$store.dispatch('changePassword', {
                current_password: this.current_password,
                new_password: this.new_password,
                new_password_confirmation: this.new_password_confirmation
            })
            .then(response => {
                M.toast({html: response.data.message});
                this.resetFormData();
                EventBus.$emit("CLOSE_MODAL", this.modalLink);
            })
            .catch( error => { this.showError(error.response)});
        }
    },
    mixins: [formMixin]
}
</script>