<template>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h4 class="title">{{ $t('hotels.title') }}</h4>
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
                        <th>{{ $t('hotels.name') }}</th>
                        <th>{{ $t('hotels.accommodations') }}</th>
                        <th style="width:50px"></th>
                    </tr>
                </thead>

                <transition name="fade" mode="out-in">
                    <tbody  v-if="!hotels.length" class="loading">
                        <tr v-for="index in 5" :key="index">
                            <td colspan="3">
                                <HotelLoading/>
                            </td>
                        </tr>
                    </tbody>

                    <transition-group tag="tbody" v-else name="list-item" >
                        <tr 
                            v-for="(hotel, index) in hotels" 
                            :href="'#' + modalID" 
                            :key="hotel.id" 
                            :data-index="index"
                            class="sidenav-trigger"
                            @click="editModel(hotel)"
                            >
                            <td>{{ hotel.name }}</td>
                            <td>
                                <div class="chip" v-for="(accommodation, i) in hotel.accommodations" :key="i">
                                    {{ accommodation }}
                                </div>
                            </td>
                            <td class="actions" @click.prevent="deleteHotel(hotel.id, $event)">
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
        <HotelForm 
            :modalLink="modalID" 
            :mode="currentFormMode"
            :model="currentModel"
        />
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import HotelForm from "./HotelForm";
import HotelLoading from "../../components/Preloaders/HotelLoading";
import listMixin from "../../mixins/listMixin";

export default {
    data() {
        return {
            hotels: [],
        }
    },
    methods: {
        fetchHotels() {
            this.$store.dispatch('fetchHotels', this.currentPage)
                .then(res => {
                    this.hotels = res;    
                })
                .catch(error => {console.log(error); this.showError(error.response)});
        },
        deleteHotel(id, event) {
            this.$store.dispatch('deleteHotel', id)
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
            'getHotels',
            'getHotelsLinks',
            'getHotelsMeta'
        ]),
        pageCount() { 
            if(this.getHotelsMeta)
                return Math.ceil(this.getHotelsMeta.total / this.getHotelsMeta.per_page);
        },
    },
    created() { 
        if(this.getHotels.length) {
            this.hotels = this.getHotels;
        }
        else {
            if(this.$route.query.page)
                this.currentPage = parseInt(this.$route.query.page);
            this.fetchHotels();    
        }
    },
    watch: {
        currentPage() {
            this.hotels = [];
            this.fetchHotels();
        }
    },
    components: { 
        HotelForm,
        HotelLoading
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