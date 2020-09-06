<template>
    <div class="container main-container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <Card color="white" title="Verifikasi Email">
                    <div class="skeleton-wrapper" v-if="loading">
                        <div class="skeleton content"></div>
                        <div class="skeleton content-75"></div>
                    </div>
                    <div v-if="verificationSuccess">
                        <p>Email anda berhasil diverifikasi. Silahkan lanjutkan proses pendaftaran di dashboard.</p>
                        <router-link class="btn btn-primary mx-auto d-block" :to="{name:'dashboard'}">Dashboard</router-link>
                    </div>
                    <div v-if="verificationFailed">
                        <p>Email anda gagal diverifikasi. Masuk ke halaman verifikasi untuk mengirimkan kembali email berisi alamat untuk memverifikasi email anda.</p>
                        <router-link class="btn btn-primary mx-auto d-block" :to="{name:'verification'}">Halaman Verifikasi</router-link>
                    </div>
                </Card>
            </div>
        </div>
    </div>
</template>

<script>
import Card from '~/components/global/Card';
import Constants from '~/constants.js';

export default {
    middleware: ['authenticated', 'unverified'],
    head() {
        return {
            title: `Verification - ${process.env.APP_NAME}`
        }
    },
    components: {
        Card
    },
    data() {
        return {
            loading: true,
            verificationSuccess: false,
            verificationFailed: false,
        };
    },
    methods: {
        async confirmVerification() {
            let path = this.$route.fullPath;
            path = Constants.API_ENDPOINT.VERIFICATION.VERIFY + path.replace('/verification/confirm/', '/');
            
            try {
                let response = await this.$axios.post(path);
                this.verificationSuccess = true;
                this.loading = false;
            } catch (e) {
                console.log(e.response);
                if(e.response) {
                    if(e.response.data.message == 'Invalid url' || e.response.status == 403) {
                        this.verificationFailed = true;
                        this.loading = false;
                    }
                }

                return;
            }

            await this.$store.dispatch('auth/fetchUserData');
        }
    },
    mounted() {
        this.confirmVerification();
    }
}
</script>