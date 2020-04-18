<template>
    <loading-interface :width="808" :height="30">
      <rect x="0" y="3" rx="4" ry="4" width="150" height="24" />
      <rect x="180" y="3" rx="4" ry="4" width="107" height="24" />
      <rect x="317" y="3" rx="4" ry="4" width="157" height="24" />
      <rect x="504" y="3" rx="4" ry="4" width="210" height="24" />
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