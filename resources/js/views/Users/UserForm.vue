<template>
    <BaseSidePanel :link="modalLink" @modalClosed="resetFormData" @modalOpened="setFormData">
        <form class="col s12" @submit.prevent="saveUser">
            <div class="modal-content">
                <h4>{{ isCreateMode ? $t('users.form_title.add') :  $t('users.form_title.edit')}}</h4>
                <div class="row">
                    <BaseInput
                        v-model="name" 
                        :label="$t('users.name')"
                        type="text"
                        parentClass="input-field col s12"
                    >
                        <template v-slot:bf-input>
                            <i class="material-icons prefix">account_circle</i>
                        </template>
                        <template v-slot:af-input>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.name"/>
                        </template>
                    </BaseInput>
                    <BaseInput
                        v-model="email" 
                        :label="$t('users.email')" 
                        parentClass="input-field col s12"
                        type="email"
                    >
                        <template v-slot:bf-input>
                            <i class="material-icons prefix">email</i>
                        </template>
                        <template v-slot:af-input>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.email"/>
                        </template>
                    </BaseInput>

                    <BaseInput
                        v-model="password"
                        :label="$t('users.password')"
                        parentClass="input-field col s12"
                        type="password">
                        <template v-slot:bf-input>
                            <i class="material-icons prefix">vpn_key</i>
                        </template>
                        <template v-slot:af-input>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.password"/>
                        </template>
                    </BaseInput>

                    <BaseInput
                        v-model="password_confirmation"
                        :label="$t('users.password_confirmation')"
                        parentClass="input-field col s12"
                        type="password"
                    >
                        <template v-slot:bf-input>
                            <i class="material-icons prefix">vpn_key</i>
                        </template>
                        <template v-slot:af-input>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.password_confirmation"/>
                        </template>
                    </BaseInput>

                    <BaseInput
                        v-model="phone"
                        :label="$t('users.phone')"
                        parentClass="input-field col s12"
                        type="tel"
                    >
                        <template v-slot:bf-input>
                            <i class="material-icons prefix">phone</i>
                        </template>
                        <template v-slot:af-input>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.phone"/>
                        </template>
                    </BaseInput>

                    <BaseSelect
                            parentClass="col s8"
                            :options="rolesOptions"
                            label="Role"
                            :notSelectedLabel="$t('users.default_role')"
                            v-model="role"
                    >
                        <template v-slot:bf-input>
                            <i class="material-icons prefix">work</i>
                        </template>
                        <template v-slot:af-input>
                            <BaseValidationError v-if="hasValidationError" :errors="validationErrors.role"/>
                        </template>
                    </BaseSelect>

                    <div class="input-field col s4">
                        <label>
                            <input type="checkbox" v-model="isVerified"/>
                            <span>{{$t('users.verified')}}</span>
                        </label>
                        <BaseValidationError v-if="hasValidationError" :errors="validationErrors.isVerified"/>
                    </div>

                    <BaseUpload
                            class="col s12"
                            :maxFileSize="MAX_UPLOAD_SIZE"
                            :allowedExt="allowedExtensions"
                            v-model="avatar"
                            :validationError="uploadValidationErrors"
                            :resetUpload="false"
                            :label="$t('users.avatar')"/>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn waves-effect" type="submit">{{ isCreateMode ? $t('general.add_item_btn') :  $t('general.update_item_btn') }}</button>
            </div>
        </form>
    </BaseSidePanel>
</template>

<script>
import { EventBus } from '../../event-bus';
import formMixin from "../../mixins/formMixin";

export default {
    name: "UserForm",
    data() {
        return {
            avatar: [],
            name: "",
            email: "",
            phone: null,
            role: 0,
            password: '',
            password_confirmation: '',
            allowedExtensions: ['jpg', 'png', 'jpeg', 'gif'],
            isVerified: false,
            validationErrors: {},
        }
    },
    methods: {
        resetFormData() {
            Object.assign(this.$data, this.$options.data());
            EventBus.$emit('BASE_UPLOAD_SUBMITTED');
        },
        setFormData() {
            if(!this.$isEmptyObject(this.model)) {
                this.name       = this.model.name || '';
                this.email      = this.model.email || '';
                this.phone      = this.model.phone || '';
                this.role       = this.model.role.id || '';
                this.isVerified = !!this.model.email_verified_at || false;
            }
        },
        getFormData() {
            let formData = new FormData();
            const isVerified = this.isVerified ? '1' : '0';
            formData.append('name', this.name);
            formData.append('email', this.email);
            formData.append('phone', this.phone);
            formData.append('password', this.password);
            formData.append('password_confirmation', this.password_confirmation);
            formData.append('isVerified',   isVerified);
            formData.append('role', this.role);
            if (this.avatar.length) formData.append('avatar', this.avatar[0]);
            return formData;
        },
        saveUser() {
            if(this.mode === 'create') {
                const formData = this.getFormData();

                this.$store.dispatch('addUser', formData)
                    .then(message => {
                        M.toast({html: message});
                        this.resetFormData();
                        EventBus.$emit("CLOSE_MODAL", this.modalLink);
                    })
                    .catch(error => {
                        this.showError(error.response);
                    });
            } else {
                const formData = this.getFormData();
                formData.append('_method', 'PUT');

                this.$store.dispatch('updateUser', {id: this.model.id, data: formData})
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
    computed: {
        rolesOptions() {
            return this.$store.getters.getRoles.map(role => {
                return {
                    value: parseInt(role.id),
                    text: this.$capitalizeText(role.name)
                }
            });
        },
        uploadValidationErrors() {
            if(this.hasValidationError && typeof this.validationErrors.avatar !== 'undefined') {
                return this.validationErrors.avatar;
            }
            return null;
        },
    },
    mixins: [formMixin]
}
</script>