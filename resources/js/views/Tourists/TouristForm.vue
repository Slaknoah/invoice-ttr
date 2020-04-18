<template>
    <BaseSidePanel :link="modalLink" @modalClosed="resetFormData" @modalOpened="setFormData"> 
        <form class="col s12" @submit.prevent="saveTourist">
            <h4>{{ isCreateMode ? $t('tourists.form_title.add') :  $t('tourists.form_title.edit')}}</h4>
            <div class="divider"></div>
            <div class="row">
                <BaseInput 
                    v-model="name" 
                    :label="$t('tourists.name')" 
                    type="text"
                    parentClass="input-field col s12">
                    <template v-slot:bf-input>
                        <i class="material-icons prefix">account_circle</i>
                    </template>
                    <template v-slot:af-input>
                        <BaseValidationError v-if="hasValidationError" :errors="validationErrors.name"/>
                    </template>
                </BaseInput>

                <BaseInput 
                    v-model="phone" 
                    :label="$t('tourists.phone')" 
                    parentClass="input-field col s12"
                    type="tel">
                    <template v-slot:bf-input>
                        <i class="material-icons prefix">phone</i>
                    </template>
                    <template v-slot:af-input>
                        <BaseValidationError v-if="hasValidationError" :errors="validationErrors.phone"/>
                    </template>
                </BaseInput>
                
                <BaseInput 
                    v-model="email" 
                    :label="$t('tourists.email')" 
                    parentClass="input-field col s12"
                    type="email">
                    <template v-slot:bf-input>
                        <i class="material-icons prefix">email</i>
                    </template>
                    <template v-slot:af-input>
                        <BaseValidationError v-if="hasValidationError" :errors="validationErrors.email"/>
                    </template>
                </BaseInput>
                
                <BaseInput 
                    v-model="description" 
                    :label="$t('tourists.note')" 
                    isTextarea="1"
                    parentClass="input-field col s12"
                    type="text">
                    <template v-slot:bf-input>
                        <i class="material-icons prefix">info</i>
                    </template>
                    <template v-slot:af-input>
                        <BaseValidationError v-if="hasValidationError" :errors="validationErrors.description"/>
                    </template>
                </BaseInput>
                <div class="col s12 right-align">
                    <button class="btn waves-effect waves-light right-align" type="submit">{{ isCreateMode ? $t('general.add_item_btn') :  $t('general.update_item_btn') }}</button>
                </div>
            </div>
        </form>
    </BaseSidePanel>
</template>

<script>
import { EventBus } from '../../event-bus';
import formMixin from "../../mixins/formMixin";

export default {
    name: "TouristForm",
    data() {
        return {
            name: "",
            email: "",
            phone: "",
            description: "",
            validationErrors: {}
        }
    },
    methods: {
        setFormData() {
            this.name = this.model.name;
            this.email = this.model.email;
            this.phone = this.model.phone;
            this.description = this.model.description;
        },
        saveTourist() {
            if(this.mode === 'create') {
                this.$store.dispatch('addTourist', 
                { 
                    name: this.name, 
                    phone: this.phone,
                    email: this.email,
                    description: this.description
                })
                .then(message => {
                    M.toast({html: message});
                    EventBus.$emit("CLOSE_MODAL", this.modalLink);
                })
                .catch(error => {
                    this.showError(error.response);
                }); 
            } else {
                this.$store.dispatch('updateTourist', 
                { 
                    id: this.model.id,
                    name: this.name, 
                    phone: this.phone,
                    email: this.email,
                    description: this.description
                })
                .then(message => {
                    M.toast({html: message});
                    EventBus.$emit("CLOSE_MODAL", this.modalLink);
                })
                .catch(error => {
                    this.showError(error.response);
                }); 
            }
        }
    },
    mixins: [formMixin]
}
</script>