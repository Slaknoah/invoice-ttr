<template>
      <BaseSidePanel :link="modalLink" @modalClosed="resetFormData" @modalOpened="setFormData"> 
        <form class="col s12" @submit.prevent="saveHotel">
            <div class="modal-content">
                <h4>{{ isCreateMode ? $t('hotels.form_title.add') :  $t('hotels.form_title.edit')}}</h4>
                <div class="divider"></div>
                <div class="row">
                    <BaseInput 
                        v-model="name" 
                        :label="$t('hotels.name')" 
                        type="text"
                        parentClass="input-field col s12">
                        <template v-slot:bf-input>
                            <i class="material-icons prefix">apartment</i>
                        </template>
                        <template v-slot:af-input>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.hotel_name"/>
                        </template>
                    </BaseInput>
                    
                    <div class=" col s12">
                        <p>{{$t('hotels.accommodations')}}</p>
                        <template v-if="isCreateMode">
                            <BaseInput 
                                v-model="accommodation" 
                                :label="$t('hotels.accommodation_input')"
                                v-on:keyup.enter.prevent = "addAccommodation"
                                parentClass="input-field multiple-field col s12">
                                <template v-slot:bf-input>
                                    <i class="material-icons prefix">hotel</i>
                                </template>
                                <template v-slot:af-input>
                                    <button id="add-field" @click.prevent="addAccommodation" class="btn-flat inline-button"><i class="material-icons">add</i></button>
                                </template>
                            </BaseInput>
                            <div class="accommodation-list">
                                <div class="chip" v-for="(accommodation, index) in accommodations" :key="index">
                                    {{ accommodation }}
                                    <i class="close material-icons" @click.prevent="removeAccommodation(index, $event)">close</i>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <BaseInput 
                                v-for="(accommodation, index) in accommodations"
                                v-model="accommodations[index]" 
                                :key="index"
                                :ref="'accommodation'"
                                :label="$t('hotels.accommodation_edit') + ' ' + (index+1)"
                                v-on:keyup.enter.prevent = "if(index == (accommodations.length - 1)) { addAccommodation() }"
                                parentClass="input-field js-acc-input multiple-field col s12">
                                <template v-slot:bf-input>
                                    <i class="material-icons prefix">hotel</i>
                                </template>
                                <template v-slot:af-input>
                                    <a v-if="index === (accommodations.length - 1)" @click.prevent="addAccommodation" class="btn-flat inline-button"><i class="material-icons">add</i></a>
                                    <a v-else class="btn-flat inline-button" @click.prevent="removeAccommodation(index, $event)"><i class="material-icons">clear</i></a>
                                </template>
                            </BaseInput>
                        </template>
                        <BaseValidationError v-if="hasValidationError" :errors="validationErrors.accommodations"/>
                    </div>
                    <div class="col s12 right-align">
                        <button class="btn waves-effect" type="submit">{{ isCreateMode ? $t('general.add_item_btn') :  $t('general.update_item_btn') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </BaseSidePanel>
</template>

<script>
import { EventBus } from '../../event-bus';
import formMixin from "../../mixins/formMixin";

export default {
    name: "HotelForm",
    data() {
        return {
            name: "",
            accommodation: '',
            accommodations: [],
            validationErrors: {}
        }
    },
    methods: {
        setFormData() {
            this.name = this.model.name;
            this.accommodations = (this.model.accommodations) ? [...this.model.accommodations] : [];
        },
        saveHotel() {
            // Prevent saving while accomodation is being added     
            if($('.js-acc-input input').is(":focus")) {
                return false;
            }

            if(this.isCreateMode) {
                this.$store.dispatch('addHotel', 
                { 
                    hotel_name: this.name, 
                    accommodations: this.accommodations,
                })
                .then(message => {
                    M.toast({html: message});
                    EventBus.$emit("CLOSE_MODAL");
                })
                .catch(error => {
                    this.showError(error.response);
                }); 
            } else {
                this.$store.dispatch('updateHotel', 
                { 
                    id: this.model.id,
                    hotel_name: this.name, 
                    accommodations: this.accommodations,
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
        addAccommodation() {
            if(!this.$isNullOrWhiteSpace(this.accommodation) || !this.isCreateMode) {
                this.accommodations.push(this.accommodation);

                if(!this.isCreateMode) {
                    let form = this;
                    this.$nextTick(() => {
                        const index = form.accommodations.length - 1,
                            input = form.$refs.accommodation[index].$el.getElementsByTagName('input')[0];
                        input.focus();
                    })
                }
            }

            this.accommodation = '';
        },
        removeAccommodation(index, event) {
            this.accommodations.splice(index, 1);
            event.stopPropagation();
        }
    },
    mixins: [formMixin]
}
</script>

<style scoped>
    .accommodation-list { margin-bottom: 15px; }
</style>