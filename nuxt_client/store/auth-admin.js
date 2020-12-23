import Constants from '~/constants.js';

export const state = () => ({
    token: null,
    tokenExpiration: null,
    adminData: null
});

export const getters = {
    getToken: state => state.token,
    getTokenExpiration: state => state.tokenExpiration,
    getAdminData: state => state.adminData,
    getAuthStatus: state => state.adminData !== null,
};

export const mutations = {
    SET_TOKEN(state, token) {
        state.token = token;
    },

    SET_TOKEN_EXPIRATION(state, tokenExpiration) {
        state.tokenExpiration = tokenExpiration;
    },

    FETCH_ADMIN_SUCCESS(state, adminData) {
        state.adminData = adminData;
    },

    FETCH_ADMIN_FAIL(state) {
        state.token = null;
        state.tokenExpiration = null;
        state.adminData = null;
    },

    UPDATE_ADMIN(state, adminData) {
        state.adminData = adminData;
    },

    LOGOUT(state) {
        state.token = null;
        state.tokenExpiration = null;
        state.adminData = null;
    }
};

export const actions = {
    saveToken({ commit }, { token, tokenExpiration }) {
        commit('SET_TOKEN', token);
        commit('SET_TOKEN_EXPIRATION', Date.now() + tokenExpiration);
    },

    async fetchAdminData({ commit }) {
        try {
            const { data } = await this.$axios.get(Constants.ADMIN_ENDPOINT.ME);
            commit('FETCH_ADMIN_SUCCESS', data.admin);
        } catch (e) {
            commit('FETCH_ADMIN_FAIL');
        }
    },

    updateAdminData({ commit }, adminData) {
        commit('UPDATE_ADMIN', adminData);
    },

    async logout({ commit }) {
        try {
            await this.$axios.post(Constants.ADMIN_ENDPOINT.LOGOUT, { loading: false });
        } catch (e) {

        }

        commit('LOGOUT');
    },

    forceLogout({ commit }) {
        commit('LOGOUT');
    }
};