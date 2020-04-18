<template>
    <BaseSidePanel :link="viewLink">
        <div class="user_view row" v-if="!$isEmptyObject(model)">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">{{ model.name }}</div>
                        <div class="user_view__head">
                            <img class="user_view__avatar" :src="model.avatar">
                            <div class="user_view__content">
                                <table>
                                    <tr><td>{{ $t('users.name') }}:</td> <td>{{ model.name }}</td></tr>
                                    <tr><td>{{ $t('users.role') }}:</td> <td>{{ model.role.name}}</td></tr>
                                    <tr><td>{{ $t('users.email') }}:</td> <td>{{ model.email}}</td></tr>
                                </table>
                            </div>  
                        </div>
                        <table>
                            <tr><td>{{ $t('users.telephone') }}:</td> <td>{{ (model.phone) }}</td></tr>
                            <tr><td>{{ $t('users.registered') }}:</td> <td>{{ $formatDate(model.created_at.date) }}</td></tr>
                            <tr><td>{{ $t('users.last_updated') }}:</td> <td>{{ $formatDate(model.updated_at.date) }}</td></tr>
                            <tr><td>{{ $t('users.verified') }}:</td> <td>{{ (model.email_verified_at) ? 'Yes': 'No' }}</td></tr>
                        </table>
                        <div class="user_view__links">
                            <button @click.prevent="editUser" :href="'#' + editLink" class="btn-small sidenav-trigger"><i class="material-icons">edit</i> {{ $t( 'general.edit_btn' ) }} </button>
                            <span @click.prevent="deleteUser" class="btn-small red"><i class="material-icons">delete</i>{{ $t( 'general.delete_btn' ) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">Permissions</div>
                        <table>
                            <tr v-for="(permission, index) in PERMISSIONS" :key="index">
                                <td>{{permission.description}}</td>
                                <td>
                                    <i class="material-icons" v-if="hasPermission(permission.id)">check</i>
                                    <i class="material-icons" v-else>close</i>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BaseSidePanel>
</template>

<script>
import BaseSidePanel from "../../components/BaseSidePanel";
import { EventBus } from '../../event-bus';

export default {
    name: "UserForm",
    components: {BaseSidePanel},
    props: {
        editLink: String,
        model: {
            type: Object,
            default: function() {
                return {
                    name: '',
                    avatar: '',
                    email: '',
                    role: { 
                        name: ''
                    }
                }
            }
        },
        viewLink: String
    },
    methods: {
        hasPermission(permission_id) {
            return this.model.permissions.filter(function (e) {
                return e.id === permission_id;
            }).length > 0 || this.model.role.id === 1;
        },
        editUser() { this.$emit('editUser', this.model); },
        deleteUser() {
            if ( confirm(this.$t('users.confirm_delete')) ) {
                this.$store.dispatch('deleteUser', this.model.id)
                    .then(message => {
                        EventBus.$emit("CLOSE_MODAL", this.viewLink);
                        M.toast({html: message});
                    })
                    .catch(error => {
                        this.showError(error.response);
                    });
            }
        }
    }
}
</script>

<style>
    .sidenav { width: 500px;}
    .user_view {
        padding: 40px 0px;
    }
    .user_view__head {
        display: flex;
        justify-content: left;
    }
    .user_view__head img {
        width: 120px;
        height: 120px;
        border-radius: 10px;
        margin-right: 20px;
        margin-bottom: 10px;
    }

    .card .card-content .card-title {
        margin-bottom: 20px;
    }
    .user_view tr td:last-of-type { font-weight: 200; }
    .user_view td {
        padding: 10px 5px;
        word-break: break-word;
    }
    .user_view tr:first-of-type td { padding-top: 0px; }
    .user_view__links { margin-top: 20px;}
    .user_view__links .btn-small {
        display: inline-flex; 
        align-items: center;
        justify-content: space-between;
        margin-right: 15px;
    }

    .user_view__links .btn-small {
        margin-right: 5px;
    } 

</style>