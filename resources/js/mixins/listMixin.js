import { EventBus } from '../event-bus';
import ResourceFilter from "../components/ResourceFilter";

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
            updateJobName: ''
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
        pageCount() {
            if(this.resourceMetas)
                return Math.ceil(this.resourceMetas.total / this.resourceMetas.per_page);
        },
    },
    watch: {
        currentPage() {
            this.resources = [];
            this.fetchResources();
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
    },
    components: {
        ResourceFilter
    }
}