export default {
    props: {
        modalLink: String,
        model: Object,
        mode: { type: String, default: 'create' }
    },
    computed: {
        isCreateMode() {
            return this.mode === 'create';
        }
    },
    methods: {
        resetFormData() {
            Object.assign(this.$data, this.$options.data())
        }
    },
}