<template>
    <div class="container main-container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <Card color="white" title="Register" :loading="loading" loading_title="Mendaftarkan">
                    <Alert v-if="successAlert" :message="successAlert" color="success" :dismiss="true"></Alert>
                    <form @submit.prevent="submitRegister">
                        <FormInput v-model="registerData.name" name="name" label="Nama" type="text" :error="formErrors.name"></FormInput>
                        <FormInput v-model="registerData.email" name="email" label="Email" type="email" :autocomplete="true" :error="formErrors.email"></FormInput>
                        <FormInput v-model="registerData.password" name="password" label="Password" type="password" :error="formErrors.password"></FormInput>
                        <FormInput v-model="registerData.password_confirmation" name="password_confirmation" label="Konfirmasi Password" type="password" :error="formErrors.password_confirmation"></FormInput>

                        <div class="form-group">
                            <button class="btn btn-primary">Register</button>
                        </div>
                        <hr>
                        <p>Sudah memiliki akun? <router-link :to="{name: 'login'}">Login sekarang</router-link></p>
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
            title: `Register - ${process.env.APP_NAME}`
        }
    },
    components: {
        Card, FormInput
    },
    data() {
        return {
            registerData: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            formErrors: {},
            successAlert: '',
            loading: false
        }
    },
    methods: {
        async submitRegister() {
            this.loading = true;
            this.formErrors = {};

            try {
                const response = await this.$axios.post(Constants.API_ENDPOINT.REGISTER, this.registerData);
                this.successAlert = 'Registrasi berhasil';
                this.registerData = {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                }

                this.loading = false;
            } catch(e) {
                if(e.response.status && e.response.status === 422) {
                    this.formErrors = e.response.data.errors;
                }

                this.loading = false;
                return;
            }
        }
    }
}
</script>