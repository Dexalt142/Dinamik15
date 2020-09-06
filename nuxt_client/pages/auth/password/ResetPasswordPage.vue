<template>
    <div class="container main-container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <Card color="white" title="Reset Password" :loading="loading" loading_title="Memuat">
                    <Alert v-if="successAlert" :message="successAlert" color="success" :dismiss="true"></Alert>
                    <Alert v-if="errorAlert" :message="errorAlert" color="danger" :dismiss="true"></Alert>
                    <form @submit.prevent="submitForgotPassword">
                        <FormInput v-model="resetPassword.password" name="password" label="Password" type="password" :error="formErrors.password"></FormInput>
                        <FormInput v-model="resetPassword.password_confirmation" name="password_confirmation" label="Konfirmasi Password" type="password" :error="formErrors.password_confirmation"></FormInput>

                        <div class="form-group">
                            <button class="btn btn-primary w-100">Simpan</button>
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
            title: `Reset Password - ${process.env.APP_NAME}`
        }
    },
    components: {
        Card, FormInput
    },
    data() {
        return {
            resetPassword: {
                token: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            formErrors: {},
            successAlert: '',
            errorAlert: '',
            loading: false
        }
    },
    methods: {
        async submitForgotPassword() {
            this.loading = true;
            this.formErrors = {};
            this.successAlert = '';
            this.errorAlert = '';

            try {
                let response = await this.$axios.post(Constants.API_ENDPOINT.PASSWORD.RESET, this.resetPassword);
                this.successAlert = response.data.message;
                this.resetPassword = {
                    token: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                };

                this.loading = false;
            } catch (e) {
                if(e.response) {
                    if(e.response.status === 422) {
                        this.formErrors = e.response.data.errors;

                        if(!this.formErrors.email || !this.formErrors.token) {
                            this.errorAlert = 'Permintaan tidak valid';
                        }
                    } else if(e.response.status == 400) {
                        this.errorAlert = e.response.data.message;
                    }
                }
                this.loading = false;
            }
        },

        async checkParams() {
            let params = this.$route.params;
            if(params) {
                this.resetPassword.token = params.token;
                this.resetPassword.email = params.email;
            }
        }
    },
    mounted() {
        this.checkParams();
    }
}
</script>