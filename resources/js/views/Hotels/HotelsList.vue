<template>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h4 class="title">{{ $t('hotels.title') }}</h4>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <base-breadcrumb></base-breadcrumb>
                </div>
            </div>
            <resource-filter :filters="hotelFilters" @filtersChange="filterChanged"></resource-filter>
        </div>
        <div class="container frame">
            <table class="editable">
                <thead>
                    <tr>
                        <th>{{ $t('hotels.name') }}</th>
                        <th>{{ $t('hotels.accommodations') }}</th>
                        <th style="width:50px"></th>
                    </tr>
                </thead>

                <transition name="fade" mode="out-in">
                    <tbody  v-if="!resources.length && isFetching" class="loading">
                        <tr v-for="index in 5" :key="index">
                            <td colspan="3">
                                <hotel-loading></hotel-loading>
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
                            v-for="(hotel, index) in resources"
                            :href="'#' + modalID" 
                            :key="hotel.id" 
                            :data-index="index"
                            class="sidenav-trigger"
                            @click="editResource(hotel)"
                            >
                            <td>{{ hotel.name }}</td>
                            <td>
                                <div class="chip" v-for="(accommodation, i) in hotel.accommodations" :key="i">
                                    {{ accommodation }}
                                </div>
                            </td>
                            <td class="actions" @click.prevent="deleteResource(hotel.id, $event)">
                                <button class="btn-flat waves-effect" type="submit" name="action">
                                    <i class="material-icons">delete</i>
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
        <hotel-form
            :modalLink="modalID" 
            :mode="currentFormMode"
            :model="currentResource">
        </hotel-form>
    </div>
</template>

<script>
import HotelForm from "./HotelForm";
import HotelLoading from "../../components/Preloaders/HotelLoading";
import listMixin from "../../mixins/listMixin";
import {mapGetters} from "vuex";

export default {
    data() {
        return {
            fetchJobName: 'fetchHotels',
            deleteJobName: 'deleteHotel',
        }
    },
    computed: {
        ...mapGetters({
            storedResources: 'getHotels',
            resourceMetas: 'getHotelsMeta',
            storedFilters: 'getHotelsFilter'
        }),
        hotelFilters() {
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
        HotelForm,
        HotelLoading,
    },
    mixins: [ listMixin ]
}
</script>

<style scoped>
    table {
        width: 100%;
    }
    td:nth-child(1) { width: 30%;}
    td:nth-child(2) { width: 60%;}
</style>