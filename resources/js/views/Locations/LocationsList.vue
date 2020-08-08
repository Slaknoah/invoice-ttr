<template>
    <div>
        <list-layout>
            <template #filter>
                <resource-filter :filters="locationFilters" @filtersChange="filterChanged"></resource-filter>
            </template>

            <template #table>
                <transition name="fade" mode="out-in">
                    <div v-if="!resources.length && isFetching" class="loading">
                        <div class="loading__item" v-for="index in 10" :key="index">
                            <table-loading></table-loading>
                        </div>
                    </div>

                    <table v-else id="list-datatable" class="table" v-once>
                        <thead>
                        <tr>
                            <th>{{ $t('general.id') }}</th>
                            <th>{{ $t('general.name') }}</th>
                            <th>{{ $t('general.code') }}</th>
                            <th>{{ $t('general.type') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <transition-group tag="tbody" name="list-item" >
                            <tr v-for="(location, index) in resources"
                                :key="location.id"
                                :data-index="index">
                                <th>{{ location.id }}</th>
                                <td>{{ location.name }}</td>
                                <td>{{ location.code }}</td>
                                <td>{{ location.type }}</td>
                                <td class="actions">
                                    <a class="sidenav-trigger"
                                       @click.prevent="editResource(location)"
                                       :href="'#' + modalID">
                                        <i class="material-icons">edit</i>
                                    </a>
                                </td>
                                <td @click.prevent="deleteResource(location.id, $event)">
                                    <a href="Javascript:void(0);"><i class="material-icons pink-text">delete</i></a>
                                </td>
                            </tr >
                        </transition-group>
                    </table>
                </transition>
            </template>
        </list-layout>

        <location-form :modalLink="modalID"
                       :mode="currentFormMode"
                       :model="currentResource"
                       @resourceAdded="drawResourceToTable"
                       @resourceUpdated="updateResourceToTable">
        </location-form>
    </div>
</template>

<script>
    import LocationForm from "./LocationForm";
    import listMixin from "../../mixins/listMixin";
    import { mapGetters } from "vuex";
    import ListLayout from "../../layouts/ListLayout";

    export default {
        name: "LocationsList",
        data() {
            return {
                fetchJobName: 'fetchLocations',
                deleteJobName: 'deleteLocation',
                dataTableOptions: {
                    responsive: true,
                    "order": [[ 0, "desc" ]],
                    "deferRender": true,
                    'columnDefs': [ {
                        "orderable": false,
                        "targets": [ -1, -2 ]
                    } ]
                }
            }
        },
        methods: {
            constructTableObject (resource) {
                return [
                    resource.id,
                    resource.name,
                    resource.code,
                    resource.type,
                    `<a class="sidenav-trigger edit-btn" href="#${this.modalID}">
                    <i class="material-icons">edit</i>
                </a>`,
                    `<a class="delete-btn" href="Javascript:void(0);">
                    <i class="material-icons pink-text">delete</i>
                </a>`
                ];
            }
        },
        computed: {
            ...mapGetters({
                storedResources: 'getLocations',
                resourceMetas: 'getLocationsMeta',
                storedFilters: 'getLocationsFilter'
            }),
            locationFilters() {
                return []
            }
        },
        mounted() {
        },
        components: {
            ListLayout,
            LocationForm
        },
        mixins: [ listMixin ]
    }
</script>

<style scoped>

</style>