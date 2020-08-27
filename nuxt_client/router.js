import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m);

const routes = [
    { path: '/', name: 'welcome', component: page('welcome/WelcomePage.vue') },
    { path: '/login', name: 'login', component: page('auth/Login.vue') },
    { path: '/register', name: 'register', component: page('auth/Register.vue') },
];

export function createRouter() {
    return new Router({
        routes: routes,
        mode: 'history'
    });
};