<template>
    <div>
        <the-navigation></the-navigation>

        <section id="content">
            <router-view></router-view>
            <transition name="fade">
                <div class="fixed-action-btn" v-if="hasFloatingBtn">
                    <a :href="modalID" @click="triggerModal" class="btn-floating btn-large red waves-effect waves-light modal-trigger sidenav-trigger">
                        <i class="large material-icons">add</i>
                    </a>
                </div>
            </transition>
        </section>
    </div>
</template>

<script>
import TheNavigation from "./TheNavigation";
import { EventBus } from '../event-bus';
// import TransitionPage from "./TransitionPage";
export default {
    name: 'App',
    components: {
        TheNavigation,
        // TransitionPage
    },
    methods: {
        triggerModal() {EventBus.$emit('ADD_MODAL_TRIGGERED') }
    },
    computed: {
        hasFloatingBtn() { return this.$route.meta.hasFloatingBtn; },
        modalID() { return '#' + this.$route.meta.modalID; }
    },
    created() {
        /**
         * Get all necessary data for app init
         */

        // Roles
        if(this.$store.getters.isLoggedIn) {
            this.$store.dispatch('fetchRoles');
        }
    },
    mounted() {
        const dropdown_options = {
            'coverTrigger':false,
            'alignment':'right',
            'constrainWidth':false,
            'hover': true
        };
        $('.dropdown-trigger').dropdown(dropdown_options);
    },
}
</script>
