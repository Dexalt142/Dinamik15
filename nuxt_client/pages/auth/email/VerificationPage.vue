<template>
    <div class="container main-container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <Card color="white" title="Verifikasi Email">
                    <Alert v-if="successAlert" :message="successAlert" color="success" :dismiss="true"></Alert>
                    <Alert v-if="errorAlert" :message="errorAlert" color="danger" :dismiss="true"></Alert>
                    <p>Anda harus memverifikasi email anda sebelum menggunakan akun ini.</p>
                    <button class="btn btn-primary mx-auto d-block" @click="sendVerificationEmail" :disabled="emailSent">Kirim Email Verifikasi</button>
                </Card>
            </div>
        </div>
    </div>
</template>

<script>
import Card from '~/components/global/Card';
import Alert from '~/components/global/Alert/Alert';
import Constants from '~/constants.js';

export default {
    middleware: ['authenticated', 'unverified'],
    head() {
        return {
            title: `Verification - ${process.env.APP_NAME}`
        }
    },
    components: {
        Card, Alert
    },
    data() {
        return {
            successAlert: '',
            errorAlert: '',
            emailSent: false
        };
    },
    methods: {
        async sendVerificationEmail() {
            if(!this.emailSent) {
                this.successAlert = '';
                this.errorAlert = '';
    
                try {
                    let response = await this.$axios.post(Constants.API_ENDPOINT.VERIFICATION.SEND_EMAIL);
                    this.successAlert = response.data.message;
                    this.emailSent = true;
                } catch (e) {
                    if(e.response) {
                        if(e.response.status === 400) {
                            this.errorAlert = e.response.data.message;
                        } else if(e.response.status == 429) {
                            this.errorAlert = 'Harap tunggu beberapa saat lagi';
                            this.emailSent = true;
                        }
                    }
                }
            }
        }
    }
}
</script>