<template>
      <BaseModal :link="modalLink" @modalClosed="resetFormData" @modalOpened="setFormData"> 
        <form class="col s12" @submit.prevent="saveService">
            <div class="modal-content">
                <h4>{{ isCreateMode ? $t('services.form_title.add') :  $t('services.form_title.edit')}}</h4>
                <div class="row">
                    <BaseInput 
                        v-model="name" 
                        :label="$t('services.name')" 
                        type="text"
                        parentClass="input-field col s12">
                        <template v-slot:bf-input>
                            <i class="material-icons prefix">business_center</i>
                        </template>
                        <template v-slot:af-input>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.service_name"/>
                        </template>
                    </BaseInput>

                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-close btn-flat waves-effect">{{ $t('general.close_modal')}}</a>
                <button class="btn waves-effect" type="submit">{{ isCreateMode ? $t('general.add_item_btn') :  $t('general.update_item_btn') }}</button>
            </div>
        </form>
    </BaseModal>
</template>

<script>
import { EventBus } from '../../event-bus';
import formMixin from "../../mixins/formMixin";

export default {
    name: "ServiceForm",
    data() {
        return {
            name: "",
            validationErrors: {}
        }
    },
    methods: {
        setFormData() {
            this.name = this.model.name;
        },
        saveService() {
            if(this.mode == 'create') {
                this.$store.dispatch('addService', 
                { 
                    service_name: this.name, 
                })
                .then(message => {
                    M.toast({html: message});
                    EventBus.$emit("CLOSE_MODAL");
                })
                .catch(error => {
                    this.showError(error.response);
                }); 
            } else {
                this.$store.dispatch('updateService', 
                { 
                    id: this.model.id,
                    service_name: this.name, 
                })
                .then(message => {
                    M.toast({html: message});
                    EventBus.$emit("CLOSE_MODAL");
                })
                .catch(error => {
                    this.showError(error.response);
                }); 
            }
        },
    },
    mixins: [formMixin]
}
</script>

<style scoped>
    .accommodation-list { margin-bottom: 15px; }
</style>