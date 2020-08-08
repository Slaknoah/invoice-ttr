<template>
    <loading-interface :width="808" :height="30">
        <rect x="0" y="3" rx="4" ry="4" width="30" height="24" />
        <rect x="60" y="3" rx="4" ry="4" width="200" height="24" />
        <rect x="300" y="3" rx="4" ry="4" width="157" height="24" />
        <rect x="504" y="3" rx="4" ry="4" width="180" height="24" />
        <circle cx="720" cy="15" r="12" />
        <circle cx="764" cy="15" r="12" />
    </loading-interface>
</template>

<script>
    import LoadingInterface from './LoadingInterface';
    export default {
        name: "TableLoading",
        components: {
            LoadingInterface,
        },
    }
</script>