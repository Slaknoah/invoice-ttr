<template>
    <vue-content-loading v-bind="$attrs" :primary="primary" :secondary="secondary" :speed="speed">
      <slot></slot>
    </vue-content-loading>
</template>

<script>
    import VueContentLoading from 'vue-content-loading';

    export default {
        inheritAttrs: false,
        props: { 
            primary: {
                type: String,
                default: "#98a6ad"
            },
            secondary: {
                type: String,
                default: "#f2f2f2"
            },
            speed: {
                type: Number,
                default: 1
            },
        },
        components: {
            VueContentLoading,
        },
    };
</script>