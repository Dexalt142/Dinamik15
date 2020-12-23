<template>
    <div class="login-container container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-margin">
                    <div class="card-body">
                        <div class="card-title">Dinamik Admin Login</div>
                        <form @submit.prevent="submitLogin">
                            <FormInput v-model="authCredential.email" name="email" label="Email" type="email" :autocomplete="true" :error="formErrors.email"></FormInput>
                            <FormInput v-model="authCredential.password" name="password" label="Password" type="password" :autocomplete="true" :error="formErrors.password"></FormInput>

                            <button class="btn btn-primary" :disabled="loading">{{ loading ? 'Loading' : 'Login' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FormInput from '~/components/global/Form/FormInput';
import Constants from '~/constants.js';

export default {
    layout: 'admin',
    middleware: 'admin-guest',
    head() {
        return {
            title: `Admin | Login - ${process.env.APP_NAME}`
        }
    },
    components: {
        FormInput
    },
    data() {
        return {
            authCredential: {
                email: null,
                password: null,
            },
            formErrors: {},
            loading: false
        }
    },
    methods: {
        async submitLogin() {
            this.loading = true;
            this.formErrors = {};
            let response;

            try {
                const res = await this.$axios.post(Constants.ADMIN_ENDPOINT.LOGIN, this.authCredential);
                response = res.data;
            } catch (e) {
                if(e.message !== "Network Error") {
                    if(e.response.data) {
                        this.formErrors = e.response.data.errors;
                    }
                }
                
                this.loading = false;
                return;
            }

            this.$store.dispatch('auth-admin/saveToken', {token: response.token, tokenExpiration: response.expires_in});
            await this.$store.dispatch('auth-admin/fetchAdminData');

            this.$router.push({name: 'admin.dashboard'});
        }
    }
}
</script>

<style lang="scss" scoped>
.login-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-height: 100vh;
}
</style>