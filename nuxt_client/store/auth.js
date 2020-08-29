import Constants from '~/constants.js';

export const state = () => ({
    token: null,
    userData: null
});

export const getters = {
    getToken: state => state.token,
    getUserData: state => state.userData,
    getAuthStatus: state => state.userData !== null
};

export const mutations = {
    SET_TOKEN(state, token) {
        state.token = token;
    },

    FETCH_USER_SUCCESS(state, userData) {
        state.userData = userData;
    },

    FETCH_USER_FAIL(state) {
        state.token = null;
        state.userData = null;
    },

    UPDATE_USER(state, userData) {
        state.userData = userData;
    },

    LOGOUT(state) {
        state.token = null;
        state.userData = null;
    }
};

export const actions = {
    saveToken({ commit }, token) {
        commit('SET_TOKEN', token);
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
            await this.$axios.post(Constants.API_ENDPOINT.LOGOUT);
        } catch (e) {

        }

        commit('LOGOUT');
    }
};