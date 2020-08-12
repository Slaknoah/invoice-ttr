import axios from "../../bootstrap/axios";

const state = {
    locations: [],
    countries: [],
    countryCities: [],
    locationsLinks: {},
    locationsFilter: {},
    locationsMeta: {},
};

const mutations = {
    SET_LOCATIONS(state, payload) {
        state.locations = payload;
    },
    SET_COUNTRIES(state, payload) {
        state.countries = payload;
    },
    SET_COUNTRY_CITIES(state, payload) {
        state.countryCities = payload;
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
            let index = state.locations.findIndex(obj => obj.id == payload.id   );
            if (index !== -1) {
                Object.assign( state.locations[index], payload );
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

const locationFetch = function( filter ) {
    let queryString = "/locations?";
    if (parseInt(filter.page)) queryString += `&page=${filter.page}`;
    if (filter.type) queryString += `&where_and[0][field]=type&where_and[0][value]=${ filter.type }`;
    if (parseInt(filter.parent_id)) queryString += `&where_and[1][field]=parent_id&where_and[1][value]=${ filter.parent_id }`;
    return new Promise((resolve, reject) =>  {
        axios
            .get(queryString)
            .then(res => {
                resolve(res.data);
            })
            .catch(error => reject(error));
    });
};

const actions = {
    fetchLocations( { commit }, filter ) {
        return new Promise((resolve, reject) =>  {
            locationFetch( filter ).then( data => {
                commit('SET_LOCATIONS', data.data);
                commit('SET_LOCATIONS_LINKS', data.links);
                commit('SET_LOCATIONS_META', data.meta);
                commit("SET_LOCATIONS_FILTER", filter);
                resolve(data.data);
            }).catch( error => {
                reject( error )
            });
        });
    },
    fetchCountries( { commit } ) {
        return new Promise( ( resolve, reject ) => {
            locationFetch( {
                type: 'country'
            }).then( data => {
                commit('SET_COUNTRIES', data.data);
                resolve( data.data );
            }).catch( error => reject( error ) )
        } )
    },
    getCountryCities( { commit }, country_id ) {
        return new Promise( ( resolve, reject ) => {
            locationFetch( {
                type: 'city',
                parent_id: country_id
            }).then( data => {
                commit('SET_COUNTRY_CITIES', data.data);
                resolve( data.data );
            }).catch( error => reject( error ) )
        } )
    },
    addLocation( { commit }, parameters ) {
        return new Promise(( resolve, reject ) => {
            axios
                .post('/locations', parameters )
                .then(res => {
                    commit( "ADD_NEW_LOCATION", res.data.response );
                    resolve( res.data );
                })
                .catch(error => reject( error ));
        })
    },
    updateLocation( { commit }, parameters ) {
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
    deleteLocation( { commit }, id ) {
        return new Promise((  resolve, reject ) => {
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
    getLocations( state ) {
        return state.locations;
    },
    getCountries( state ) {
        return state.countries;
    },
    getCountryCities( state ) {
        return state.countryCities;
    },
    getLocationsLinks( state ) {
        return state.locationsLinks;
    },
    getLocationsMeta( state ) {
        return state.locationsMeta;
    },
    getLocationsFilter( state ) {
        return state.locationsFilter;
    },
};

export default {
    state,
    getters,
    mutations,
    actions
};

