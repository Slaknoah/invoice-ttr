<template>
    <div class="error">
        <div v-for="(error, index) in errors" :key="index" class="error-text">{{ error }}</div>
    </div>          
</template>

<script>
export default {
    props: {
        errors: Array
    }
}
</script>