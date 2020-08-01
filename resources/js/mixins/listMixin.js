import { EventBus } from '../event-bus';
import ResourceFilter from "../components/ResourceFilter";
import 'datatables.net';
import 'datatables.net-responsive';

export default {
    data() {
        return {
            resources: [],
            currentResource: {},
            currentFormMode: 'create',
            currentPage: 1,
            isFetching: false,
            filters: {},
            fetchJobName: '',
            deleteJobName: '',
            updateJobName: '',
            datatable: null,
            tableInitialized: false
        }
    },
    methods: {
        fetchResources() {
            this.filters.page = this.currentPage;

            this.$store.dispatch(this.fetchJobName, this.filters)
                .then(res => {
                    this.resources = res;
                })
                .catch(error => this.showError(error.response));

            this.isFetching = false;
        },
        deleteResource(id, event) {
            this.$store.dispatch(this.deleteJobName, id)
                .then(message => {
                    M.toast({html: message});
                    this.dataTable.row($(event.target).parents('tr'))
                        .remove()
                        .draw(false);
                })
                .catch(error => {
                    this.showError(error.response);
                });
            event.stopPropagation();
        },
        viewResource(resource) {
            this.currentResource = resource;
        },
        editResource(resource) {
            this.currentResource = resource;
            this.currentFormMode = "edit";
        },
        pageChangeHandle(value) {
            switch (value) {
                case "next":
                    this.currentPage += 1;
                    break;
                case "previous":
                    this.currentPage -= 1;
                    break;
                default:
                    this.currentPage = value;
            }
        },
        filterChanged(filtersResult) {
            this.filters = filtersResult;
            this.fetchResources();
        },
        initTable() {
            const $listDataTable = $("#list-datatable");
            // datatable initialization
            if ($listDataTable.length > 0) {
                this.dataTable = $listDataTable.DataTable({
                    responsive: true,
                });
            }
        }
    },
    computed: {
        modalID() { return this.$route.meta.modalID; },
        storedResources() {
            return [];
        },
        resourceMetas() {
            return [];
        },
        storedFilters() {
            return {};
        },
        pageCount() {
            if(this.resourceMetas)
                return Math.ceil(this.resourceMetas.total / this.resourceMetas.per_page);
        },
    },
    watch: {
        currentPage() {
            this.resources = [];
            this.fetchResources();
        },
        resources(newValue) {
            if(newValue.length && !this.tableInitialized) {
                setTimeout(() => {
                    this.initTable();
                }, 1000);
                this.tableInitialized = true;
            }
        }
    },
    created() {
        EventBus.$on('ADD_MODAL_TRIGGERED', () => { 
            this.currentResource = {};
            this.currentFormMode = "create";
        });

        if (this.storedResources.length) {
            this.resources = this.storedResources;
        } else {
            if (this.$route.query.page)
                this.currentPage = parseInt(this.$route.query.page);
            this.fetchResources();
            this.isFetching = true;
        }

        if (this.storedFilters)
            this.filters = {...this.storedFilters};
    },
    components: {
        ResourceFilter
    }
}