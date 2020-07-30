require('./bootstrap');
require('./vendor');
window.Vue = require('vue');

import VueCookies from "vue-cookies";
import { permissions, utils } from "./mixins/globalMixins";
import errorHandlerMixin from "./mixins/errorHandlerMixin";
import router from "./router";
import store from "./store";
import VuePageTransition from "vue-page-transition";

import App from './components/App';

// PROJECT: OTHER
import "./bootstrap/config";
import i18n from "./bootstrap/i18n";


// Vue cookies
VueCookies.config("7d");
Vue.use(VueCookies);

Vue.use(VuePageTransition);

// Vue Mixins
Vue.mixin(permissions);
Vue.mixin(utils);
Vue.mixin(errorHandlerMixin);


const app = new Vue({
    el: '#app',
    router,
    i18n,
    store,
    components: { App },
    mounted() {
        $('.tooltipped').tooltip();
        $('select').formSelect();
    },
});
