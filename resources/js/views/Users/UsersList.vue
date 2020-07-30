<template>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h4 class="title">{{ $t('users.title') }}</h4>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <base-breadcrumb></base-breadcrumb>
                </div>
            </div>
            <resource-filter :filters="userFilters" @filtersChange="filterChanged"></resource-filter>
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
                        <th style="width:50px"></th>
                    </tr>
                </thead>

                <transition name="fade" mode="out-in">
                    <tbody  v-if="!resources.length && isFetching" class="loading">
                        <tr v-for="index in 5" :key="index">
                            <td colspan="5">
                                <user-loading></user-loading>
                            </td>
                        </tr>
                    </tbody>

                    <tbody v-else-if="!resources.length && !isFetching">
                        <tr>
                            <td colspan="5" class="center-align">
                                <h4>No resource found!</h4>
                            </td>
                        </tr>
                    </tbody>
                    <transition-group tag="tbody" v-else name="list-item" >
                        <tr
                            v-for="(user, index) in resources"
                            :href="'#' + viewID"
                            :key="user.id"
                            :data-index="index"
                            class="sidenav-trigger"
                            @click="viewResource(user)">
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
                                        @click.prevent="editResource(user)">
                                    <i class="material-icons">edit</i>
                                </button>
                            </td>
                            <td class="actions">
                                <button
                                    class="btn-flat waves-effect sidenav-trigger"
                                    :href="'#' + viewID"
                                    @click="viewResource(user)">
                                    <i class="material-icons">remove_red_eye</i>
                                </button>
                            </td>
                        </tr >
                    </transition-group>
                </transition>
            </table>

            <transition name="fade">
                <base-pagination
                    v-if="pageCount > 1"
                    :current-page="currentPage"
                    :page-count="pageCount"
                    class="mt-5"
                    :is-add-dots="true"
                    @previousPage="pageChangeHandle('previous')"
                    @nextPage="pageChangeHandle('next')"
                    @loadPage="pageChangeHandle">
                </base-pagination>
            </transition>
        </div>
<!--        <user-view-->
<!--                :viewLink="viewID"-->
<!--                :model="currentResource"-->
<!--                :editLink="modalID"-->
<!--                @editUser="editResource">-->
<!--        </user-view>-->
<!--        <user-form-->
<!--            :modalLink="modalID"-->
<!--            :mode="currentFormMode"-->
<!--            :model="currentResource">-->
<!--        </user-form>-->
    </div>
</template>

<script>
import listMixin from "../../mixins/listMixin";
import UserLoading from "../../components/Preloaders/UserLoading";
import UserForm from './UserForm';
import UserView from './UserView';
import {mapGetters} from "vuex";

export default {
    data() {
        return {
            viewID: 'view-user',
            fetchJobName: 'fetchUsers',
            deleteJobName: 'deleteUser',
        }
    },
    computed: {
        ...mapGetters({
            storedResources: 'getUsers',
            resourceMetas: 'getUsersMeta',
            storedFilters: 'getUsersFilter'
        }),
        userFilters() {
            return [
                {
                    type: 'text',
                    name: 'search',
                    label: this.$t('general.searchLabel'),
                    value: this.filters.search
                },
                {
                    type: 'select',
                    name: 'verified',
                    label: this.$t('users.verified'),
                    options: [
                        {
                            value: 'yes',
                            text: this.$t('general.yes')
                        },
                        {
                            value: 'no',
                            text: this.$t('general.no')
                        }
                    ],
                    value: this.filters.verified
                },
                {
                    type: 'select',
                    name: 'role',
                    label: this.$t('users.role'),
                    options: this.$store.getters.getRoles.map(role => {
                            return {
                                value: role.id,
                                text: this.$capitalizeText(role.name)
                            }
                        }),
                    value: this.filters.role
                }
            ]
        },
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