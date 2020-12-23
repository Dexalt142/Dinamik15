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
        },
        TEAM: {
            REGISTER: 'team/register',
            TEAM_DATA: 'team'
        },
        COMPETITION: 'competition',
        PAYMENT: {
            UPLOAD: 'payment/upload'
        },
        CREATION: {
            DOCUMENT: 'creation/document',
            RESULT: 'creation/result',
        }
    },
    ADMIN_ENDPOINT: {
        LOGIN: 'admin/auth/login',
        LOGOUT: 'admin/auth/logout',
        ME: 'admin/auth/me',
        STATISTIC: 'admin/statistic',
        TEAM: {
            INDEX: 'admin/team',
            GET: 'admin/team/'
        },
        PAYMENT: {
            INDEX: 'admin/payment',
            GET: 'admin/payment/',
            VERIFY: 'admin/payment/verify',
        },
        CREATION: {
            INDEX: 'admin/creation',
        }
    }
};

export default Constants;