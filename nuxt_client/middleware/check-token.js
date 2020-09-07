export default ({ store, redirect }) => {

    if (store.getters['auth/getAuthStatus']) {
        if(store.getters['auth/getTokenExpiration'] <= Date.now()) {
            store.dispatch('auth/forceLogout');
            store.dispatch('team/clearAllTeamData');
            return redirect({name: 'login'});
        }
    }

};