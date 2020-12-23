export default ({ store, redirect }) => {

    if (store.getters['auth-admin/getAuthStatus']) {
        if (Date.now() >= store.getters['auth-admin/getTokenExpiration']) {
            store.dispatch('auth-admin/forceLogout');
            return redirect({ name: 'admin.login' });
        }
    }

};