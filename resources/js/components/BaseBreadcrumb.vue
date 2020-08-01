<template>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{crumbs[crumbs.length - 1].text}}</span></h5>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item" v-for="(crumb, index) in crumbs" :key="index">
                            <template v-if="index == (crumbs.length - 1)">{{crumb.text}}</template>
                            <router-link v-else :to="crumb.to">{{crumb.text}}</router-link>
                        </li>
                    </ol>
                </div>
                <div class="col s2 m6 l6">
                    <transition name="fade">
                        <a :href="modalID"
                           class="display-flex align-items-center btn waves-effect waves-light border-round z-depth-4 breadcrumbs-btn right sidenav-trigger"
                           v-if="hasFloatingBtn"
                           @click="triggerModal">
                            <i class="material-icons">add</i>
                            <span class="hide-on-small-only">{{ btnTitle }}</span>
                        </a>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { EventBus } from '../event-bus';

export default {
    computed: {
        crumbs() {
            let pathArray = this.$route.path.split("/");
            pathArray.shift(); // Remove first slash;
            let lang  = pathArray.shift();
            let component = this;
            let breadcrumbs = pathArray.reduce((breadcrumbArray, path, id) => {
                if(path.length)
                    breadcrumbArray.push({
                        to: {
                            name: component.$route.matched[(id + 1)].name,
                            params: { lang: lang }
                        },
                        text: component.$route.matched[(id + 1)].meta.breadCrumb || path
                    });

                return breadcrumbArray;
            }, []);

            if(process.env.MIX_ADD_HOME_TO_BREADCRUMB) { 
                breadcrumbs.unshift({
                    to: {
                        name: 'dashboard',
                        params: { lang: lang }
                    },
                    text: "Dashboard"
                })
            }

            return breadcrumbs;
        },
        hasFloatingBtn() { return this.$route.meta.hasFloatingBtn; },
        btnTitle() { return this.$route.meta.btnTitle; },
        modalID() { return '#' + this.$route.meta.modalID; }
    },
    methods: {
        triggerModal() { EventBus.$emit('ADD_MODAL_TRIGGERED') }
    }
}
</script>