<template>
    <div class="container main-container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <Card color="white" title="Verifikasi Email">
                    <p>Anda harus memverifikasi email anda sebelum menggunakan akun ini.</p>
                    <button class="btn btn-primary mx-auto d-block">Kirim Email Verifikasi</button>
                </Card>
            </div>
        </div>
    </div>
</template>

<script>
import Card from '~/components/global/Card';

export default {
    middleware: ['authenticated', 'unverified'],
    head() {
        return {
            title: `Verification - ${process.env.APP_NAME}`
        }
    },
    components: {
        Card
    }
}
</script>