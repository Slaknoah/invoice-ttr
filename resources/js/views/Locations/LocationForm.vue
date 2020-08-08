<template>
    <BaseSidePanel :link="modalLink" @modalClosed="resetFormData" @modalOpened="setFormData">
        <div class="card">
            <div class="card-content pt-0">
                <div class="card-header display-flex pb-2">
                    <h3 class="card-title contact-title-label">
                        {{ isCreateMode ? $t( 'locations.form_title.add' ) :  $t( 'locations.form_title.edit' ) }}
                    </h3>
                    <div class="close close-icon" @click="closeModal">
                        <i class="material-icons">close</i>
                    </div>
                </div>
                <div class="divider"></div>

                <form class="mt-5" @submit.prevent="saveLocation">
                    <div class="row">
                        <BaseInput v-model="name"
                                   :label="$t('general.name')"
                                   type="text"
                                   parentClass="col s12">
                            <template v-slot:af-input>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.name"/>
                            </template>
                        </BaseInput>

                        <BaseInput v-model="code"
                                   :label="$t( 'general.code' )"
                                   type="text"
                                   parentClass="col s12">
                            <template v-slot:af-input>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.code"/>
                            </template>
                        </BaseInput>

                        <BaseInput
                                v-model="latitude"
                                :label="$t( 'general.latitude' )"
                                parentClass="col s12"
                                type="number">
                            <template v-slot:af-input>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.latitude"/>
                            </template>
                        </BaseInput>

                        <BaseInput
                                v-model="longitude"
                                :label="$t( 'general.longitude' )"
                                parentClass="col s12"
                                type="number">
                            <template v-slot:af-input>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.longitude"/>
                            </template>
                        </BaseInput>
                    </div>

                    <div class="card-action mt-5 pl-0 pr-0 right-align">
                        <button class="btn-small btn--blue waves-effect waves-light" type="submit">
                            <span>
                                {{ isCreateMode ? $t('general.add_item_btn') :  $t('general.update_item_btn') }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </BaseSidePanel>
</template>

<script>
    import formMixin from "../../mixins/formMixin";

    export default {
        name: "LocationForm",
        data() {
            return {
                name: "",
                code: "",
                latitude: "",
                longitude: "",
            }
        },
        methods: {
            setFormData() {
                this.name       = this.model.name;
                this.code       = this.model.code;
                this.latitude   = this.model.latitude;
                this.longitude  = this.model.longitude;
            },
            saveLocation() {
                const params = {
                    name: this.name,
                    code: this.code,
                    latitude: this.latitude,
                    longitude: this.longitude
                };

                if( this.mode === 'create' ) {
                    this.$store.dispatch( 'addLocation', params )
                        .then(data => {
                            M.toast( { html: data.message } );
                            this.$emit( 'resourceAdded', data.response );
                            this.closeModal();
                        })
                        .catch(error => {
                            this.showError( error.response );
                        });
                } else {
                    params.id = this.model.id;

                    this.$store.dispatch('updateLocation', params)
                        .then(data => {
                            M.toast( { html: data.message } );
                            this.$emit( 'resourceUpdated', data.response );
                            this.closeModal();
                        })
                        .catch(error => {
                            this.showError( error.response );
                        });
                }
            }
        },
        mixins: [ formMixin ]
    }
</script>
