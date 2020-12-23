export default ({ store, redirect }) => {

    if (store.getters['auth-admin/getAuthStatus']) {
        return redirect({ name: 'admin.dashboard' });
    }

};