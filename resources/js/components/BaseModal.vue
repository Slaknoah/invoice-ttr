<template>
    <div :id="link" class="modal">
        <slot></slot>
    </div>
</template>

<script>
import { EventBus } from '../event-bus';
export default {
    props: { link: String },
    mounted() {
        let modal = this;
        $('.modal').modal({
            onCloseEnd() { modal.$emit('modalClosed'); },
            onOpenStart() { modal.$emit('modalOpened'); }
        });

        EventBus.$on("CLOSE_MODAL", modalID => $('.modal').modal('close') );
    }
}
</script>