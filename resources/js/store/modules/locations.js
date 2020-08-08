import axios from "../../bootstrap/axios";

const state = {
    locations: [],
    locationsLinks: {},
    locationsFilter: {},
    locationsMeta: {},
};

const mutations = {
    SET_LOCATIONS(state, payload) {
        state.locations = payload;
    },
    SET_LOCATIONS_LINKS(state, payload) {
        state.locationsLinks = payload;
    },
    SET_LOCATIONS_META(state, payload) {
        state.locationsMeta = payload;
    },
    ADD_NEW_LOCATION(state, payload) {
        if (state.locations.length)
            state.locations.unshift(payload);
    },
    UPDATE_LOCATION(state, payload) {
        if(state.locations.length) {
            let index = state.locations.findIndex(obj => obj.id == payload.id);
            if (index !== -1) {
                Object.assign(state.locations[index], payload);
            }
        }
    },
    DELETE_LOCATION(state, payload) {
        if (state.locations.length) {
            let index = state.locations.map( location => {return location.id}).indexOf(payload);
            state.locations.splice(index, 1);
        }
    },
    SET_LOCATIONS_FILTER(state, payload) {
        Object.assign(state.locationsFilter, payload);
    },
};

const actions = {
    fetchLocations({ commit }, filter) {
        let queryString = "/locations?";
        if (parseInt(filter.page)) queryString += `&page=${filter.page}`;
        return new Promise((resolve, reject) =>  {
            axios
                .get(queryString)
                .then(res => {
                    console.log(res);
                    commit('SET_LOCATIONS', res.data.data);
                    commit('SET_LOCATIONS_LINKS', res.data.links);
                    commit('SET_LOCATIONS_META', res.data.meta);
                    commit("SET_LOCATIONS_FILTER", filter);

                    resolve(res.data.data);
                })
                .catch(error => reject(error));
        });
    },
    addLocation({ commit }, parameters) {
        return new Promise((resolve, reject) => {
            axios
                .post('/locations', parameters)
                .then(res => {
                    commit("ADD_NEW_LOCATION", res.data.response);
                    resolve(res.data);
                })
                .catch(error => reject(error));
        })
    },
    updateLocation({ commit }, parameters) {
        return new Promise((resolve, reject) => {
            axios
                .put(`/locations/${parameters.id}`, parameters)
                .then(res => {
                    commit("UPDATE_LOCATION", res.data.response);
                    resolve(res.data);
                })
                .catch(error => reject(error));
        })
    },
    deleteLocation({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios
                .delete(`/locations/${id}`)
                .then(res => {
                    commit("DELETE_LOCATION", id);
                    resolve(res.data.message);
                })
                .catch(error => reject(error));
        })
    },
};

const getters = {
    getLocations(state) {
        return state.locations;
    },
    getLocationsLinks(state) {
        return state.locationsLinks;
    },
    getLocationsMeta(state) {
        return state.locationsMeta;
    },
    getLocationsFilter(state) {
        return state.locationsFilter;
    },
};

export default {
    state,
    getters,
    mutations,
    actions
};

