<template>
    <div class="container main-container">
        <div class="row">
            <div class="col-md-12">
                <Card color="white">
                    <div class="skeleton-wrapper" v-if="pageLoading">
                        <div class="skeleton title"></div>
                        <div class="skeleton content"></div>
                        <div class="skeleton content-50"></div>
                        <div class="skeleton content-75"></div>
                    </div>
                    
                    <div v-if="teamData && !pageLoading" class="user-dashboard">
                        <div class="header">
                            <div class="team-name">{{ teamData.name }}</div>
                            <div class="competition-name">{{ teamData.competition.name }}</div>
                        </div>

                        <DashboardMenu />

                        <div class="content">
                            <div v-if="teamData.payment">
                                <div v-if="teamData.payment.status_verifikasi == 0">
                                    <h4 class="text-center">
                                        Status Pembayaran: <span class="text-warning">Menunggu verifikasi</span>
                                    </h4>
                                    <div class="w-50 mx-auto mt-4">
                                        <p class="text-center">Pengirim: {{ teamData.payment.nama_pengirim }}</p>
                                        <img :src="`http://dinamik15.test/bukti_pembayaran/${teamData.payment.file_name}`" alt="bukti pembayaran" class="img img-thumbnail">
                                    </div>
                                </div>

                                <div v-else-if="teamData.payment.status_verifikasi == 1">
                                    <h4 class="text-center">
                                        Status Pembayaran: <span class="text-danger">Verifikasi gagal, silahkan upload ulang.</span>
                                    </h4>

                                    <div class="row mt-4">
                                        <div class="col-md-6 mx-auto">
                                            <div v-if="!buktiPembayaran">
                                                <div v-if="errors" class="alert alert-danger alert-dismissible fade show">
                                                    <div v-for="e in errors.bukti_pembayaran" :key='e'>{{ e }}</div>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="pembayaran-box">
                                                    <input @change="previewBuktiPembayaran" type="file" class="pembayaran-input" accept="image/x-png,image/jpeg">
                                                    <div class="text-center">
                                                        Klik disini untuk mengunggah bukti pembayaran anda.
                                                    </div>
                                                    <div class="text-center">
                                                        File yang dapat diunggah: JPG, PNG. Maksimal 2MB.
                                                    </div>
                                                </div>
                                            </div>

                                            <div v-else class="pembayaran-form">
                                                <button @click="uploadPayment" class="btn btn-primary d-block mx-auto" :disabled="uploading">Unggah Bukti Pembayaran</button>

                                                <div class="form-group mt-2">
                                                    <label for="">Nama Pengirim</label>
                                                    <input type="text" class="form-control" :class="(errors && errors.nama_pengirim ) ? 'is-invalid' : ''" v-model="namaPengirim">
                                                    <span v-if="errors" class="invalid-feedback">
                                                        <div v-for="e in errors.nama_pengirim" :key='e'>{{ e }}</div>
                                                    </span>
                                                </div>

                                                <div class="pembayaran-preview">
                                                    <img :src="buktiPembayaranPreview" alt="bukti pembayaran">
                                                    <button v-if="!uploading" class="remove-button" @click="removeBuktiPembayaran">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else-if="teamData.payment.status_verifikasi == 2">
                                    <h4 class="text-center">
                                        Status Pembayaran: <span class="text-success">Pembayaran selesai</span>
                                    </h4>
                                    <div class="w-50 mx-auto mt-4">
                                        <p class="text-center">Pengirim: {{ teamData.payment.nama_pengirim }}</p>
                                        <img :src="`http://dinamik15.test/bukti_pembayaran/${teamData.payment.file_name}`" alt="bukti pembayaran" class="img img-thumbnail">
                                    </div>
                                </div>
                            </div>

                            <div v-else>
                                <div class="text-center">
                                    <h4>Status Pembayaran: <span class="text-danger">Belum Bayar</span></h4>
                                    <p>Silahkan transfer sebesar Rp. {{ teamData.competition.price }} ke rekening:</p>
                                    <div class="my-3">BNI 0725153454 a.n Musa Misbahuddin</div>
                                    <p>Setelah transfer, upload bukti pembayaran.</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        <div v-if="!buktiPembayaran">
                                            <div v-if="errors" class="alert alert-danger alert-dismissible fade show">
                                                <div v-for="e in errors.bukti_pembayaran" :key='e'>{{ e }}</div>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="pembayaran-box">
                                                <input @change="previewBuktiPembayaran" type="file" class="pembayaran-input" accept="image/x-png,image/jpeg">
                                                <div class="text-center">
                                                    Klik disini untuk mengunggah bukti pembayaran anda.
                                                </div>
                                                <div class="text-center">
                                                    File yang dapat diunggah: JPG, PNG. Maksimal 2MB.
                                                </div>
                                            </div>
                                        </div>

                                        <div v-else class="pembayaran-form">
                                            <button @click="uploadPayment" class="btn btn-primary d-block mx-auto" :disabled="uploading">Unggah Bukti Pembayaran</button>

                                            <div class="form-group mt-2">
                                                <label for="">Nama Pengirim</label>
                                                <input type="text" class="form-control" :class="(errors && errors.nama_pengirim ) ? 'is-invalid' : ''" v-model="namaPengirim">
                                                <span v-if="errors" class="invalid-feedback">
                                                    <div v-for="e in errors.nama_pengirim" :key='e'>{{ e }}</div>
                                                </span>
                                            </div>

                                            <div class="pembayaran-preview">
                                                <img :src="buktiPembayaranPreview" alt="bukti pembayaran">
                                                <button v-if="!uploading" class="remove-button" @click="removeBuktiPembayaran">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else-if="!teamData && !pageLoading">
                        <div class="card-title">Pendaftaran Belum Selesai</div>
                        <p class="text-center">Silahkan selesaikan pendaftaraan anda terlebih dahulu.</p>
                        <div class="d-flex justify-content-center">
                            <router-link :to="{name: 'dashboard'}" class="btn btn-primary">Dashboard</router-link>
                        </div>
                    </div>
                </Card>
            </div>
        </div>
    </div>
