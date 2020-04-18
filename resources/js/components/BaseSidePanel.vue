<template>
    <div :id="link" class="sidenav">
        <div class="sidenav-cont">
            <slot></slot>
            <span class="sidenav-close sidenav-close-icon"><i class="material-icons">close</i></span>
        </div>
    </div>
</template>

<script>
import { EventBus } from '../event-bus';
export default {
    props: { link: String },
    mounted() {
        const modal = this,
            $sidenav = $('.sidenav');

        $sidenav.sidenav({
            edge: 'right',
            onCloseEnd() { modal.$emit('modalClosed'); },
            onOpenStart() { modal.$emit('modalOpened'); }
        });

        EventBus.$on("CLOSE_MODAL", modalID => $sidenav.sidenav('close') );
    }
}
</script>

<style scoped>
    .sidenav-cont { 
        position: relative; 
        padding: 0px 15px;
    }
    .sidenav-close-icon {
        position: absolute;
        top: 10px;
        right: 20px;
        cursor: pointer;
    }

    .sidenav .divider {
        margin-bottom: 2em;
    }
</style>