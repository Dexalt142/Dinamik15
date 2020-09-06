const Constants = {
    API_ENDPOINT: {
        LOGIN: 'auth/login',
        REGISTER: 'auth/register',
        LOGOUT: 'auth/logout',
        USER: 'auth/user',
        VERIFICATION: {
            SEND_EMAIL: 'auth/email/resend',
            VERIFY: 'auth/email/verify'
        },
        PASSWORD: {
            EMAIL: 'auth/password/email',
            RESET: 'auth/password/reset',
        }
    }
};

export default Constants;