<template>
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark sidenav-active-rounded">
        <div class="brand-sidebar">
            <h1 class="logo-wrapper">
                <a class="brand-logo darken-1" href="index.html">
                    <img class="hide-on-med-and-down"
                         src="../../assets/images/logo/materialize-logo-color.png"
                         alt="invy logo" />
                    <img class="show-on-medium-and-down hide-on-med-and-up"
                         src="../../assets/images/logo/materialize-logo.png"
                         alt="invy logo" />
                    <span class="logo-text hide-on-med-and-down">Invy</span>
                </a>
                <a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a>
            </h1>
        </div>

        <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow"
            id="slide-out"
            data-menu="menu-navigation"
            data-collapsible="menu-accordion">
            <navigation-item :to="{name: 'dashboard', params: { lang: $i18n.locale }}" class="bold" link-class="waves-effect waves-cyan">
                <template #route-content>
                    <i class="material-icons">settings_input_svideo</i>
                    <span class="menu-title">{{ $t('nav.dashboard') }}</span>
                </template>
            </navigation-item>

            <li class="navigation-header"><a class="navigation-header-text">Applications</a></li>

            <navigation-item :is-router-link="false" class="bold" link-class="waves-effect waves-cyan" has-submenu>
                <template #route-content>
                    <i class="material-icons">receipt</i>
                    <span class="menu-title">{{ $t('nav.invoice') }}</span>
                </template>
                <template #route-submenu>
                    <navigation-item :to="{name: 'invoice_list', params: { lang: $i18n.locale }}">
                        <template #route-content>
                            <i class="material-icons">radio_button_unchecked</i>{{ $t('nav.invoice_list') }}
                        </template>
                    </navigation-item>

                    <navigation-item :to="{name: 'invoice_add', params: { lang: $i18n.locale }}">
                        <template #route-content>
                            <i class="material-icons">radio_button_unchecked</i>{{ $t('nav.invoice_add') }}
                        </template>
                    </navigation-item>
                </template>
            </navigation-item>

            <li class="navigation-header"><a class="navigation-header-text">Tables</a></li>

            <navigation-item :to="{name: 'tourists', params: { lang: $i18n.locale }}" class="bold" link-class="waves-effect waves-cyan">
                <template #route-content>
                    <i class="material-icons">accessibility_new</i>
                    <span class="menu-title">{{ $t('nav.tourists') }}</span>
                </template>
            </navigation-item>

            <navigation-item :is-router-link="false" class="bold" link-class="waves-effect waves-cyan" has-submenu>
                <template #route-content>
                    <i class="material-icons">domain</i>
                    <span class="menu-title">{{ $t('nav.hotels') }}</span>
                </template>
                <template #route-submenu>
                    <navigation-item :to="{name: 'hotels', params: { lang: $i18n.locale }}">
                        <template #route-content>
                            <i class="material-icons">radio_button_unchecked</i>{{ $t('nav.hotels_list') }}
                        </template>
                    </navigation-item>

                    <navigation-item to="#">
                        <template #route-content>
                            <i class="material-icons">radio_button_unchecked</i>{{ $t('nav.hotels_reservation') }}
                        </template>
                    </navigation-item>

                    <navigation-item to="#">
                        <template #route-content>
                            <i class="material-icons">radio_button_unchecked</i>{{ $t('nav.hotels_status') }}
                        </template>
                    </navigation-item>
                </template>
            </navigation-item>

            <navigation-item :to="{name: 'services', params: { lang: $i18n.locale }}" class="bold" link-class="waves-effect waves-cyan">
                <template #route-content>
                    <i class="material-icons">work</i>
                    <span class="menu-title">{{ $t('nav.services') }}</span>
                </template>
            </navigation-item>

            <navigation-item :is-router-link="false" class="bold" link-class="waves-effect waves-cyan" has-submenu>
                <template #route-content>
                    <i class="material-icons">face</i>
                    <span class="menu-title">{{ $t('nav.users') }}</span>
                </template>
                <template #route-submenu>
                    <navigation-item :to="{name: 'users', params: { lang: $i18n.locale }}">
                        <template #route-content>
                            <i class="material-icons">radio_button_unchecked</i>{{ $t('nav.users_list') }}
                        </template>
                    </navigation-item>

                    <navigation-item :to="{name: 'users', params: { lang: $i18n.locale }}">
                        <template #route-content>
                            <i class="material-icons">radio_button_unchecked</i>{{ $t('nav.users_add') }}
                        </template>
                    </navigation-item>
                </template>
            </navigation-item>
        </ul>
        <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
</template>

<script>
    import NavigationItem from "./NavigationItem";
    export default {
        name: "TheNavigation",
        components: {NavigationItem}
    }
</script>

<style scoped>

</style>