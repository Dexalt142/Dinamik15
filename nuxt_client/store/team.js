import Constants from '~/constants.js';

export const state = () => ({
    teamData: null,
    teamMembers: null,
    payment: null,
    instructor: null,
    creation: null
});

export const getters =  {
    getTeamData: state => state.teamData,
    getTeamMembers: state => state.teamMembers,
    getPayment: state => state.payment,
    getInstructor: state => state.instructor,
    getCreation: state => state.creation
};

export const mutations = {
    SET_TEAM_DATA(state, teamData) {
        state.teamData = teamData;
    },

    CLEAR_TEAM_DATA(state) {
        state.teamData = null;
    },

    CLEAR_TEAM_MEMBERS(state) {
        state.teamMembers = null;
    },

    CLEAR_PAYMENT(state) {
        state.payment = null;
    },

    CLEAR_INSTRUCTOR(state) {
        state.instructor = null;
    },

    CLEAR_CREATION(state) {
        state.creation = null;
    },
};

export const actions = {
    async fetchTeamData({commit}) {
        try {
            const { data } = await this.$axios.get(Constants.API_ENDPOINT.TEAM.TEAM_DATA);
            commit('SET_TEAM_DATA', data.team);
        } catch (e) {
            commit('CLEAR_TEAM_DATA');
        }
    },

    clearAllTeamData({ commit }) {
        commit('CLEAR_TEAM_DATA');
        commit('CLEAR_TEAM_MEMBERS');
        commit('CLEAR_PAYMENT');
        commit('CLEAR_INSTRUCTOR');
        commit('CLEAR_CREATION');
    }
}