<template>
    <div class="container main-container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <Card color="white" title="Login" :loading="loading" loading_title="Mengotentikasi">
                    <form @submit.prevent="submitLogin">
                        <FormInput v-model="authCredential.email" name="email" type="email" :autocomplete="true" :error="formErrors.email"></FormInput>
                        <FormInput v-model="authCredential.password" name="password" type="password" :autocomplete="true" :error="formErrors.password"></FormInput>

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

export default {
    middleware: 'guest',
    head() {
        return {
            title: 'Dinamik 15 - Login'
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
                const res = await this.$axios.post('auth/login', this.authCredential);
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

            this.$router.push({name: 'dashboard'});
        }
    },
    mounted() {

    }
}
</script>