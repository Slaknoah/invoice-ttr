<template>
    <div :id="link" class="sidenav list-sidenav">
        <slot></slot>
    </div>
</template>

<script>
import { EventBus } from '../event-bus';
export default {
    props: { link: String },
    mounted() {
        const modal = this,
            $sidenav = $('.sidenav.list-sidenav');

        $sidenav.sidenav({
            edge: 'right',
            onCloseEnd() { modal.$emit('modalClosed'); },
            onOpenStart() { modal.$emit('modalOpened'); }
        });

        EventBus.$on("CLOSE_MODAL", modalID => $sidenav.sidenav('close') );
    }
}
</script>

<style scoped lang="scss">
    @import "../../assets/css/pages/app-sidebar.css";
    @import "../../assets/css/pages/app-todo.css";

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

    .list-sidenav{
        /* contact sidebar */
        box-shadow: -8px 0 18px 0 rgba(25,42,70,0.13);
        width: 24.8rem;
        background-color: white;
        height: 100vh;
        position: fixed;
        top: 0;

        // Close Icon
        .card{
            box-shadow: none;
            .card-header{
                justify-content: space-between;
                align-items: center;
                .close-icon{
                    cursor: pointer;
                    i{
                        font-size: 1.2rem;
                    }
                    &:focus{
                        outline: none;
                    }
                }
            }
        }

        .btn--blue {
            background-color: #3f51b5;
        }
    }

</style>