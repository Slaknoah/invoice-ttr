<template>
    <header>
        <div class="navbar navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    <!--TODO Get settings on pageload to fill exchange rates below -->
                    <span v-show="isLoggedIn" class="currencies">1$ - <span id="usd">  </span> ₸ / 1€ - <span id="eur"> </span> ₸</span>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class=" right hide-on-med-and-down">
                        <template v-if="isLoggedIn">
                            <navigation-item :to="{name: 'dashboard', params: { lang: $i18n.locale }}">{{ $t('nav.statistics') }}</navigation-item>
                            <navigation-item :to="{name: 'create_order', params: { lang: $i18n.locale }}">{{ $t('nav.create_order') }}</navigation-item>
                            <navigation-item :to="{name: 'orders', params: { lang: $i18n.locale }}">{{ $t('nav.orders') }}</navigation-item>
                            <navigation-item :to="{name: 'tourists', params: { lang: $i18n.locale }}">{{ $t('nav.tourists') }}</navigation-item>
                            <navigation-item :to="{name: 'hotels', params: { lang: $i18n.locale }}">{{ $t('nav.hotels') }}</navigation-item>
                            <navigation-item :to="{name: 'services', params: { lang: $i18n.locale }}">{{ $t('nav.services') }}</navigation-item>
                            <!-- <navigation-item :to="{name: 'services'}">Услуги</navigation-item>
                            <navigation-item :to="{name: 'managers'}">Менеджеры</navigation-item> -->
                            <li>
                                <a class="dropdown-trigger waves-effect waves-block waves-light" data-target="notifications">
                                    <i class="material-icons">notifications_none</i><span class="notification-badge red">5</span>
                                </a>
                                <ul class="dropdown-content" id="notifications" >
                                    <li>
                                        <h6>NOTIFICATIONS<span class="new badge red">5</span></h6>
                                    </li>
                                    <li class="divider"></li>
                                    <li >
                                        <a href="#!">
                                            <span class="material-icons cyan-text">add_shopping_cart</span> 
                                            A new order has been placed!
                                        </a>
                                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
                                    </li>
                                    <li >
                                        <a href="#!"><span class="material-icons red-text">stars</span> Completed the task</a>
                                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
                                    </li>
                                    <li >
                                        <a href="#!"><span class="material-icons teal-text">settings</span> Settings updated</a>
                                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
                                    </li>
                                    <li >
                                        <a href="#!"><span class="material-icons deep-orange-text">today</span> Director meeting started</a>
                                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
                                    </li>
                                    <li >
                                        <a href="#!"><span class="material-icons amber-text">trending_up</span> Generate monthly report</a>
                                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
                                    </li>
                                </ul>
                            </li>
                        </template>

                        <li class="hide-on-med-and-down">
                            <a class="waves-effect waves-block waves-light dropdown-trigger" href="javascript:void(0);" data-target="translation-dropdown"><span class="flag-icon" :class="currentLangFlag"></span></a>
                            <ul class="dropdown-content" id="translation-dropdown"  style="">
                                <li ><a  @click.prevent="setLocale('en')" class="grey-text text-darken-1"><i class="flag-icon flag-icon-gb"></i> English</a></li>
                                <li ><a  @click.prevent="setLocale('ru')" class="grey-text text-darken-1"><i class="flag-icon flag-icon-ru"></i> Русский</a></li>
                            </ul>
                        </li>
                        <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);" @click="toggleFullScreen"><i class="material-icons">settings_overscan</i></a></li>
                    
                        <li v-show="isLoggedIn && issetAuthUser">
                            <a class="user-menu dropdown-trigger waves-effect waves-light" data-target="user_menu">
                                <img :src="getAuthUser.avatar" class="user-menu-avatar">
                                <span>{{ getAuthUser.name }}</span><i class="material-icons right">keyboard_arrow_down</i>
                            </a>
                            <ul v-show="isLoggedIn" id="user_menu" class="dropdown-content">
                                <navigation-item :to="{name: 'profile', params: { lang: $i18n.locale }}"><i class="material-icons">person</i>{{ $t('nav.profile') }}</navigation-item>
                                <navigation-item to="/settings"><i class="material-icons">settings</i>Настройки</navigation-item>
                                <navigation-item to="/requisites"><i class="material-icons">payment</i>Реквизиты компании</navigation-item>
                                <navigation-item to="/providers"><i class="material-icons">list_alt</i>Список поставщиков</navigation-item>
                                <navigation-item to="/hotel_statuses"><i class="material-icons">hotel</i>Статусы отеля</navigation-item>
                                <navigation-item to="/payment_statuses"><i class="material-icons">attach_money</i>Статусы платежа</navigation-item>
                                <navigation-item :to="{name: 'users', params: { lang: $i18n.locale }}"><i class="material-icons">supervisor_account</i>{{ $t('nav.users') }}</navigation-item>
                                <li class="divider"></li>
                                <li>
                                    <router-link :to="{name: 'logout', params: { lang: $i18n.locale }}"><i class="material-icons">exit_to_app</i>Выход</router-link>
                                </li>
                            </ul>
                        </li>

                        <template v-if="!isLoggedIn">
                            <navigation-item :to="{name: 'login', params: { lang: $i18n.locale }}">{{ $t("nav.login") }}</navigation-item>
                            <navigation-item :to="{name: 'register', params: { lang: $i18n.locale }}">{{ $t("nav.register") }}</navigation-item>
                        </template>
                    </ul>
                </div>
            </nav>
        </div>
        <ul class="sidenav" id="mobile-demo">
            <navigation-item :to="{name: 'dashboard', params: { lang: $i18n.locale }}">{{ $t('nav.statistics') }}</navigation-item>
            <navigation-item :to="{name: 'invoices', params: { lang: $i18n.locale }}">{{ $t('nav.orders') }}</navigation-item>
            <navigation-item :to="{name: 'create_invoice', params: { lang: $i18n.locale }}">{{ $t('nav.invoice') }}</navigation-item>
            <navigation-item :to="{name: 'tourists', params: { lang: $i18n.locale }}">{{ $t('nav.tourists') }}</navigation-item>
            <!-- <navigation-item :to="{name: 'hotels'}">Отели</navigation-item>
            <navigation-item :to="{name: 'services'}">Услуги</navigation-item>
            <navigation-item :to="{name: 'managers'}">Менеджеры</navigation-item> -->
        </ul>
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
            logout() {
                this.$store.dispatch("logout").then(() => {
                    this.$router.push("/login");
                });
            },
            toggleFullScreen() {
                if (
                    (document.fullScreenElement && document.fullScreenElement !== null) ||
                    (!document.mozFullScreen && !document.webkitIsFullScreen)
                ) {
                    if (document.documentElement.requestFullScreen) {
                        document.documentElement.requestFullScreen();
                    } else if (document.documentElement.mozRequestFullScreen) {
                        document.documentElement.mozRequestFullScreen();
                    } else if (document.documentElement.webkitRequestFullScreen) {
                        document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                    }else if (document.documentElement.msRequestFullscreen) {
                        if (document.msFullscreenElement) {
                        document.msExitFullscreen();
                        } else {
                        document.documentElement.msRequestFullscreen(); 
                        }
                    }
                } else {
                    if (document.cancelFullScreen) {
                        document.cancelFullScreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitCancelFullScreen) {
                        document.webkitCancelFullScreen();
                    }
                }
            },
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
            var dropdown_options = {
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