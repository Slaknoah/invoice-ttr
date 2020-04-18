<template>
    <loading-interface :width="808" :height="32">
        <rect x="0" y="3" rx="4" ry="4" width="20" height="24" />
        <circle cx="60" cy="16" r="16" />
        <rect x="80" y="3" rx="4" ry="4" width="150" height="24" />
        <rect x="280" y="3" rx="4" ry="4" width="90" height="24" />
        <rect x="420" y="3" rx="4" ry="4" width="30" height="24" />
        <rect x="540" y="3" rx="4" ry="4" width="140" height="24" />
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