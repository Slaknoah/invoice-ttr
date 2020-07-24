import axios from "../../bootstrap/axios";

const state = {
    tourists: [],
    touristsLinks: {},
    touristsMeta: {},
};

const mutations = {
    SET_TOURISTS(state, payload) {
        state.tourists = payload;
    },
    SET_TOURISTS_LINKS(state, payload) {
        state.touristsLinks = payload;
    },
    SET_TOURISTS_META(state, payload) {
        state.touristsMeta = payload;
    },
    ADD_NEW_TOURIST(state, payload) {
        if (state.tourists.length)
            state.tourists.unshift(payload);
    },
    UPDATE_TOURIST(state, payload) {
        if(state.tourists.length) {
            let index = state.tourists.findIndex(obj => obj.id == payload.id);
            if (index !== -1) {
                Object.assign(state.tourists[index], payload);
            }
        } 
    },
    DELETE_TOURIST(state, payload) {
        if (state.tourists.length) {
            let index = state.tourists.map( tourist => {return tourist.id}).indexOf(payload);
            state.tourists.splice(index, 1);
        }
    }
};

const actions = {
    fetchTourists({ commit }, filter) {
        let queryString = "/tourists?";
        if (parseInt(filter.page)) queryString += `&page=${filter.page}`;
        if (filter.search) queryString +=
            `&search[field][0]=name&search[field][1]=email&search[field][2]=phone&search[query]=${filter.search}`;
        return new Promise((resolve, reject) =>  {
            axios
                .get(queryString)
                .then(res => {
                    commit('SET_TOURISTS', res.data.data);
                    commit('SET_TOURISTS_LINKS', res.data.links);
                    commit('SET_TOURISTS_META', res.data.meta);
                    resolve(res.data.data);
                })
                .catch(error => reject(error));
        }); 
    },
    addTourist({ commit }, parameters) {
        return new Promise((resolve, reject) => {
            axios
                .post('/tourists', parameters)
                .then(res => {
                    commit("ADD_NEW_TOURIST", res.data.response);
                    resolve(res.data.message);
                })
                .catch(error => reject(error));
        })
    },
    updateTourist({ commit }, parameters) {
        return new Promise((resolve, reject) => {
            axios
                .put(`/tourists/${parameters.id}`, parameters)
                .then(res => {
                    commit("UPDATE_TOURIST", res.data.response);
                    resolve(res.data.message);
                })
                .catch(error => reject(error));
        })
    },
    deleteTourist({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios
                .delete(`/tourists/${id}`)
                .then(res => {
                    commit("DELETE_TOURIST", id);
                    resolve(res.data.message);
                })
                .catch(error => reject(error));
        })
    },
};

const getters = {
    getTourists(state) {
        return state.tourists;
    },
    getTouristsLinks(state) {
        return state.touristsLinks;
    },
    getTouristsMeta(state) {
        return state.touristsMeta;
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};

