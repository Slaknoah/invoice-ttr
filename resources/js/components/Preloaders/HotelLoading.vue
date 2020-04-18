<template>
    <loading-interface :width="808" :height="142">
      <rect x="5" y="44" rx="4" ry="4" width="186" height="24" />
      <rect x="5" y="72" rx="4" ry="4" width="136" height="24" />
      <rect x="250" y="10" rx="4" ry="4" width="386" height="32" />
      <rect x="250" y="50" rx="4" ry="4" width="250" height="32" />
      <rect x="505" y="50" rx="4" ry="4" width="186" height="32" />
      <rect x="250" y="90" rx="4" ry="4" width="356" height="32" />
      <circle cx="764" cy="71" r="12" />
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