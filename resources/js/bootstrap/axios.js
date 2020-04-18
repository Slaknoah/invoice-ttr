import Axios from "axios";
import i18n from '../bootstrap/i18n';

/**
 * Axios config
 */
const axios = Axios.create({
    baseURL: process.env.MIX_API_URL,
    timeout: 10000
});

axios.defaults.headers.post["Content-Type"] =
    "application/x-www-form-urlencoded";
    axios.defaults.headers.post["Accept"] = "application/json";

// Add token to all header globally
const token = window.$cookies.get("token");

if (token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}

if (i18n.locale) {
    axios.defaults.headers.common["Content-language"] = i18n.locale;
}

axios.interceptors.request.use(config => {
    return config;
});


axios.interceptors.response.use(response => {
    return response;
}, error => {
    return Promise.reject(error);
});

export default axios;