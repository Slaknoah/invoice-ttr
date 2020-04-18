import Vue from "vue";
import Vuex from "vuex";
import auth from "./modules/auth";
import tourists from './modules/tourists';
import hotels from './modules/hotels';
import services from './modules/services';
import users from './modules/users';
import axios from "../bootstrap/axios";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        roles: [],
        permissions: [],
    },
    actions: {
        fetchRoles({ commit }) {
            return new Promise((resolve, reject) =>  {
                axios
                    .get('/roles')
                    .then(res => {
                        commit('SET_ROLES', res.data);
                        resolve(res.data);
                    })
                    .catch(error => reject(error));
            }); 
        },
        fetchPermissions({ commit }) {
            return new Promise((resolve, reject) =>  {
                axios
                    .get('/permissions')
                    .then(res => {
                        commit('SET_PERMISSIONS', res.data);
                        resolve(res.data);
                    })
                    .catch(error => reject(error));
            }); 
        },
    },
    mutations: {
        SET_ROLES(state, payload) {
            state.roles = payload;
        },
        SET_PERMISSIONS(state, payload) {
            state.permissions = payload;
        },
    },
    getters: {
        getRoles(state) {
            return state.roles;
        },
        getPermissions(state) {
            return state.permissions;
        }
    },
    modules: {
        auth,
        tourists,
        hotels,
        services,
        users
    },
    strict: process.env.NODE_ENV !== "production"
});