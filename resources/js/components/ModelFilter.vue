<template>
    <div class="card-panel">
        <div class="row">
            <template v-for="filter in filters">
                <BaseSelect
                        v-if="filter.type === 'select'"
                        parentClass="col s4"
                        :options="filter.options"
                        :label="filter.label"
                        @input="emitData"
                        v-model="filter.value">
                </BaseSelect>
                <BaseInput
                        v-else-if="filter.type === 'text'"
                        v-model="filter.value"
                        :label="filter.label"
                        type="text"
                        parentClass="input-field col s4">
                </BaseInput>
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        methods:{
            emitData() {
                let results = {};

                this.filters.forEach(filter => {
                    results[filter.name] = filter.value;
                });

                this.$emit('filtersChange', results)
            }
        },
        props: {
            filters: {
                type: Array,
                default: () => []
            }
        },
    }
</script>