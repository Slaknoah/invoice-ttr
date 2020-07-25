<template>
    <div class="content">
        <div class="container">
             <div class="row">
                <div class="col s12 m6 l6">
                    <h4 class="title">{{ $t('tourists.title') }}</h4>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <base-breadcrumb></base-breadcrumb>
                </div>
            </div>
            <resource-filter :filters="touristFilters" @filtersChange="filterChanged"></resource-filter>
        </div>
        <div class="container frame">
            <table class="editable">
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
                            @click="editResource(tourist)"
                            >
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
        <tourist-form
            :modalLink="modalID" 
            :mode="currentFormMode"
            :model="currentResource">
        </tourist-form>
    </div>
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