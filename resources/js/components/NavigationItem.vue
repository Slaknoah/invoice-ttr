<template>
    <router-link :to="to" v-slot="{ href, navigate, isExactActive }" v-if="isRouterLink">
        <li :class="[isExactActive && 'active']"
            v-bind="$attrs">
            <a :class="[isExactActive && 'active', linkClass, hasSubmenu && 'collapsible-header']"
               :href="href"
               @click="navigate">
                <slot name="route-content"></slot>
            </a>

            <div class="collapsible-body" v-if="hasSubmenu">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <slot name="route-submenu"></slot>
                </ul>
            </div>
        </li>
    </router-link>
    <li class="bold"
        v-else
        v-bind="$attrs">
        <a class="waves-effect waves-cyan "
           :class="[linkClass, hasSubmenu && 'collapsible-header']"
           href="JavaScript:void(0)">
            <slot name="route-content"></slot>
        </a>

        <div class="collapsible-body" v-if="hasSubmenu">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                <slot name="route-submenu"></slot>
            </ul>
        </div>
    </li>
</template>

<script>
    export default  {
        inheritAttrs: false,
        props: {
            to: [Object, String],
            hasSubmenu: Boolean,
            linkClass: String,
            isRouterLink: {
                type: Boolean,
                default: true
            }
        }
    }
</script>