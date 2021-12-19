import axios from "axios";

// initial state
const state = () => ({
    isLoggedIn: false,
    isAdmin: false,
    accessToken: null,
    refreshToken: null,
    email: null,
});

// getters
const getters = {};

// actions
const actions = {
    async initialize({ commit }) {
        const accessToken = window.sessionStorage.getItem("accessToken");
        const refreshToken = window.sessionStorage.getItem("refreshToken");
        const email = window.sessionStorage.getItem("email");

        if (accessToken && refreshToken && email) {
            commit("setState", {
                isLoggedIn: true,
                isAdmin: false,
                accessToken,
                refreshToken,
                email,
            });
            const response = await axios.get("/api/isAdmin", {
                headers: {
                    Authorization: `Bearer ${accessToken}`,
                },
            });

            commit("setState", {
                isLoggedIn: true,
                isAdmin: response.data,
                accessToken,
                refreshToken,
                email,
            });
        }
    },
    async login({ commit }, { email, password }) {
        const response = await axios.post("/api/login", {
            email: email,
            password: password,
        });
        if (response.data) {
            const response2 = await axios.get("/api/isAdmin", {
                headers: {
                    Authorization: `Bearer ${response.data.access_token}`,
                },
            });
            commit("setState", {
                isLoggedIn: true,
                isAdmin: response2.data,
                accessToken: response.data.access_token,
                refreshToken: response.data.refresh_token,
                email,
            });
            window.sessionStorage.setItem(
                "accessToken",
                response.data.access_token
            );
            window.sessionStorage.setItem(
                "refreshToken",
                response.data.refresh_token
            );
            window.sessionStorage.setItem("email", email);
        }
    },
    logOut({ commit }) {
        window.sessionStorage.setItem("accessToken", null);
        window.sessionStorage.setItem("refreshToken", null);
        window.sessionStorage.setItem("email", null);

        commit("setState", {
            isLoggedIn: false,
            isAdmin: false,
            accessToken: null,
            refreshToken: null,
            email: null,
        });
    },
};

// mutations
const mutations = {
    setState(state, newState) {
        state.isLoggedIn = newState.isLoggedIn;
        state.isAdmin = newState.isAdmin;
        state.accessToken = newState.accessToken;
        state.refreshToken = newState.refreshToken;
        state.email = newState.email;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
