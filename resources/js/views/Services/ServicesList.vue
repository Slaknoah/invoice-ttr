<template>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h4 class="title">{{ $t('services.title') }}</h4>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <BaseBreadcrumb/>
                </div>
            </div>
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
                    <tbody  v-if="!services.length" class="loading">
                        <tr v-for="index in 5" :key="index">
                            <td colspan="3">
                                <ServiceLoading/>
                            </td>
                        </tr>
                    </tbody>

                    <transition-group tag="tbody" v-else name="list-item" >
                        <tr 
                            v-for="(service, index) in services" 
                            :href="'#' + modalID" 
                            :key="service.id" 
                            :data-index="index"
                            class="modal-trigger"
                            @click="editModel(service)"
                            >
                            <td>{{ service.name }}</td>
                            <td class="actions" @click.prevent="deleteService(service.id, $event)">
                                <button class="btn-flat waves-effect" type="submit" name="action">
                                    <i class="material-icons">delete</i>
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
        <ServiceForm 
            :modalLink="modalID" 
            :mode="currentFormMode"
            :model="currentModel"
        />
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import ServiceForm from "./ServiceForm";
import ServiceLoading from "../../components/Preloaders/ServiceLoading";
import listMixin from "../../mixins/listMixin";

export default {
    data() {
        return {
            services: [],
        }
    },
    methods: {
        fetchServices() {
            this.$store.dispatch('fetchServices', this.currentPage)
                .then(res => {
                    this.services = res;    
                })
                .catch(error => this.showError(error.response));
        },
        deleteService(id, event) {
            this.$store.dispatch('deleteService', id)
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
            'getServices',
            'getServicesLinks',
            'getServicesMeta'
        ]),
        pageCount() { 
            if(this.getServicesMeta)
                return Math.ceil(this.getServicesMeta.total / this.getServicesMeta.per_page);
        },
    },
    created() { 
        if(this.getServices.length) {
            this.services = this.getServices;
        }
        else {
            if(this.$route.query.page)
                this.currentPage = parseInt(this.$route.query.page);
            this.fetchServices();    
        }
    },
    watch: {
        currentPage() {
            this.services = [];
            this.fetchServices();
        }
    },
    components: { 
        ServiceForm,
        ServiceLoading
    },
    mixins: [ listMixin ]
}
</script>