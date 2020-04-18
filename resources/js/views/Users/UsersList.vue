<template>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h4 class="title">{{ $t('users.title') }}</h4>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <BaseBreadcrumb/>
                </div>
            </div>
            
            <div class="card-panel">
                <div class="row">
                    <BaseSelect 
                        parentClass="col s4" 
                        :options="rolesOptions"
                        :label="$t('users.role')"
                        v-model="filters.role"
                        @change.native ="fetchUsers"
                        >
                    </BaseSelect>
                    <div class="input-field col s4">
                        <label>
                            <input type="checkbox" v-model="filters.verified" @change="fetchUsers"/>
                            <span>{{ $t('users.verified') }}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="container frame"> 
            <table class="editable">
                <thead>
                    <tr>
                        <th>{{ $t('users.id') }}</th>
                        <th>{{ $t('users.name') }}</th>
                        <th>{{ $t('users.role') }}</th>
                        <th>{{ $t('users.verified') }}</th>
                        <th>{{ $t('users.email') }}</th>
                        <th style="width:50px"></th>
                    </tr>
                </thead>
                <transition name="fade" mode="out-in">
                    <tbody  v-if="!users.length && isFetching" class="loading">
                        <tr v-for="index in 5" :key="index">
                            <td colspan="5">
                                <UserLoading/>
                            </td>
                        </tr>
                    </tbody>

                    <tbody v-else-if="!users.length && !isFetching">
                        <tr>
                            <td colspan="5" class="center-align">
                                <h4>No resource found!</h4>
                            </td>
                        </tr>
                    </tbody>
                    <transition-group tag="tbody" v-else name="list-item" >
                        <tr 
                            v-for="(user, index) in users" 
                            :href="'#' + viewID" 
                            :key="user.id" 
                            :data-index="index"
                            class="sidenav-trigger"
                            @click="viewModel(user)"
                            >
                            <td>{{ user.id }}</td>
                            <td><img :src="user.avatar"> {{ user.name }}</td>
                            <td>{{ $capitalizeText(user.role.name) }}</td>
                            <td>
                                <i class="material-icons" v-if="user.email_verified_at">check</i>
                                <i class="material-icons" v-else>close</i>
                            </td>
                            <td>{{ user.email }}</td>
                            <td class="actions" >
                                <button
                                        class="btn-flat waves-effect sidenav-trigger"
                                        :href="'#' + modalID"
                                        @click.prevent="editModel(user)">
                                    <i class="material-icons">edit</i>
                                </button>
                            </td>
                            <td class="actions">
                                <button 
                                    class="btn-flat waves-effect sidenav-trigger" 
                                    :href="'#' + viewID" 
                                    @click="viewModel(user)">
                                    <i class="material-icons">remove_red_eye</i>
                                </button>
                            </td>
                        </tr >
                    </transition-group>

                </transition>
                
            </table>

            <transition name="fade">
                <BasePagination
                    v-if="pageCount > 1"
                    :current-page="currentPage"
                    :page-count="pageCount"
                    class="mt-5"
                    :is-add-dots="true"
                    @previousPage="pageChangeHandle('previous')"
                    @nextPage="pageChangeHandle('next')"
                    @loadPage="pageChangeHandle"
                />
            </transition>
        </div>
        <UserView
                :viewLink="viewID"
                :model="currentModel"
                :editLink="modalID"
                @editUser="editModel"
        />
        <UserForm 
            :modalLink="modalID"
            :mode="currentFormMode"
            :model="currentModel"
        />
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import listMixin from "../../mixins/listMixin";
import UserLoading from "../../components/Preloaders/UserLoading";
import UserForm from './UserForm';
import UserView from './UserView';

export default {
    data() {
        return {
            users: [],
            filters: {},
            viewID: 'view-user',
            verifiedOptions: [
                {
                    value: 1,
                    text: 'Yes'
                },
                {
                    value: 2,
                    text: 'No'
                }
            ]
        }
    },
    methods: {
        fetchUsers() {
            this.$store.dispatch('fetchUsers', {
                page: this.currentPage,
                role: this.filters.role,
                verified: this.filters.verified
            })
                .then(res => {
                    this.users = res;    
                })
                .catch(error => this.showError(error.response));

            this.isFetching = false;
        },
        viewModel(val) {
            this.currentModel = val;
        },
        editModel(val) {
            this.currentModel = val;
            this.currentFormMode = "edit";
        },
        deleteUser(id, event) {
            this.$store.dispatch('deleteUser', id)
            .then(message => {
                M.toast({html: message});
            })
            .catch(error => {
                this.showError(error.response);
            }); 
            event.stopPropagation();
        }
    },
    computed: {
        ...mapGetters([
            'getUsers',
            'getUsersLinks',
            'getUsersMeta',
        ]),
        pageCount() { 
            if(this.getUsersMeta)
                return Math.ceil(this.getUsersMeta.total / this.getUsersMeta.per_page);
        },
        rolesOptions() {
            return this.ROLES.map(role => {
                return {
                    value: role.id,
                    text: this.$capitalizeText(role.name)
                }
            });
        }
    },
    created() { 
        if (this.$store.getters.getUsersFilter) {
            // Copy dont reference filter so they can be modified caps of mutations
            this.filters = { ...this.$store.getters.getUsersFilter };
        }

        if(this.getUsers.length) {
            this.users = this.getUsers; 
        }
        else {
            if(this.$route.query.page)
                this.currentPage = parseInt(this.$route.query.page);
            this.fetchUsers();   
            this.isFetching = true;
        }
    },
    watch: {
        currentPage() {
            this.users = [];
            this.fetchUsers();
        }
    },
    components: {
        UserForm,
        UserView,
        UserLoading
    },
    mixins: [ listMixin ]
}
</script>

<style scoped>
    td img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin-right: 13px;
    }
    td .badge {
        margin-left: 10px;
    }
    tbody td:nth-of-type(2){
        display: inline-flex;
        align-items: center;
    }
    .card-panel .row { margin-bottom: 0; }
</style>