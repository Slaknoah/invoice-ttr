<template>
    <BaseSidePanel :link="modalLink" @modalClosed="resetFormData" @modalOpened="setFormData">
        <div class="card">
            <div class="card-content pt-0">
                <div class="card-header display-flex pb-2">
                    <h3 class="card-title contact-title-label">{{ isCreateMode ? $t('tourists.form_title.add') :  $t('tourists.form_title.edit')}}</h3>
                    <div class="close close-icon">
                        <i class="material-icons">close</i>
                    </div>
                </div>
                <div class="divider"></div>

                <form class="mt-5" @submit.prevent="saveTourist">
                    <div class="row">
                        <BaseInput
                            v-model="name"
                            :label="$t('tourists.name')"
                            type="text"
                            parentClass="input-field col s12">
                            <template v-slot:bf-input>
                                <i class="material-icons prefix">perm_identity</i>
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
                                <i class="material-icons prefix">note</i>
                            </template>
                            <template v-slot:af-input>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.description"/>
                            </template>
                        </BaseInput>
                    </div>

                    <div class="card-action mt-5 pl-0 pr-0 right-align">
                        <button class="btn-small btn--blue waves-effect waves-light add-contact" type="submit">
                            <span>{{ isCreateMode ? $t('general.add_item_btn') :  $t('general.update_item_btn') }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
                .then(data => {
                    M.toast( { html: data.message } );
                    this.$emit('resourceAdded', data.response);
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
                .then(data => {
                    M.toast({html: data.message});
                    this.$emit('resourceUpdated', data.response);
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