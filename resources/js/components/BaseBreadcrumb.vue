<template>
    <div id="breadcrumbs-wrapper">
        <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item" v-for="(crumb, index) in crumbs" :key="index">
                <template v-if="index == (crumbs.length - 1)">{{crumb.text}}</template>
                <router-link v-else :to="crumb.to">{{crumb.text}}</router-link>
            </li>
        </ol>
    </div>
</template>


<script>
export default {
    computed: {
        crumbs() {
            let pathArray = this.$route.path.split("/");
            pathArray.shift(); // Remove first slash;
            let lang  = pathArray.shift();
            let component = this;
            let breadcrumbs = pathArray.reduce((breadcrumbArray, path, id) => {
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
            };

            return breadcrumbs;
        }
    }
}
</script>