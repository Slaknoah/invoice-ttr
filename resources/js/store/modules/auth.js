import axios from "../../bootstrap/axios";

const state = {
    token: window.$cookies.get("token") || null,
    refreshToken: window.$cookies.get("refresh_token") || "",
    authUser: window.$cookies.get("auth_user") || {},
    rolesWithPermissions: window.$cookies.get("roles_with_permissions") || []
};

const mutations = {
    SET_ACCESS_TOKEN(state, payload) {
        state.token = payload;
    },
    SET_AUTH_USER(state, payload) {
        state.authUser = payload;
    },
    SET_ROLES_WITH_PERMISSIONS(state, payload) {
        state.rolesWithPermissions = payload;
    },
    LOGOUT_USER(state) {
        state.token = null;
        state.authUser = {};
    }
};

const actions = {
    retrieveToken({ dispatch, commit }, credentials) {
        return new Promise((resolve, reject) => {
            axios
                .post('/login',credentials)
                .then(response => {
                    const token = response.data.access_token,
                        refreshToken = response.data.refresh_token;

                    window.$cookies.set('token', token);
                    window.$cookies.set('refresh_token', refreshToken);
                    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;

                    commit('SET_ACCESS_TOKEN', token);
                    dispatch("getAuthUser")
                        .then(res => {
                            resolve(res);
                        })
                        .catch(err => reject(err))
                })
                .catch(error => {
                    reject(error);
                })
        });
    },
    refreshToken({ dispatch, commit }, credentials) {
        return new Promise((resolve, reject) => {
            axios
                .post('/refresh_token',credentials)
                .then(response => {
                    const token = response.data.access_token,
                        refreshToken = response.data.refresh_token;

                    window.$cookies.set('token', token);
                    window.$cookies.set('refresh_token', refreshToken);
                    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;

                    commit('SET_ACCESS_TOKEN', token);
                    dispatch("getAuthUser")
                        .then(res => {
                            resolve(res);
                        })
                        .catch(err => reject(err));

                })
                .catch(error => {
                    reject(error);
                })
        });
    },
    getAuthUser({ commit }) {
        return new Promise( (resolve, reject) => {
            axios
                .get('/users/me')
                .then(response => {
                    commit('SET_AUTH_USER', response.data);
                    window.$cookies.set('auth_user', response.data);
                    resolve(response.data);
                })
                .catch(error => reject(error));
        } );
    },
    getRolesWithPermissions({ commit }) {
        return new Promise( (resolve, reject) => {
            axios
                .get('/roles')
                .then(response => {
                    commit('SET_ROLES_WITH_PERMISSIONS', response.data);
                    window.$cookies.set('roles_with_permissions', response.data);
                    resolve(response.data);
                })
                .catch(error => reject(error));
        } );
    },
    register({ commit }, user) {
        return new Promise((resolve, reject) => {
            axios
                .post("/register", user)
                .then(res => {
                    const user = res.data;
                    resolve("User registered please log in.");
                })
                .catch(err => {
                    reject(err);
                });
        });
    },
    verifyUser({commit}) {
        return new Promise((resolve, reject) => {
            axios.get('/verification/resend')
                .then(res => {
                    resolve(res.data.message);
                })
                .catch(error => {
                    reject(error);
                })
        })
    },
    destroyToken({commit, getters }) {
        if(getters.isLoggedIn) {
            return new Promise((resolve, reject) => {
                axios.post('/logout')
                    .then(response => {
                        commit("LOGOUT_USER");
                        window.$cookies.remove("token");
                        window.$cookies.remove("auth_user");
                        delete axios.defaults.headers.common["Authorization"];
                        resolve(response);
                    })
                    .catch(error => {
                        commit("LOGOUT_USER");
                        window.$cookies.remove("token");
                        window.$cookies.remove("auth_user");
                        delete axios.defaults.headers.common["Authorization"];

                        reject(error);
                    })
            });
        }
    },
    sendResetLink({commit}, credentials) {
        return new Promise((resolve, reject) => {
            axios.post("/send-reset-link", credentials)
            .then(res => resolve(res))
            .catch(err => reject(err))
        });
    },
    resetPassword({commit}, credentials) {
        return new Promise((resolve, reject) => {
            axios.post("/reset-password", credentials)
            .then(res => resolve(res))
            .catch(err => reject(err));
        });
    },
    changePassword({commit}, credentials) {
        return new Promise((resolve, reject) => {
            axios.post("/change-password", credentials)
            .then(res => resolve(res))
            .catch(err => reject(err));
        });
    },
    updateUserProfile({commit}, userData) {
        return new Promise((resolve, reject) => {
            axios.post('/users/me', userData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(result => {
                    commit('SET_AUTH_USER', result.data.response);
                    window.$cookies.set('auth_user', result.data.response);
                    resolve(result.data.message);
                })
                .catch(error => {
                    reject(error);
                });
        });

    },
    deleteMyAccount({commit}) {
        return new Promise((resolve, reject) => {
            axios
                .delete('/users/me')
                .then(res => {
                    resolve(res.data.message);
                })
                .catch(error => reject(error));
        })
    }
};

const getters = {
    getAuthUser(state, getters) {
        return state.authUser;
    },
    getRefreshToken(state) {
        return state.refreshToken;
    },
    isLoggedIn(state) {
        return !!state.token;
    },
    isAdmin(state) {
        return state.authUser.isAdmin;
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
