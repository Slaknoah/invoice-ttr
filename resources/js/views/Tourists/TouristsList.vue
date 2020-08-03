<template>
    <div>
        <list-layout>
            <template #filter>
                <resource-filter :filters="touristFilters" @filtersChange="filterChanged"></resource-filter>
            </template>
            <template #table>
                <transition name="fade" mode="out-in">
                    <div v-if="!resources.length && isFetching" class="loading">
                        <div class="loading__item" v-for="index in 10" :key="index">
                            <tourist-loading></tourist-loading>
                        </div>
                    </div>

                    <table v-else id="list-datatable" class="table" v-once>
                        <thead>
                            <tr>
                                <th>{{ $t('general.id') }}</th>
                                <th>{{ $t('tourists.name') }}</th>
                                <th>{{ $t('tourists.phone') }}</th>
                                <th>{{ $t('tourists.email') }}</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <transition-group tag="tbody" name="list-item" >
                            <tr
                                    v-for="(tourist, index) in resources"
                                    :key="tourist.id"
                                    :data-index="index">
                                <th>{{ tourist.id }}</th>
                                <td>{{ tourist.name }}</td>
                                <td>{{ tourist.phone }}</td>
                                <td>{{ tourist.email }}</td>
                                <td class="actions">
                                    <a class="sidenav-trigger"
                                            @click.prevent="editResource(tourist)"
                                            :href="'#' + modalID">
                                        <i class="material-icons">edit</i>
                                    </a>
                                </td>
                                <td @click.prevent="deleteResource(tourist.id, $event)">
                                    <a href="Javascript:void(0);"><i class="material-icons pink-text">delete</i></a>
                                </td>
                            </tr >
                        </transition-group>
                    </table>
                </transition>
            </template>
        </list-layout>

        <tourist-form
            :modalLink="modalID"
            :mode="currentFormMode"
            :model="currentResource"
            @resourceAdded="drawResourceToTable"
            @resourceUpdated="updateResourceToTable">
        </tourist-form>
    </div>
</template>

<script>
import TouristForm from "./TouristForm";
import TouristLoading from "../../components/Preloaders/TouristLoading";
import listMixin from "../../mixins/listMixin";
import {mapGetters} from "vuex";
import ListLayout from "../../layouts/ListLayout";

export default {
    data() {
        return {
            fetchJobName: 'fetchTourists',
            deleteJobName: 'deleteTourist',
            dataTableOptions: {
                responsive: true,
                "order": [[ 0, "desc" ]],
                "deferRender": true,
                'columnDefs': [{
                    "orderable": false,
                    "targets": [-1, -2]
                }]
            }
        }
    },
    methods: {
        constructTableObject (resource) {
            return [
                resource.id,
                resource.name,
                resource.phone,
                resource.email,
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
            storedResources: 'getTourists',
            resourceMetas: 'getTouristsMeta',
            storedFilters: 'getTouristsFilter'
        }),
        touristFilters() {
            return [
                {
                    type: 'select',
                    name: 'hotel',
                    label: this.$t('hotels.hotel_visited'),
                    options: this.$store.getters.getHotels.map(hotel => {
                        return {
                            value: hotel.id,
                            text: this.$capitalizeText(hotel.name)
                        }
                    }),
                    value: this.filters.hotel
                }
            ]
        }
    },
    mounted() {
        this.$store.dispatch('fetchHotels', {}).catch(error => console.log(error));
    },
    components: {
        ListLayout,
        TouristForm,
        TouristLoading,
    },
    mixins: [ listMixin ]
}
</script>
