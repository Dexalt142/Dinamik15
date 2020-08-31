export default (({store, redirect}) => {

    if(store.getters['auth/userVerified']) {
        return redirect({name: 'dashboard'});
    }

});