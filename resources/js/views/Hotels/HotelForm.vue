<template>
      <BaseSidePanel :link="modalLink" @modalClosed="resetFormData" @modalOpened="setFormData">
          <div class="card">
              <div class="card-content pt-0">
                  <div class="card-header display-flex pb-2">
                      <h3 class="card-title contact-title-label">
                          {{ isCreateMode ? $t('hotels.form_title.add') :  $t('hotels.form_title.edit')}}
                      </h3>
                      <div class="close close-icon" @click="closeModal">
                          <i class="material-icons">close</i>
                      </div>
                  </div>
                  <div class="divider"></div>

                  <form class="mt-5" @submit.prevent="saveHotel">
                      <div class="row">
                          <BaseInput
                                  v-model="name"
                                  :label="$t('hotels.name')"
                                  type="text"
                                  parentClass="col s12">
                              <template v-slot:bf-input>
                                  <i class="material-icons prefix">domain</i>
                              </template>
                              <template v-slot:af-input>
                                  <BaseValidationError v-if="hasValidationError" :errors="validationErrors.hotel_name"/>
                              </template>
                          </BaseInput>

                          <BaseInput
                                  v-model="address"
                                  :label="$t('general.address')"
                                  type="text"
                                  parentClass="col s12">
                              <template v-slot:bf-input>
                                  <i class="material-icons prefix">domain</i>
                              </template>
                              <template v-slot:af-input>
                                  <BaseValidationError v-if="hasValidationError" :errors="validationErrors.address"/>
                              </template>
                          </BaseInput>

                          <BaseInput
                                  v-model="telephone"
                                  :label="$t('general.telephone')"
                                  type="text"
                                  parentClass="col s12">
                              <template v-slot:bf-input>
                                  <i class="material-icons prefix">phone</i>
                              </template>
                              <template v-slot:af-input>
                                  <BaseValidationError v-if="hasValidationError" :errors="validationErrors.telephone"/>
                              </template>
                          </BaseInput>

                          <BaseInput
                                  v-model="telephone_two"
                                  :label="$t('general.telephone_two')"
                                  type="text"
                                  parentClass="col s12">
                              <template v-slot:bf-input>
                                  <i class="material-icons prefix">phone</i>
                              </template>
                              <template v-slot:af-input>
                                  <BaseValidationError v-if="hasValidationError" :errors="validationErrors.telephone_two"/>
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
                                  </BaseInput>

                                  <button id="add-field"
                                          @click.prevent="addAccommodation"
                                          class="btn-flat btn-add btn-floating waves-effect waves-light grey right">
                                      <i class="material-icons">add</i>
                                  </button>

                                  <div class="accommodation-list">
                                      <div class="chip" v-for="(accommodation, index) in accommodations" :key="index">
                                          {{ accommodation }}
                                          <i class="close material-icons"
                                             @click.prevent="removeAccommodation(index, $event)">
                                              close
                                          </i>
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
                                          v-on:keyup.enter.prevent = "(index === (accommodations.length - 1)) ? addAccommodation() : null"
                                          parentClass="js-acc-input acc-input col s12">
                                      <template v-slot:bf-input>
                                          <i class="material-icons prefix">hotel</i>
                                      </template>

                                      <template v-slot:af-input>
                                          <a class="btn-flat btn-remove inline-button" @click.prevent="removeAccommodation(index, $event)"><i class="material-icons">clear</i></a>
                                      </template>
                                  </BaseInput>
                                  <a @click.prevent="addAccommodation"
                                     class="btn-flat btn-add btn-floating waves-effect waves-light grey right">
                                      <i class="material-icons">add</i>
                                  </a>
                              </template>
                              <BaseValidationError v-if="hasValidationError" :errors="validationErrors.accommodations"/>
                          </div>
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
    name: "HotelForm",
    data() {
        return {
            name: "",
            address: "",
            telephone: "",
            telephone_two: "",
            accommodation: '',
            accommodations: [],
            validationErrors: {}
        }
    },
    methods: {
        setFormData() {
            this.name           = this.model.name;
            this.address        = this.model.address;
            this.telephone      = this.model.telephone;
            this.telephone_two  = this.model.telephone_two;
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
                    address: this.address,
                    telephone: this.telephone,
                    telephone_two: this.telephone_two,
                    accommodations: this.accommodations,
                })
                .then(data => {
                    M.toast({html: data.message});
                    this.$emit('resourceAdded', data.response);
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
                .then(data => {
                    M.toast({html: data.message});
                    this.$emit('resourceUpdated', data.response);
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

    .acc-input { position: relative }
    .acc-input .btn-remove {
        position: absolute;
        right: -0.5em;
        top: 0;
        padding: 0;
    }
</style>