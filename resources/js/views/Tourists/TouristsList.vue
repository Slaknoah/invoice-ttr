<template>
    <div class="content">
        <div class="container">
             <div class="row">
                <div class="col s12 m6 l6">
                    <h4 class="title">{{ $t('tourists.title') }}</h4>
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
                        <th>{{ $t('tourists.name') }}</th>
                        <th>{{ $t('tourists.phone') }}</th>
                        <th>{{ $t('tourists.email') }}</th>
                        <th>{{ $t('tourists.note') }}</th>
                        <th style="width:50px"></th>
                    </tr>
                </thead>

                <transition name="fade" mode="out-in">
                    <tbody  v-if="!tourists.length" class="loading">
                        <tr v-for="index in 5" :key="index">
                            <td colspan="5">
                                <TouristLoading/>
                            </td>
                        </tr>
                    </tbody>

                    <transition-group tag="tbody" v-else name="list-item" >
                        <tr 
                            v-for="(tourist, index) in tourists" 
                            :href="'#' + modalID" 
                            :key="tourist.id" 
                            :data-index="index"
                            class="sidenav-trigger"
                            @click="editModel(tourist)"
                            >
                            <td>{{ tourist.name }}</td>
                            <td>{{ tourist.phone }}</td>
                            <td>{{ tourist.email }}</td>
                            <td >{{ $shortenText(tourist.description, 100) }}</td>
                            <td class="actions" @click.prevent="deleteTourist(tourist.id, $event)">
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
        <TouristForm 
            :modalLink="modalID" 
            :mode="currentFormMode"
            :model="currentModel"
        />
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import TouristForm from "./TouristForm";
import TouristLoading from "../../components/Preloaders/TouristLoading";
import listMixin from "../../mixins/listMixin";

export default {
    data() {
        return {
            tourists: [],
        }
    },
    methods: {
        fetchTourists() {
            this.$store.dispatch('fetchTourists', this.currentPage)
                .then(res => {
                    this.tourists = res;    
                })
                .catch(error => this.showError(error.response));
        },
        deleteTourist(id, event) {
            this.$store.dispatch('deleteTourist', id)
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
            'getTourists',
            'getTouristsLinks',
            'getTouristsMeta'
        ]),
        pageCount() { 
            if(this.getTouristsMeta)
                return Math.ceil(this.getTouristsMeta.total / this.getTouristsMeta.per_page);
        },
    },
    created() { 
        if(this.getTourists.length) {
            this.tourists = this.getTourists;
        }
        else {
            if(this.$route.query.page)
                this.currentPage = parseInt(this.$route.query.page);
            this.fetchTourists();    
        }
    },
    watch: {
        currentPage() {
            this.tourists = [];
            this.fetchTourists();
        }
    },
    components: { 
        TouristForm,
        TouristLoading
    },
    mixins: [ listMixin ]
}
</script>

<style scoped>
    table {
    }
</style>