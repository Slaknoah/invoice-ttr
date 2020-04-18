<template>
    <div class="content">
        <div class="container">
             <div class="row">
                <div class="col s12 m6 l6">
                    <h4 class="title">{{ $t('profile.title') }}</h4>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <BaseBreadcrumb/>
                </div>
            </div>
        </div>
        <div id="profile" class="container frame" v-if="!$isEmptyObject(getAuthUser)">
            <div class="row">
                <div class="col m12 s12">
                    <div class="card-panel yellow darken-4" v-if="!getAuthUser.email_verified_at">
                        <div class="white-text">
                            <p>Your account email isnt verified yet please verify.</p>
                        </div>
                        <div class="card-action">
                            <a @click.prevent="sendVerification" class="waves-effect waves-light btn">Verify</a>
                        </div>
                    </div>
                    <div class="profile-header">
                        <img :src="getAuthUser.avatar" class="user-avatar">
                        <div class="profile-header__content">
                            <div class="profile-header__title">
                                <h5 v-once>{{ name }}</h5>
                                <span class="new badge">{{getAuthUser.role.name}}</span>
                            </div>
                            <div class="profile-header__links">
                                <button :href="'#' + passwordResetModalID" class="btn btn-small left waves-effect waves-light modal-trigger">{{ $t('profile.change_password')}}</button>
                            </div>
                        </div>  
                    </div>
                    <form enctype="multipart/form-data" action="/profile" method="POST" @submit.prevent="save">
                        <BaseInput 
                            v-model="name" 
                            :label="$t('profile.name')" 
                            parentClass="input-field col  m6 s12"
                            type="text">
                            <template v-slot:bf-input>
                                <i class="material-icons prefix">account_circle</i>
                            </template>
                            <template v-slot:af-input>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.name"></BaseValidationError>
                            </template>
                        </BaseInput>
                        
                        <BaseInput 
                            v-model="email" 
                            :label="$t('profile.email')" 
                            parentClass="input-field col m6 s12"
                            type="text">
                            <template v-slot:bf-input>
                                <i class="material-icons prefix">email</i>
                            </template>
                            <template v-slot:af-input>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.email"></BaseValidationError>
                            </template>
                        </BaseInput>
                        
                        <BaseInput
                            v-model="phone" 
                            :label="$t('profile.phone')" 
                            parentClass="input-field col m6 s12"
                            type="text">
                            <template v-slot:bf-input>
                                <i class="material-icons prefix">phone</i>
                            </template>
                            <template v-slot:af-input>
                                <BaseValidationError v-if="hasValidationError" :errors="validationErrors.phone"></BaseValidationError>
                            </template>
                        </BaseInput>
                    
                        <BaseUpload
                            class="col m6 s12"
                            :maxFileSize="MAX_UPLOAD_SIZE"
                            :allowedExt="allowedExtensions" 
                            v-model="avatar" 
                            :validationError="uploadValidationErrors" 
                            :resetUpload="resetUpload"
                            :label="$t('profile.change_avatar')"/>
                            
                        <button type="submit" class="btn right" >{{$t('profile.save_btn')}}</button>
                        <button class="btn red right modal-trigger" :href="'#' + confirmationModalID" >{{$t('profile.delete_profile')}}</button>
                    </form>
                </div>
            </div>
        </div>
        <ChangePassword :modalLink="passwordResetModalID"></ChangePassword>
        <ConfirmAction 
            :modalLink="confirmationModalID" 
            message="Are you sure you want to delete your account?"
            @agreed="deleteAccount"  
            >
            <p>Please note that you cannot undo this action.</p>
        </ConfirmAction>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import ChangePassword from '../components/ChangePassword';
import ConfirmAction from '../components/ConfirmAction';
import { EventBus } from '../event-bus';

export default {
    data() {
        return {
            avatar: [],
            name: null,
            email: null,
            phone: null,
            allowedExtensions: ['jpg', 'png', 'jpeg', 'gif'],
            resetUpload: false,
            confirmationModalID: "delete-profile",
            passwordResetModalID: "change-password",
            current_password: '',
            new_password: '',
            new_password_confirmation: '',
        }
    },
    methods: {
        save() {
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('email', this.email);
            formData.append('phone', this.phone);
            formData.append('_method', 'PUT');
            if (this.avatar.length) formData.append('avatar', this.avatar[0]);
            
            this.$store.dispatch('updateUserProfile', formData)
            .then(res => {
                M.toast({html: res});
                this.resetForm();
            })
            .catch(error => {
                this.resetForm();
                this.showError(error.response);
            })
        },
        deleteAccount() {
            this.$store.dispatch('deleteMyAccount')
                .then(mes => {
                    M.toast({html: mes});
                    this.logoutUser();
                }
                )
                .catch(error => this.showError(error.response)); 
        },
        resetForm() {
            this.name = this.getAuthUser.name;
            this.email = this.getAuthUser.email;
            this.phone = this.getAuthUser.phone;
            this.avatar = [];
            EventBus.$emit('BASE_UPLOAD_SUBMITTED')
        },
        sendVerification() {
            this.$store.dispatch('verifyUser')
                .then(res => {
                    M.toast({html: res});
                    this.$store.dispatch('getAuthUser');
                })
                .catch(error => this.showError(error.response))
        },
        parseQueryString(string) {
            // Parse a query string into an object
            if(string == "") { return {}; }
            var segments = string.split("&").map(s => s.split("=") );
            var queryString = {};
            segments.forEach(s => queryString[s[0]] = s[1]);
            return queryString;
        },
    },
    computed: {
        ...mapGetters(['getAuthUser']),
        uploadValidationErrors() {
            if(this.hasValidationError && typeof this.validationErrors.avatar !== 'undefined') {
                return this.validationErrors.avatar;
            }
            return null;
        },
        modalID() { return this.$route.meta.modalID; },
    },
    created() {
        if(this.getAuthUser) {
            this.name = this.getAuthUser.name;
            this.email = this.getAuthUser.email;
            this.phone = this.getAuthUser.phone;
        }

        // Check verification
        var q = this.parseQueryString(window.location.search.substring(1));
        if(q && q.is_verification_link) {
            this.$store.dispatch('getAuthUser').then(res => {
                M.toast({html: 'Email verified!'});
                this.$router.push({name: 'profile'});
            }).catch(error => {
                this.showError(error.response);
            })
        }
    },
    components: {
        ChangePassword,
        ConfirmAction,
    }
}
</script>

<style scoped>
    form {
        margin-top: 40px;
    }

    #profile {
        padding-top: 40px;
    }
    .profile-header {
        overflow: auto;
        display: flex;
    }
    .profile-header .badge {
        display: block;
        float: left;
        margin: 0;
    }

    .profile-header__content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    h5 {margin: 0 0 10px}

    .user-avatar {
        width: 40%;
        height: auto;
        border-radius: 5px;
    }

    @media (min-width: 576px) {
        .user-avatar {
            width: 125px;
            margin-right: 25px;
        }
    }

    .card-panel {
        padding: 8px 24px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    form button {
        margin-left: 10px;
    }
</style>