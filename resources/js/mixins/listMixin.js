import { EventBus } from '../event-bus';

export default {
    data() {
        return {
            currentModel: {},
            currentFormMode: 'create',
            currentPage: 1,
            isFetching: false,
        }
    },
    methods: {
        editModel(val) {
            this.currentModel = val;
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
    },
    computed: {
        modalID() { return this.$route.meta.modalID; },
    },
    created() {
        EventBus.$on('ADD_MODAL_TRIGGERED', () => { 
            this.currentModel = {};
            this.currentFormMode = "create";
        });
    },
}