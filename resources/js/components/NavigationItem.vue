<template>
    <router-link :to="to" v-slot="{ href, navigate, isExactActive }">
        <li :class="[isExactActive && 'active', hasSubmenu && 'dropdown-trigger']"
            v-bind="$attrs"
            :data-target="subMenuID">
            <a :href="href" @click="navigate">
                <slot name="route-content"></slot>
            </a>

            <ul class="dropdown-content" v-if="hasSubmenu" :id="subMenuID">
                <slot name="route-submenu">
                </slot>
            </ul>
        </li>
    </router-link>
</template>

<script>
    export default  {
        inheritAttrs: false,
        data() {
            return {
                subMenuID: Math.floor(Math.random() *  99999)
            }
        },
        props: {
            to: [Object, String],
            text: String,
            hasSubmenu: Boolean
        }
    }
</script>