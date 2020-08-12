<template>
    <div class="card-panel" v-if="filters.length">
        <div class="row">
            <template v-for="filter in filters">
                <base-select
                        v-if="filter.type === 'select' && !filter.hide"
                        parentClass= "col s12 m6 l3"
                        :options= "filter.options"
                        :label= "filter.label"
                        @input= "emitData"
                        v-model= "filter.value">
                </base-select>
                <base-input
                        v-else-if= "filter.type === 'text'"
                        v-model= "filter.value"
                        :label= "filter.label"
                        type= "text"
                        @input= "emitData"
                        parentClass= "col s12 m6 l3">
                </base-input>
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