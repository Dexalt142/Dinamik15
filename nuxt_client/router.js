import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m);

const routes = [
    { path: '/', name: 'welcome', component: page('welcome/WelcomePage.vue') },
    { path: '/login', name: 'login', component: page('auth/LoginPage.vue') },
    { path: '/register', name: 'register', component: page('auth/RegisterPage.vue') },
    { path: '/verification', name: 'verification', component: page('auth/email/VerificationPage.vue') },
    { path: '/verification/confirm/:id/:hash', name: 'verification.confirm', component: page('auth/email/ConfirmVerificationPage.vue') },
    { path: '/dashboard', name: 'dashboard', component: page('dashboard/DashboardPage.vue') },
    { path: '/password/forgot', name: 'password.forgot', component: page('auth/password/ForgotPasswordPage.vue')},
    { path: '/password/reset/:token/:email', name: 'password.reset', component: page('auth/password/ResetPasswordPage.vue')}
];

export function createRouter() {
    return new Router({
        routes: routes,
        mode: 'history',
        scrollBehavior: () => {
            return { x:0, y:0 };
        }
    });
};