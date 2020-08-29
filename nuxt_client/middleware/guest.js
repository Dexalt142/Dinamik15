export default ({store, redirect}) => {

    if(store.getters['auth/getAuthStatus']) {
        return redirect({name: 'dashboard'});
    }

};