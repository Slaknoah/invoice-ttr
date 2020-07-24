<template>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h4 class="title">{{ $t('services.title') }}</h4>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <base-breadcrumb></base-breadcrumb>
                </div>
            </div>
            <resource-filter :filters="serviceFilters" @filtersChange="filterChanged"></resource-filter>
        </div>
        <div class="container frame">
            <table class="editable">
                <thead>
                    <tr>
                        <th>{{ $t('services.name') }}</th>
                        <th style="width:50px"></th>
                    </tr>
                </thead>

                <transition name="fade" mode="out-in">
                    <tbody  v-if="!resources.length && isFetching" class="loading">
                        <tr v-for="index in 5" :key="index">
                            <td colspan="3">
                                <ServiceLoading/>
                            </td>
                        </tr>
                    </tbody>

                    <tbody v-else-if="!resources.length && !isFetching">
                    <tr>
                        <td colspan="3" class="center-align">
                            <h4>No resource found!</h4>
                        </td>
                    </tr>
                    </tbody>

                    <transition-group tag="tbody" v-else name="list-item" >
                        <tr 
                            v-for="(service, index) in resources"
                            :href="'#' + modalID" 
                            :key="service.id" 
                            :data-index="index"
                            class="modal-trigger"
                            @click="editResource(service)"
                            >
                            <td>{{ service.name }}</td>
                            <td class="actions" @click.prevent="deleteResource(service.id, $event)">
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
        <service-form
            :modalLink="modalID" 
            :mode="currentFormMode"
            :model="currentResource">
        </service-form>
    </div>
</template>

<script>
import ServiceForm from "./ServiceForm";
import ServiceLoading from "../../components/Preloaders/ServiceLoading";
import listMixin from "../../mixins/listMixin";

export default {
    data() {
        return {
            fetchJobName: 'fetchServices',
            deleteJobName: 'deleteService'
        }
    },
    computed: {
        storedResources() { return this.$store.getters.getServices },
        resourceMetas() { return this.$store.getters.getServicesMeta },
        serviceFilters() {
            return [
                {
                    type: 'text',
                    name: 'search',
                    label: 'Find service by name',
                }
            ]
        }
    },
    components: { 
        ServiceForm,
        ServiceLoading
    },
    mixins: [ listMixin ]
}
</script>