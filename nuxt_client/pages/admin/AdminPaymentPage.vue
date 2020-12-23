<template>
    <div class="container dashboard-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Pembayaran</h4>
                        <div class="skeleton-wrapper" v-if="dataLoading">
                            <div class="skeleton content"></div>
                            <div class="skeleton content-75 mb-4"></div>
                            <div class="skeleton content"></div>
                            <div class="skeleton content-50 mb-4"></div>
                            <div class="skeleton content"></div>
                            <div class="skeleton content"></div>
                        </div>
                        <div class="table-responsive" v-if="!dataLoading && teamData.length > 0">
                            <table class="table table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Tim</th>
                                        <th>Kompetisi</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr v-for="(team, index) in teamData" :key="team.id">
                                       <td>{{ index+1 }}</td>
                                       <td>{{ team.name }}</td>
                                       <td>{{ team.competition.name }}</td>
                                       <td v-if="team.payment">
                                           <span v-if="team.payment.status_verifikasi == 2" class="badge badge-pill badge-success">Pembayaran Berhasil</span>
                                           <span v-else-if="team.payment.status_verifikasi == 1" class="badge badge-pill badge-danger">Pembayaran Gagal</span>
                                           <span v-else-if="team.payment.status_verifikasi == 0" class="badge badge-pill badge-warning">Menunggu Verifikasi</span>
                                       </td>
                                       <td v-else>
                                           <span class="badge badge-pill badge-danger">Belum Bayar</span>
                                       </td>
                                       <td>
                                           <button class="btn btn-sm btn-primary" @click="viewDetail(index)">Detail</button>
                                           <button v-if="(team.payment && team.payment.status_verifikasi != 2)" class="btn btn-sm btn-primary" @click="verifyPayment(index)">Verifikasi</button>
                                        </td>
                                   </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else-if="!dataLoading && teamData.length == 0">
                            Data tidak ditemukan
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" v-if="teamDetail">
                    <div class="modal-body">
                        <div class="mb-4">
                            <h4 class="font-weight-bold">Bukti Pembayaran</h4>
                            <div v-if="teamDetail.payment">
                                <div>
                                    <div class="font-weight-bold">Nama Tim</div>
                                    <div>{{ teamDetail.name }}</div>
                                </div>

                                <div class="mt-3">
                                    <div class="font-weight-bold">Nama Pengirim</div>
                                    <div>{{ teamDetail.payment.nama_pengirim }}</div>
                                </div>

                                <div class="mt-3">
                                    <div class="font-weight-bold">Status</div>
                                    <div>
                                        <span class="text-warning" v-if="teamDetail.payment.status_verifikasi == 0">Menunggu Verifikasi</span>
                                        <span class="text-danger" v-if="teamDetail.payment.status_verifikasi == 1">Pembayaran Gagal</span>
                                        <span class="text-success" v-if="teamDetail.payment.status_verifikasi == 2">Pembayaran Berhasil</span>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="font-weight-bold">Bukti</div>
                                    <div>
                                        <img class="img img-thumbnail" :src="`http://dinamik15.test/bukti_pembayaran/${teamDetail.payment.file_name}`" alt="Bukti pembayaran">
                                    </div>
                                </div>
                            </div>

                            <div v-else>
                                <p>Belum Bayar</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
                <div v-else class="modal-content">
                    <div class="modal-body">
                        <div class="skeleton-wrapper">
                            <div class="skeleton title"></div>
                            <div class="skeleton content"></div>
                            <div class="skeleton content-50"></div>
                            <div class="skeleton content"></div>
                            <div class="skeleton content-75"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" v-if="verificationTarget">
                    <div class="modal-body">
                        <div class="mb-4">
                            <h4 class="font-weight-bold">Verifikasi Pembayaran</h4>
                            <p>Klik tombol terima jika pembayaran valid, dan tolak jika pembayaran tidak valid (tim akan diminta untuk mengupload ulang bukti pembayaran).</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mr-auto btn-sm btn-link" data-dismiss="modal">Tutup</button>
                        <button @click="submitVerification(0)" type="button" class="btn btn-sm btn-danger">Tolak</button>
                        <button @click="submitVerification(1)" type="button" class="btn btn-sm btn-success">Terima</button>
                    </div>
                </div>
                <div v-else class="modal-content">
                    <div class="modal-body">
                        <div class="skeleton-wrapper">
                            <div class="skeleton title"></div>
                            <div class="skeleton content"></div>
                            <div class="skeleton content-50"></div>
                            <div class="skeleton content"></div>
                            <div class="skeleton content-75"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Constants from '~/constants.js';

export default {
    layout: 'admin',
    middleware: ['admin-authenticated', 'admin-check-token'],
    head() {
        return {
            title: `Admin | Payment - ${process.env.APP_NAME}`
        }
    },
    data() {
        return {
            dataLoading: true,
            teamData: [],
            teamDetail: null,
            verificationTarget: null,
            verificationTargetIndex: null,
        }
    },
    methods: {
        async fetchTeamData() {
            try {
                let { data } = await this.$axios.get(Constants.ADMIN_ENDPOINT.PAYMENT.INDEX);
                this.teamData = data.payment;

                this.dataLoading = false;
            } catch(e) {

            }
        },

        async viewDetail(index) {
            this.teamDetail = this.teamData[index];
            $('#detailModal').modal('show');
        },

        async verifyPayment(index) {
            this.verificationTarget = this.teamData[index];
            this.verificationTargetIndex = index;
            $('#verifyModal').modal('show');
        },

        async submitVerification(action) {
            const verificationData = {
                team_id: this.verificationTarget.id,
                status: action == 1 ? 'Accept' : 'Deny'
            };

            try {
                let verify = await this.$axios.post(Constants.ADMIN_ENDPOINT.PAYMENT.VERIFY, verificationData);
                let { data } = await this.$axios.get(Constants.ADMIN_ENDPOINT.PAYMENT.GET + verificationData.team_id);

                this.teamData[this.verificationTargetIndex] = data.payment;
                
                $('#verifyModal').modal('hide');
            } catch(e) {
                $('#verifyModal').modal('hide');
            }
        },

        modalHideEvent() {
            $('#detailModal').on('hidden.bs.modal', () => {
                this.teamDetail = null;
            });
            
            $('#verifyModal').on('hidden.bs.modal', () => {
                this.verificationTarget = null;
                this.verificationTargetIndex = null;
            });
        },
    },
    mounted() {
        this.fetchTeamData();
        this.modalHideEvent();
    }
}
</script>

<style lang="scss" scoped>
.dashboard-container {
    margin-top: 4rem;
}
</style>