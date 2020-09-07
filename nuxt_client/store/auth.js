import Constants from '~/constants.js';

export const state = () => ({
    token: null,
    tokenExpiration: null,
    userData: null
});

export const getters = {
    getToken: state => state.token,
    getTokenExpiration: state => state.tokenExpiration,
    getUserData: state => state.userData,
    getAuthStatus: state => state.userData !== null,
    userVerified: state => state.userData ? state.userData.email_verified_at : null
};

export const mutations = {
    SET_TOKEN(state, token) {
        state.token = token;
    },

    SET_TOKEN_EXPIRATION(state, tokenExpiration) {
        state.tokenExpiration = tokenExpiration;
    },

    FETCH_USER_SUCCESS(state, userData) {
        state.userData = userData;
    },

    FETCH_USER_FAIL(state) {
        state.token = null;
        state.tokenExpiration = null;
        state.userData = null;
    },

    UPDATE_USER(state, userData) {
        state.userData = userData;
    },

    LOGOUT(state) {
        state.token = null;
        state.tokenExpiration = null;
        state.userData = null;
    }
};

export const actions = {
    saveToken({ commit }, {token, tokenExpiration}) {
        commit('SET_TOKEN', token);
        commit('SET_TOKEN_EXPIRATION', Date.now() + tokenExpiration);
    },

    async fetchUserData({ commit }) {
        try {
            const { data } = await this.$axios.get(Constants.API_ENDPOINT.USER);
            commit('FETCH_USER_SUCCESS', data.user);
        } catch (e) {
            commit('FETCH_USER_FAIL');
        }
    },

    updateUserData({ commit }, userData) {
        commit('UPDATE_USER', userData);
    },

    async logout({ commit }) {
        try {
            await this.$axios.post(Constants.API_ENDPOINT.LOGOUT, {loading: false});
        } catch (e) {

        }

        commit('LOGOUT');
    },

    forceLogout({ commit }) {
        commit('LOGOUT');
    }
};