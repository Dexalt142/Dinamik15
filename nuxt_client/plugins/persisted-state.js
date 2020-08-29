import createPersistedState from 'vuex-persistedstate';
import SLS from 'secure-ls';

var secLS = new SLS({encodingType: 'aes'});

export default (({store}) => {

    createPersistedState({
        key: 'dnmkdt',
        paths: ['auth'],
        storage: {
            getItem: key => secLS.get(key),
            setItem: (key, value) => secLS.set(key, value),
            removeItem: key => secLS.remove(key)
        }
    })(store);

});