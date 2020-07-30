<template>
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
            <resource-filter :filters="touristFilters" @filtersChange="filterChanged"></resource-filter>
        </div>

        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <!-- datatable start -->
                    <div class="responsive-table">
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>{{ $t('tourists.name') }}</th>
                                    <th>{{ $t('tourists.phone') }}</th>
                                    <th>{{ $t('tourists.email') }}</th>
                                    <th>{{ $t('tourists.note') }}</th>
                                    <th style="width:50px"></th>
                                </tr>
                            </thead>

                            <transition name="fade" mode="out-in">
                                <tbody  v-if="!resources.length && isFetching" class="loading">
                                    <tr v-for="index in 5" :key="index">
                                        <td colspan="5">
                                            <tourist-loading></tourist-loading>
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
                                        v-for="(tourist, index) in resources"
                                        :href="'#' + modalID"
                                        :key="tourist.id"
                                        :data-index="index"
                                        class="sidenav-trigger"
                                        @click="editResource(tourist)">
                                        <td>{{ tourist.name }}</td>
                                        <td>{{ tourist.phone }}</td>
                                        <td>{{ tourist.email }}</td>
                                        <td >{{ $shortenText(tourist.description, 100) }}</td>
                                        <td class="actions" @click.prevent="deleteResource(tourist.id, $event)">
                                            <button class="btn-flat waves-effect" type="submit" name="action">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </td>
                                    </tr >
                                </transition-group>
                            </transition>
                        </table>
                    </div>
                    <!-- datatable ends -->
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import TouristForm from "./TouristForm";
import TouristLoading from "../../components/Preloaders/TouristLoading";
import listMixin from "../../mixins/listMixin";
import {mapGetters} from "vuex";

export default {
    data() {
        return {
            fetchJobName: 'fetchTourists',
            deleteJobName: 'deleteTourist',
        }
    },
    computed: {
        ...mapGetters({
            storedResources: 'getTourists',
            resourceMetas: 'getTouristsMeta',
            storedFilters: 'getTouristsFilter'
        }),
        touristFilters() {
            return [
                {
                    type: 'text',
                    name: 'search',
                    label: this.$t('general.searchLabel'),
                    value: this.filters.search
                }
            ]
        }
    },
    components: { 
        TouristForm,
        TouristLoading,
    },
    mixins: [ listMixin ]
}
</script>

<style lang="scss">
    .users-list-wrapper {
        i {
            vertical-align: middle;
        }
        .users-list-filter {
            .show-btn {
                // show button
                padding-top: 43px !important;
            }
        }

        .users-list-table {
            overflow: hidden;

            .dataTables_filter {
                label {
                    input {
                        height: auto;
                        width: auto;
                        margin-left: .5rem;
                    }
                }
            }

            .dataTables_length {
                label {
                    select {
                        display: inline-block;
                        width: auto;
                        height: auto;
                    }
                }
            }

            .dataTable {
                border-collapse: collapse;

                th {
                    width: auto !important;
                    border-bottom: 1px solid color("grey", "lighten-2");
                    padding: 19px 15px;
                }

                tbody td {
                    padding: .8rem .8rem;
                }
            }

            .dataTables_paginate {

                /* Pagination button styling */
                .paginate_button {
                    padding: 0.25em 0.65em;
                    margin-top: 0.25rem;

                    &.current,
                    &:hover {
                        border-radius: 4px;
                        background: color("indigo", "base");
                        border: 1px solid color("indigo", "base");
                        box-shadow: 0px 0px 8px 0px #3f51b5;
                        color: white !important;
                    }
                }
            }
        }
    }

    /* user view css*/
    /*-------------*/
    .users-view {
        i {
            vertical-align: middle;
        }
        .media {
            .avatar{
                margin-right: .6rem;
            }
            .users-view-name {
                font-size: 1.47rem;
            }
        }
        .quick-action-btns{
            a{
                margin-left: 1rem;
            }
        }
        .users-view-timeline {
            padding: 2rem;

            h6 {
                span {
                    font-size: 2rem;
                    vertical-align: middle;
                }
            }
        }

        .striped {
            td:first-child {
                /* dynamic width change of first td*/
                width: 140px;
            }
        }
    }

    /* user edit css*/
    /*-------------*/
    .users-edit {
        i {
            vertical-align: middle;
        }
        .tabs {
            .tab {
                a {
                    text-overflow: clip;

                    span {
                        position: relative;
                        top: 2px;
                    }

                    &.active {
                        background-color: color("indigo", "lighten-5");
                        // color: #fff;
                        border-radius: 4px;
                    }
                }
            }
        }
        .user-edit-btns{
            a{
                margin-right: 1rem;
            }
        }
        form{
            button[type="submit"]{
                margin-right: 1rem;
            }
        }
    }

    @media (max-width:600px) {
        .users-view-timeline {
            h6 {
                /* view timeline text center*/
                text-align: center;
            }
        }

        .users-view {
            .media {
                margin-bottom: .5rem;

                .media-heading {
                    display: flex;

                    .users-view-name {
                        font-size: 1.2rem;
                    }

                    .users-view-username {
                        font-size: .8rem;
                    }
                }
            }
        }
    }
</style>