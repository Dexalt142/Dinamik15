import Constants from '~/constants.js';

export default (({$axios, store}) => {

    $axios.interceptors.request.use(request => {

        var token = store.getters['auth/getToken'];
        
        for (const [key, value] of Object.entries(Constants.ADMIN_ENDPOINT)) {
            if(value instanceof Object) {
                for (const [key, value] of Object.entries(value)) {
                    if(request.url.includes(value)) {
                        token = store.getters['auth-admin/getToken'];
                        break;
                    }
                }
            }

            if (request.url.includes(value)) {
                token = store.getters['auth-admin/getToken'];
                break;
            }
        }


        request.headers.common.Authorization = `Bearer ${token}`;

        return request;

    });

});