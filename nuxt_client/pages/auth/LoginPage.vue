<template>
    <div class="container main-container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <Card color="white" title="Login" :loading="loading" loading_title="Mengotentikasi">
                    <form @submit.prevent="submitLogin">
                        <FormInput v-model="authCredential.email" name="email" label="Email" type="email" :autocomplete="true" :error="formErrors.email"></FormInput>
                        <FormInput v-model="authCredential.password" name="password" label="Password" type="password" :error="formErrors.password"></FormInput>

                        <div class="form-group">
                            <button class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </Card>
            </div>
        </div>
    </div>
</template>

<script>
import Card from '~/components/global/Card';
import FormInput from '~/components/global/Form/FormInput';
import Constants from '~/constants.js';

export default {
    middleware: 'guest',
    head() {
        return {
            title: `Login - ${process.env.APP_NAME}`
        }
    },
    components: {
        Card, FormInput
    },
    data() {
        return {
            authCredential: {
                email: '',
                password: ''
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
                const res = await this.$axios.post(Constants.API_ENDPOINT.LOGIN, this.authCredential);
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
            
            this.$store.dispatch('auth/saveToken', response.token);
            await this.$store.dispatch('auth/fetchUserData');
            
            if(this.$store.getters['auth/userVerified']) {
                this.$router.push({name: 'dashboard'});
            } else {
                this.$router.push({name: 'verification'});
            }
        }
    },
    mounted() {
    }
}
</script>