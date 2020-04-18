<template>
    <loading-interface :width="808" :height="30">
      <rect x="0" y="3" rx="4" ry="4" width="250" height="24" />
      <circle cx="764" cy="15" r="12" />
    </loading-interface>
</template>

<script>
    import LoadingInterface from './LoadingInterface';
    export default {
        components: {
            LoadingInterface,
        },
    };
</script>