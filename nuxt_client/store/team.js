import Constants from '~/constants.js';

export const state = () => ({
    teamData: null
});

export const getters =  {
    getTeamData: state => state.teamData
};

export const mutations = {
    SET_TEAM_DATA(state, teamData) {
        state.teamData = teamData;
    },

    CLEAR_TEAM_DATA(state) {
        state.teamData = null;
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

    clearTeamData({ commit }) {
        commit('CLEAR_TEAM_DATA');
    }
}