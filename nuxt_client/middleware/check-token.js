export default ({ store, redirect }) => {

    if (store.getters['auth/getAuthStatus']) {
        if(Date.now() >= store.getters['auth/getTokenExpiration']) {
            store.dispatch('auth/forceLogout');
            store.dispatch('team/clearTeamData');
            return redirect({name: 'login'});
        }
    }

};