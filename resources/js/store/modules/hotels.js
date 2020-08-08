import axios from "../../bootstrap/axios";

const state = {
    hotels: [],
    hotelsLinks: {},
    hotelsMeta: {},
    hotelsFilter: {}
};

const mutations = {
    SET_HOTELS(state, payload) {
        state.hotels = payload;
    },
    SET_HOTELS_LINKS(state, payload) {
        state.hotelsLinks = payload;
    },
    SET_HOTELS_META(state, payload) {
        state.hotelsMeta = payload;
    },
    ADD_NEW_HOTEL(state, payload) {
        if (state.hotels.length)
            state.hotels.unshift(payload);
    },
    UPDATE_HOTEL(state, payload) {
        if(state.hotels.length) {
            let index = state.hotels.findIndex(obj => obj.id == payload.id);
            if (index !== -1) {
                Object.assign(state.hotels[index], payload);
            }
        } 
    },
    DELETE_HOTEL(state, payload) {
        if (state.hotels.length) {
            let index = state.hotels.map( hotel => {return hotel.id}).indexOf(payload);
            state.hotels.splice(index, 1);
        }
    },
    SET_HOTELS_FILTER(state, payload) {
        Object.assign(state.hotelsFilter, payload);
    },
};

const actions = {
    fetchHotels({ commit }, filter) {
        let queryString = "/hotels?";
        if (parseInt(filter.page)) queryString += `&page=${filter.page}`;
        if (filter.search) queryString += `&search[field][0]=name&search[query]=${filter.search}`;
        return new Promise((resolve, reject) =>  {
            axios
                .get(queryString)
                .then(res => {
                    commit('SET_HOTELS', res.data.data);
                    commit('SET_HOTELS_LINKS', res.data.links);
                    commit('SET_HOTELS_META', res.data.meta);
                    commit('SET_HOTELS_FILTER', filter);

                    resolve(res.data.data);
                })
                .catch(error => reject(error));
        }); 
    },
    addHotel({ commit }, parameters) {
        return new Promise((resolve, reject) => {
            axios
                .post('/hotels', parameters)
                .then(res => {
                    commit("ADD_NEW_HOTEL", res.data.response);
                    resolve(res.data);
                })
                .catch(error => reject(error));
        })
    },
    updateHotel({ commit }, parameters) {
        return new Promise((resolve, reject) => {
            axios
                .put(`/hotels/${parameters.id}`, parameters)
                .then(res => {
                    commit("UPDATE_HOTEL", res.data.response);
                    resolve(res.data);
                })
                .catch(error => reject(error));
        })
    },
    deleteHotel({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios
                .delete(`/hotels/${id}`)
                .then(res => {
                    commit("DELETE_HOTEL", id);
                    resolve(res.data.message);
                })
                .catch(error => reject(error));
        })
    },
};

const getters = {
    getHotels(state) { 
        return state.hotels;
    },
    getHotelsLinks(state) {
        return state.hotelsLinks;
    },
    getHotelsMeta(state) {
        return state.hotelsMeta;
    },
    getHotelsFilter(state) {
        return state.hotelsFilter;
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};

