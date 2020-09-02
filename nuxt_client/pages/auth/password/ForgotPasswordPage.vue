<template>
    <div class="container main-container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <Card color="white" title="Lupa Password" :loading="loading" loading_title="Memuat">
                    <Alert v-if="successAlert" :message="successAlert" color="success" :dismiss="true"></Alert>
                    <form @submit.prevent="submitForgotPassword">
                        <FormInput v-model="forgotPassword.email" name="email" label="Email" type="email" :autocomplete="true" :error="formErrors.email"></FormInput>

                        <div class="form-group">
                            <button class="btn btn-primary w-100">Kirim</button>
                        </div>
                    </form>
                </Card>
            </div>
        </div>
    </div>
</template>

<script>
import Card from '~/components/global/Card';
import Alert from '~/components/global/Alert/Alert';
import FormInput from '~/components/global/Form/FormInput';
import Constants from '~/constants.js';

export default {
    middleware: 'guest',
    head() {
        return {
            title: `Forgot Password - ${process.env.APP_NAME}`
        }
    },
    components: {
        Card, FormInput
    },
    data() {
        return {
            forgotPassword: {
                email: ''
            },
            formErrors: {},
            successAlert: '',
            loading: false
        }
    },
    methods: {
        async submitForgotPassword() {
            this.loading = true;
            this.formErrors = {};
            try {
                let response = await this.$axios.post(Constants.API_ENDPOINT.PASSWORD.EMAIL, this.forgotPassword);
                this.successAlert = response.data.message;
                this.forgotPassword = {
                    email: ''
                };

                this.loading = false;
            } catch (e) {
                if(e.response) {
                    if(e.response.status == 422 || e.response.status == 400) {
                        this.formErrors = e.response.data.errors;
                    }
                }
                this.loading = false;
            }
        }
    }
}
</script>