import Vue from "vue";
import VueRouter from "vue-router";
import i18n from '../bootstrap/i18n';

const Login = () => import(/* webpackChunkName: "login" */  "../views/Auth/Login");
const Register = () => import(/* webpackChunkName: "register" */  "../views/Auth/Register");
const Logout = () => import(/* webpackChunkName: "logout" */  "../views/Auth/Logout");
const ForgotPassword = () => import(/* webpackChunkName: "forgot-password" */  "../views/Auth/ForgotPassword");
const ResetPassword = () => import(/* webpackChunkName: "reset-password" */  "../views/Auth/ResetPassword");

const Users = () => import(/* webpackChunkName: "users-list" */  "../views/Users/UsersList");

const DashboardStatistics = () => import(/* webpackChunkName: "dashboard-statistics" */  "../views/DashboardStatistics");
const InvoicesList = () => import(/* webpackChunkName: "invoice-list" */  "../views/Orders/OrdersList");
const InvoiceCreate = () => import(/* webpackChunkName: "invoice-create" */  "../views/Orders/OrdersCreate");
const TouristsList = () => import(/* webpackChunkName: "tourists-list" */  "../views/Tourists/TouristsList");
const LocationsList = () => import(/* webpackChunkName: "tourists-list" */  "../views/Locations/LocationsList");
const HotelsList = () => import(/* webpackChunkName: "hotels-list" */  "../views/Hotels/HotelsList");
const ServicesList = () => import(/* webpackChunkName: "services-list" */  "../views/Services/ServicesList");
const NotFound = () => import(/* webpackChunkName: "notfound" */  "../views/404");
const Profile = () => import(/* webpackChunkName: "profile" */  "../views/Profile");

Vue.use(VueRouter);

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
            guest: true,
            transition: 'flip-y'
        }
    },
    {
        path: "forgot-password",
        name: "forgot-password",
        component: ForgotPassword,
        meta: { 
            guest: true,
            transition: 'flip-y'
         }
    },
    {
        path: "reset-password",
        name: "reset-password",
        component: ResetPassword,
        meta: { 
            guest: true,
            transition: 'flip-x'
        }
    },
    {
        path: "register",
        name: "register",
        component: Register,
        meta: { 
            guest: true,
            transition: 'flip-y'
        }
    },
    {
        path: "logout",
        name: "logout",
        component: Logout,
        meta: {
            requiresAuth: true,
            transition: 'fade'
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
            breadCrumb: "User profile",
        }
    },
    {
        path: "invoices",
        name: "invoice_list",
        component: InvoicesList,
        meta: {
            requiresAuth: true,
            isManager: true,
            breadCrumb: "Invoices",
        },
        children: [
            {
                path: "add",
                name: "invoice_add",
                component: InvoiceCreate,
                meta: {
                    requiresAuth: true,
                    isManager: true,
                    breadCrumb: "Add invoice",
                }
            }
        ]
    },
    {
        path: "locations",
        name: "locations",
        component: LocationsList,
        meta: {
            requiresAuth: true,
            isManager: true,
            hasFloatingBtn: true,
            btnTitle: i18n.tc('nav.locations_add'),
            modalID: 'add_location',
            breadCrumb: "Locations",
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
            btnTitle: i18n.tc('nav.tourist_add'),
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
            btnTitle: i18n.tc('nav.hotel_add'),
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
                if (user.role.name === "administrator") {
                    next();
                } else {
                    M.toast({html: i18n.tc('responses.unauthorized')});
                    next({ name: "dashboard", lang: language });
                }
            }
            else if (to.matched.some(record => record.meta.isManager)) {
                if (user.role.name === "administrator" || user.role.name === "manager") {
                    next();
                } else {
                    M.toast({html: i18n.tc('responses.unauthorized')});
                    next({ name: "dashboard", lang: language });
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

export default router;
