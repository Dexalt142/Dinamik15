export default (({$axios, store}) => {

    $axios.interceptors.request.use(request => {

        let token = store.getters['auth/getToken'];

        request.headers.common.Authorization = `Bearer ${token}`;

        return request;

    });

});