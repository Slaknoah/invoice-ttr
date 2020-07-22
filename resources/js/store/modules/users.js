import axios from "../../bootstrap/axios";

const state = {
    users: [],
    usersLinks: {},
    usersMeta: {},
    usersFilter: {
        role: 0,
    },
    currentPage: 1,
};

const mutations = {
    SET_USERS(state, payload) {
        state.users = payload;
    },
    SET_USERS_LINKS(state, payload) {
        state.usersLinks = payload;
    },
    SET_USERS_META(state, payload) {
        state.usersMeta = payload;
    },
    ADD_NEW_USER(state, payload) {
        if (state.users.length)
            state.users.unshift(payload);
    },
    UPDATE_USER(state, payload) {
        if(state.users.length) {
            let index = state.users.findIndex(obj => obj.id == payload.id);
            if (index !== -1) {
                Object.assign(state.users[index], payload);
            }
        } 
    },
    DELETE_USER(state, payload) {
        if (state.users.length) {
            let index = state.users.map( user => {return user.id}).indexOf(payload);
            state.users.splice(index, 1);
        }
    },
    SET_USERS_FILTER(state, payload) {
        Object.assign(state.usersFilter, payload);
    },
};

const actions = {
    fetchUsers({ commit }, filter) {
        let queryString = "/users";
        if (parseInt(filter.page)) queryString += `?page=${filter.page}`;
        if (parseInt(filter.role)) queryString += `&role=${filter.role}`;
        if (filter.verified) queryString += `&is_verified=${filter.verified}`;
        if (filter.search) queryString += `&search[field][0]=name&search[field][1]=email&search[field][2]=role.name&search[query]=${filter.search}`;

        return new Promise((resolve, reject) =>  {
            axios
                .get(queryString)
                .then(res => {
                    commit('SET_USERS', res.data.data);
                    commit('SET_USERS_LINKS', res.data.links);
                    commit('SET_USERS_META', res.data.meta);
                    commit("SET_USERS_FILTER", filter);

                    resolve(res.data.data);
                })
                .catch(error => reject(error));
        }); 
    },
    addUser({ commit }, parameters) {
        return new Promise((resolve, reject) => {
            axios
                .post('/users', parameters)
                .then(res => {
                    console.log(res.data.response);
                    commit("ADD_NEW_USER", res.data.response);
                    resolve(res.data.message);
                })
                .catch(error => reject(error));
        })
    },
    updateUser({ commit }, parameters) {
        return new Promise((resolve, reject) => {
            axios
                .post(`/users/${parameters.id}`, parameters.data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    commit("UPDATE_USER", res.data.response);
                    resolve(res.data.message);
                })
                .catch(error => reject(error));
        })
    },
    deleteUser({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios
                .delete(`/users/${id}`)
                .then(res => {
                    commit("DELETE_USER", id);
                    resolve(res.data.message);
                })
                .catch(error => reject(error));
        })
    },
};

const getters = {
    getUsers(state) {
        return state.users;
    },
    getUsersLinks(state) {
        return state.usersLinks;
    },
    getUsersMeta(state) {
        return state.usersMeta;
    },
    getUsersFilter(state) {
        return state.usersFilter;
    },

};

export default {
    state,
    getters,
    mutations,
    actions
};

