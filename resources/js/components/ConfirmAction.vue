<template>
    <BaseModal :link="modalLink" @modalOpened="setFormData"> 
        <div class="modal-content">
            <h5>{{ message }}</h5>
            <slot></slot>
        </div>
        <div class="modal-footer">
            <a href="JavaScript:Void(0);" class="modal-close green waves-effect waves-green btn" @click.prevent="$emit('agreed')"><i class="material-icons">check</i> Yes</a>
            <a href="JavaScript:Void(0);" class="modal-close red waves-effect waves-red btn" @click.prevent="$emit('disagreed')"><i class="material-icons">close</i> No</a>
        </div>
    </BaseModal>
</template>

<script>
export default {
    name: "ConfirmAction",
    props: { 
        modalLink: String,
        message: {
            type: String,
            default: "Are you sure you want to do this action?"
        }
    },
    methods: {
        setFormData() {
            // this.name = this.model.name;
        },
    },
}
</script>

<style scoped>
    .modal-close { display: inline-flex }
    .modal-close i { margin-right: 5px; }
</style>