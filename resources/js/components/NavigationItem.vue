<template>
    <router-link :to="to" v-slot="{ href, navigate, isActive, isExactActive }">
        <li :class="[isExactActive && 'active']" id="menu-item">
            <a :href="href" @click="navigate"><slot></slot></a>
        </li>
    </router-link>
</template>

<script>
    export default  {
        props: {
            to: [Object, String],
            text: String
        }
    }
</script>