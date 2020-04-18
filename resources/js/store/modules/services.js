import axios from "../../bootstrap/axios";

const state = {
    services: [],
    servicesLinks: {},
    servicesMeta: {},
};

const mutations = {
    SET_SERVICES(state, payload) {
        state.services = payload;
    },
    SET_SERVICES_LINKS(state, payload) {
        state.servicesLinks = payload;
    },
    SET_SERVICES_META(state, payload) {
        state.servicesMeta = payload;
    },
    ADD_NEW_SERVICE(state, payload) {
        if (state.services.length)
            state.services.unshift(payload);
    },
    UPDATE_SERVICE(state, payload) {
        if(state.services.length) {
            let index = state.services.findIndex(obj => obj.id == payload.id);
            if (index !== -1) {
                Object.assign(state.services[index], payload);
            }
        } 
    },
    DELETE_SERVICE(state, payload) {
        if (state.services.length) {
            let index = state.services.map( service => {return service.id}).indexOf(payload);
            state.services.splice(index, 1);
        }
    }
};

const actions = {
    fetchServices({ commit }, pageNumber) {
        let query = pageNumber ? `?page=${pageNumber}` : '';
        return new Promise((resolve, reject) =>  {
            axios
                .get(`/services${query}`)
                .then(res => {
                    commit('SET_SERVICES', res.data.data);
                    commit('SET_SERVICES_LINKS', res.data.links);
                    commit('SET_SERVICES_META', res.data.meta);
                    resolve(res.data.data);
                })
                .catch(error => reject(error));
        }); 
    },
    addService({ commit }, parameters) {
        return new Promise((resolve, reject) => {
            axios
                .post('/services', parameters)
                .then(res => {
                    commit("ADD_NEW_SERVICE", res.data.response);
                    resolve(res.data.message);
                })
                .catch(error => reject(error));
        })
    },
    updateService({ commit }, parameters) {
        return new Promise((resolve, reject) => {
            axios
                .put(`/services/${parameters.id}`, parameters)
                .then(res => {
                    commit("UPDATE_SERVICE", res.data.response);
                    resolve(res.data.message);
                })
                .catch(error => reject(error));
        })
    },
    deleteService({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios
                .delete(`/services/${id}`)
                .then(res => {
                    commit("DELETE_SERVICE", id);
                    resolve(res.data.message);
                })
                .catch(error => reject(error));
        });
    },
};

const getters = {
    getServices(state) {
        return state.services;
    },
    getServicesLinks(state) {
        return state.servicesLinks;
    },
    getServicesMeta(state) {
        return state.servicesMeta;
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};

