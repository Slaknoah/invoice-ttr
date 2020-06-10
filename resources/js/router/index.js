import Vue from "vue";
import VueRouter from "vue-router";
import NProgress from "nprogress";
import i18n from '../bootstrap/i18n';

const Login = () => import(/* webpackChunkName: "login" */  "../views/Auth/Login");
const Register = () => import(/* webpackChunkName: "register" */  "../views/Auth/Register");
const Logout = () => import(/* webpackChunkName: "logout" */  "../views/Auth/Logout");
const ForgotPassword = () => import(/* webpackChunkName: "forgotpassword" */  "../views/Auth/ForgotPassword");
const ResetPassword = () => import(/* webpackChunkName: "resetpassword" */  "../views/Auth/ResetPassword");

const Users = () => import(/* webpackChunkName: "resetpassword" */  "../views/Users/UsersList");

const DashboardStatistics = () => import(/* webpackChunkName: "dashboardstatistics" */  "../views/DashboardStatistics");
const InvoicesList = () => import(/* webpackChunkName: "invoicelist" */  "../views/Orders/OrdersList");
const InvoiceCreate = () => import(/* webpackChunkName: "invoicecreate" */  "../views/Orders/OrdersCreate");
const TouristsList = () => import(/* webpackChunkName: "touristslist" */  "../views/Tourists/TouristsList");
const HotelsList = () => import(/* webpackChunkName: "touristslist" */  "../views/Hotels/HotelsList");
const ServicesList = () => import(/* webpackChunkName: "touristslist" */  "../views/Services/ServicesList");
const NotFound = () => import(/* webpackChunkName: "notfound" */  "../views/404");
const Profile = () => import(/* webpackChunkName: "profile" */  "../views/Profile");

Vue.use(VueRouter);

NProgress.configure({ easing: 'ease-in', speed: 500, showSpinner: false, trickleSpeed: 200  });

const localizedRoutes = [
    {
        path: "/",
        name: "dashboard",
        component: DashboardStatistics,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: "login",
        name: "login",
        component: Login,
        meta: {
            guest: true
        }
    },
    {
        path: "forgot-password",
        name: "forgot-password",
        component: ForgotPassword,
        meta: { 
            guest: true
         }
    },
    {
        path: "reset-password",
        name: "reset-password",
        component: ResetPassword,
        meta: { 
            guest: true
        }
    },
    {
        path: "register",
        name: "register",
        component: Register,
        meta: { 
            guest: true
        }
    },
    {
        path: "logout",
        name: "logout",
        component: Logout,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "users",
        name: "users",
        component: Users,
        meta: {
            requiresAuth: true,
            isAdmin: true,
            breadCrumb: "Users",
            hasFloatingBtn: true,
            modalID: 'add_user',
        }
    },
    {
        path: "profile",
        name: "profile",
        component: Profile,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: "orders",
        name: "orders",
        component: InvoicesList,
        meta: {
            requiresAuth: true,
            isManager: true
        }
    },
    {
        path: "orders/create",
        name: "create_order",
        component: InvoiceCreate,
        meta: {
            requiresAuth: true,
            isManager: true
        }
    },
    {
        path: "tourists",
        name: "tourists",
        component: TouristsList,
        meta: {
            requiresAuth: true,
            isManager: true,
            hasFloatingBtn: true,
            modalID: 'add_tourist',
            breadCrumb: "Tourists",
        }
    },
    {
        path: "hotels",
        name: "hotels",
        component: HotelsList,
        meta: {
            requiresAuth: true,
            hasFloatingBtn: true,
            modalID: 'add_hotel',
            breadCrumb: "Hotels",
        }
    },
    {
        path: "services",
        name: "services",
        component: ServicesList,
        meta: {
            requiresAuth: true,
            hasFloatingBtn: true,
            modalID: 'add_service',
            breadCrumb: "Services",
        }
    },
    {
        path: '*',
        name: 'not-found',
        component: NotFound
    }
];

const routes = [
    {
        path: '/',
        redirect: `/${i18n.locale}`
    },
    {
        path: '/:lang',
        component: {
            template: '<vue-page-transition name="fade-in-up"><router-view></router-view></vue-page-transition>'
        },
        children: localizedRoutes
    }
];

const router = new VueRouter({ 
    mode: "history",
    base: process.env.APP_URL,
    routes: routes,
});


router.beforeEach((to, from, next) => {
    if(to.name) {
        NProgress.start();
    }
    // use the language from the routing param or default language
    let language = to.params.lang;

    if ( !['en','ru'].includes(language) ) {
        return next('en');
    }

    // set the current language for i18n.
    if ( i18n.locale !== language ) {
        i18n.locale = language
    }

    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (window.$cookies.get("token") == null) {
            next({
                name: "login",
                params: { nextUrl: to.fullPath, lang: language }
            });
        } else {
            let user = window.$cookies.get("auth_user");

            if (to.matched.some(record => record.meta.isAdmin)) {
                if (user.role.name == "administrator") {
                    next();
                } else {
                    M.toast({html: i18n.tc('responses.unauthorized')});
                    next({ name: "dashboard", lang: language });
                    NProgress.done();
                }
            }
            else if (to.matched.some(record => record.meta.isManager)) {
                if (user.role.name == "administrator" || user.role.name == "manager") {
                    next();
                } else {
                    M.toast({html: i18n.tc('responses.unauthorized')});
                    next({ name: "dashboard", lang: language });
                    NProgress.done();
                }
            }
            else {
                next();
            }
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (window.$cookies.get("token") == null) {
            next();
        } else {
            next({ name: "dashboard", lang: language });
        }
    } else {
        next();
    }
});

router.afterEach((to, from) => {
    NProgress.done();
});

export default router;