</template>

<script>
import DashboardMenu from '~/components/DashboardPage/DashboardMenu';

import Card from '~/components/global/Card';
import FormInput from '~/components/global/Form/FormInput';
import Constants from '~/constants';

export default {
    middleware: ['authenticated', 'verified'],
    head() {
        return {
            title: `Dashboard | Payment - ${process.env.APP_NAME}`
        }
    },
    components: {
        DashboardMenu, Card, FormInput
    },
    data() {
        return {
            pageLoading: true,
            teamData: null,
            namaPengirim: null,
            buktiPembayaran: null,
            buktiPembayaranPreview: null,
            uploading: false,
            errors: null
        }
    },
    methods: {
        async fetchTeamData() {
            await this.$store.dispatch('team/fetchTeamData');

            if(this.$store.getters['team/getTeamData']) {
                this.teamData = this.$store.getters['team/getTeamData'];
            }

            this.pageLoading = false;
        },

        previewBuktiPembayaran(event) {
            var inputField = event.target;
            this.errors = null;
            if(inputField.files && inputField.files[0]) {
                var fileReader = new FileReader();
                this.buktiPembayaran = inputField.files[0];
                
                fileReader.onload = (e) => {
                    this.buktiPembayaranPreview = e.target.result;
                };

                fileReader.readAsDataURL(inputField.files[0]);
            }
        },

        removeBuktiPembayaran() {
            this.buktiPembayaran = null;
            this.buktiPembayaranPreview = null;
        },

        async uploadPayment() {
            this.uploading = true;
            this.errors = null;

            try { 
                const paymentData = new FormData();
                if(this.namaPengirim) {
                    paymentData.append('nama_pengirim', this.namaPengirim);
                }
                paymentData.append('bukti_pembayaran', this.buktiPembayaran, this.buktiPembayaran.name);
                
                let response = await this.$axios.post(Constants.API_ENDPOINT.PAYMENT.UPLOAD, paymentData);

                await this.$store.dispatch('team/fetchTeamData');
                this.teamData = this.$store.getters['team/getTeamData'];

                this.uploading = false;
            } catch (e) {
                if(e.response.status === 422) {
                    this.errors = e.response.data.error;
                    if(!this.errors.nama_pengirim) {
                        this.removeBuktiPembayaran();
                    }
                }
                this.uploading = false;
            }
        }
    },
    mounted() {
        this.$store.dispatch('team/fetchTeamData');
        this.fetchTeamData();
    }
}
</script> 