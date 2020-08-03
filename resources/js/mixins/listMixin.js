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
            tableInitialized: false,
            dataTableOptions: {}
        }
    },
    methods: {
        fetchResources() {
            this.filters.page = this.currentPage;

            this.$store.dispatch(this.fetchJobName, this.filters)
                .then(res => {
                    this.resources = res;
                    this.drawResourcesToTable();
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
        drawResourcesToTable() {
            if(this.tableInitialized) {
                this.dataTable.clear();
                this.dataTable.rows.add(this.resources.map(resource => {
                    return this.constructTableObject(resource)
                }));
                const component = this;

                this.dataTable.draw();

                this.dataTable.rows().eq(0).each( function ( index ) {
                    const row = component.dataTable.row( index );
                    const rowData = row.data();
                    const resource = component.resources.find(resource => resource.id === rowData[0]);
                    row.node().querySelector('.delete-btn')
                        .addEventListener('click', e => component.deleteResource(rowData[0], e));

                    row.node().querySelector('.edit-btn')
                        .addEventListener('click', () => component.editResource(resource));
                } );
            }
        },
        drawResourceToTable(resource) {
            const node = this.dataTable.row.add( this.constructTableObject( resource ) ).draw(false).node();

            node.querySelector( '.delete-btn' )
                .addEventListener( 'click', e => this.deleteResource( resource.id, e ) );

            node.querySelector( '.edit-btn' )
                .addEventListener( 'click', () => this.editResource( resource ) );
        },
        updateResourceToTable(resource) {
            const component = this;

            this.dataTable.rows().eq(0).each(index => {
                const row = component.dataTable.row(index);

                if (parseInt(row.data()[0]) === parseInt(resource.id)) {
                    row.data( component.constructTableObject(resource) );

                    row.node().querySelector( '.delete-btn' )
                        .addEventListener( 'click', e => this.deleteResource( resource.id, e ) );

                    row.node().querySelector( '.edit-btn' )
                        .addEventListener( 'click', () => this.editResource( resource ) );
                }
            });
            this.dataTable.draw();
        },
        initTable() {
            const $listDataTable = $("#list-datatable");
            // datatable initialization
            if ($listDataTable.length > 0) {
                this.dataTable = $listDataTable.DataTable(this.dataTableOptions);
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