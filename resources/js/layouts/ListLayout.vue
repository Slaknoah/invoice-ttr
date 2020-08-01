<template>
    <section class="users-list-wrapper section">
        <div class="users-list-filter">
            <slot name="filter"></slot>
        </div>

        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="responsive-table">
                        <slot name="table"></slot>
                        <slot name="pagination"></slot>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style lang="scss">
    @import "../../assets/vendors/data-tables/css/jquery.dataTables.css";
    @import "../../assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.css";
    @import "../../assets/css/pages/page-users.css";

    .users-list-wrapper {
        margin-bottom: 5em;
    }

    .loading__item {
        padding-bottom: 1em;
    }

    .loading {
        width: inherit;
    }

    .is-loading {
        opacity: 0;
    }
</style>