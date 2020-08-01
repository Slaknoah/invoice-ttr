<template>
    <div>
        <list-layout>
            <template #table>
                <transition name="fade" mode="out-in">
                    <div v-if="!resources.length && isFetching" class="loading">
                        <div class="loading__item" v-for="index in 10" :key="index">
                            <tourist-loading></tourist-loading>
                        </div>
                    </div>

                    <table v-else id="list-datatable" class="table">
                        <thead>
                            <tr>
                                <th>{{ $t('general.id') }}</th>
                                <th>{{ $t('tourists.name') }}</th>
                                <th>{{ $t('tourists.phone') }}</th>
                                <th>{{ $t('tourists.email') }}</th>
                                <th style="width:50px"></th>
                            </tr>
                        </thead>
                        <transition-group tag="tbody" name="list-item" >
                            <tr
                                    v-for="(tourist, index) in resources"
                                    :href="'#' + modalID"
                                    :key="tourist.id"
                                    :data-index="index"
                                    class="sidenav-trigger"
                                    @click="editResource(tourist)">
                                <th>{{ tourist.id }}</th>
                                <td>{{ tourist.name }}</td>
                                <td>{{ tourist.phone }}</td>
                                <td>{{ tourist.email }}</td>
                                <td class="actions" @click.prevent="deleteResource(tourist.id, $event)">
                                    <button class="btn-flat waves-effect" name="action">
                                        <i class="material-icons">delete</i>
                                    </button>
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
            @resourceAdded="drawResourceToTable">
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
        }
    },
    methods: {
        drawResourceToTable(resource) {
            const node = this.dataTable.row.add([
                resource.id,
                resource.name,
                resource.phone,
                resource.email,
                `<button class="btn-flat waves-effect" name="action">
                                        <i class="material-icons">delete</i>
                                    </button>`
            ]).draw().node();

            node.addEventListener('click', e => this.deleteResource(resource.id, e) );
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
    mounted() {

    },
    components: {
        ListLayout,
        TouristForm,
        TouristLoading,
    },
    mixins: [ listMixin ]
}
</script>
