<template>
    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
                <div class="nav-wrapper">
                    <div class="header-search-wrapper hide-on-med-and-down">
                        <i class="material-icons">search</i>
                        <input class="header-search-input z-depth-2"
                               type="text"
                               name="Search"
                               placeholder="Explore Invy">
                        <ul class="search-list collection display-none"></ul>
                    </div>
                    <ul class="navbar-list right">
                        <li class="dropdown-language">
                            <a class="waves-effect waves-block waves-light translation-button"
                               href="javascript:void(0);"
                               data-target="translation-dropdown">
                                <span class="flag-icon" :class="currentLangFlag"></span>
                            </a>
                        </li>

                        <li class="hide-on-med-and-down">
                            <a class="waves-effect waves-block waves-light toggle-fullscreen"
                               href="javascript:void(0);">
                                <i class="material-icons">settings_overscan</i>
                            </a>
                        </li>

                        <li class="hide-on-large-only search-input-wrapper">
                            <a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);">
                                <i class="material-icons">search</i>
                            </a>
                        </li>

                        <li>
                            <a class="waves-effect waves-block waves-light notification-button"
                               href="javascript:void(0);"
                               data-target="notifications-dropdown">
                                <i class="material-icons">
                                    notifications_none<small class="notification-badge">5</small>
                                </i>
                            </a>
                        </li>

                        <li>
                            <a class="waves-effect waves-block waves-light profile-button"
                               href="javascript:void(0);"
                               data-target="profile-dropdown">
                                <span class="avatar-status avatar-online">
                                    <img :src="getAuthUser.avatar" :alt="getAuthUser.name"><i></i>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a class="waves-effect waves-block waves-light sidenav-trigger"
                               href="javascript:void(0);"
                               data-target="slide-out-right">
                                <i class="material-icons">format_indent_increase</i>
                            </a>
                        </li>
                    </ul>

                    <!-- translation-button-->
                    <ul class="dropdown-content" id="translation-dropdown">
                        <li class="dropdown-item" @click.prevent="setLocale('en')">
                            <a class="grey-text text-darken-1" href="#">
                                <i class="flag-icon flag-icon-gb"></i> {{ $t('lang.english') }}
                            </a>
                        </li>

                        <li class="dropdown-item" @click.prevent="setLocale('ru')">
                            <a class="grey-text text-darken-1" href="#">
                                <i class="flag-icon flag-icon-ru"></i> {{ $t('lang.russian') }}
                            </a>
                        </li>
                    </ul>

                    <!-- notifications-dropdown-->
                    <ul class="dropdown-content" id="notifications-dropdown">
                        <li>
                            <h6>NOTIFICATIONS<span class="new badge">5</span></h6>
                        </li>
                        <li class="divider"></li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new order has been placed!</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle teal small">settings</span> Settings updated</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle deep-orange small">today</span> Director meeting started</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle amber small">trending_up</span> Generate monthly report</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
                        </li>
                    </ul>

                    <!-- profile-dropdown-->
                    <ul class="dropdown-content" id="profile-dropdown">
                        <navigation-item :to="{name: 'profile', params: { lang: $i18n.locale }}"
                                         link-class="grey-text text-darken-1">
                            <template #route-content>
                                <i class="material-icons">person_outline</i>{{ $t('nav.profile') }}
                            </template>
                        </navigation-item>

                        <li class="divider"></li>

                        <navigation-item :to="{name: 'logout', params: { lang: $i18n.locale }}"
                                         link-class="grey-text text-darken-1">
                            <template #route-content>
                                <i class="material-icons">keyboard_tab</i> {{ $t('auth.logout') }}
                            </template>
                        </navigation-item>
                    </ul>
                </div>
                <nav class="display-none search-sm">
                    <div class="nav-wrapper">
                        <form id="navbarForm">
                            <div class="input-field search-input-sm">
                                <input class="search-box-sm mb-0" type="search" required="" id="search" placeholder="Explore Invy" data-search="template-list">
                                <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                                <ul class="search-list collection search-list-sm display-none"></ul>
                            </div>
                        </form>
                    </div>
                </nav>
            </nav>
        </div>
    </header>
</template>

<script>
    import NavigationItem from "./NavigationItem";
    import { mapGetters } from 'vuex';
    import axios from "../bootstrap/axios";

    export default {
        components: {
            NavigationItem
        },
        methods: {
            setLocale(locale) {
                if(locale !== this.$i18n.locale) {
                    this.$i18n.locale = locale;
                    axios.defaults.headers.common["Content-language"] = locale;
                    this.$router.push({
                        params: { lang: locale }
                    })
                }
            }
        },
        computed: {
            ...mapGetters([
                'isLoggedIn',
                'getAuthUser'
            ]),
            issetAuthUser() {
                return !this.$isEmptyObject(this.getAuthUser);
            },
            currentLangFlag() {
                return (this.$i18n.locale == 'ru') ? 'flag-icon-ru' : 'flag-icon-gb';
            }
        },
        mounted() {
            const dropdown_options = {
                'coverTrigger':false,
                'alignment':'right',
                'constrainWidth':false
            };
            $('.dropdown-trigger').dropdown(dropdown_options);
            $('.sidenav').sidenav();
        }
    }

    
</script>

<style>
.navbar #notifications h6 {
    color: #90a4ae;
}
.navbar #notifications li
{
    font-size: 1rem;
    padding: 8px 16px;
}
.navbar #notifications li > a
{
    font-size: 1.1rem;
    font-weight: 300;
    padding: 0;
}
.navbar #notifications li > a:hover {
    background-color: unset;
}
.navbar #notifications li:hover a {
    color: #fff;
}
.navbar #notifications li > a > span
{
    font-size: 1.2rem;
    position: relative;
    top: 4px;
    display: inline-block;
    margin-right: 5px;
}
.navbar #notifications li > time
{
    font-size: .8rem;
    font-weight: 400;
    margin-left: 26px;
    color: #90a4ae;
}
.navbar #notifications li.divider
{
    padding: 0;
}
</style>