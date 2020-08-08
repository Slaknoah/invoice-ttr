<template>
    <div>
        <list-layout>
            <template #filter>
                <resource-filter :filters="hotelFilters" @filtersChange="filterChanged"></resource-filter>
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
                                <th>{{ $t('general.address') }}</th>
                                <th>{{ $t('general.telephone') }}</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <transition-group tag="tbody" name="list-item" >
                            <tr
                                    v-for="(hotel, index) in resources"
                                    :key="hotel.id"
                                    :data-index="index">
                                <td>{{ hotel.id }}</td>
                                <td>{{ hotel.name }}</td>
                                <td>{{ hotel.address }}</td>
                                <td>{{ hotel.telephone }}</td>
                                <td class="actions">
                                    <a class="sidenav-trigger"
                                       @click.prevent="editResource(hotel)"
                                       :href="'#' + modalID">
                                        <i class="material-icons">edit</i>
                                    </a>
                                </td>
                                <td @click.prevent="deleteResource(hotel.id, $event)">
                                    <a href="Javascript:void(0);"><i class="material-icons pink-text">delete</i></a>
                                </td>
                            </tr >
                        </transition-group>
                    </table>
                </transition>
            </template>
        </list-layout>

        <hotel-form :modalLink="modalID"
                    :mode="currentFormMode"
                    :model="currentResource"
                    @resourceAdded="drawResourceToTable"
                    @resourceUpdated="updateResourceToTable">
        </hotel-form>
    </div>
</template>

<script>
import HotelForm from "./HotelForm";
import listMixin from "../../mixins/listMixin";
import { mapGetters } from "vuex";
import ListLayout from "../../layouts/ListLayout";

export default {
    data() {
        return {
            fetchJobName: 'fetchHotels',
            deleteJobName: 'deleteHotel',
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
                resource.address,
                resource.telephone,
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
            storedResources: 'getHotels',
            resourceMetas: 'getHotelsMeta',
            storedFilters: 'getHotelsFilter'
        }),
        hotelFilters() {
            return []
        }
    },
    components: { 
        HotelForm,
        ListLayout
    },
    mixins: [ listMixin ]
}
</script>

<style scoped>
    .list-sidenav {
        width: 30rem;
    }
</style>