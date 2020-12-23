<template>
    <div class="container dashboard-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Tim</h4>
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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Asal Sekolah</th>
                                        <th>Kompetisi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr v-for="(team, index) in teamData" :key="team.id">
                                       <td>{{ index+1 }}</td>
                                       <td>{{ team.name }}</td>
                                       <td>{{ team.user.email }}</td>
                                       <td>{{ team.asal_sekolah }}</td>
                                       <td>{{ team.competition.name }}</td>
                                       <td><button class="btn btn-sm btn-primary" @click="viewDetail(team.id)">Detail</button></td>
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
                            <h4 class="font-weight-bold">Pembimbing</h4>
                            <div>
                                <div>
                                    <div class="font-weight-bold">Nama</div>
                                    <div>{{ (teamDetail.instructor && teamDetail.instructor.name != null) ? teamDetail.instructor.name : '-' }}</div>
                                </div>
                                <div>
                                    <div class="font-weight-bold mt-3">NIP</div>
                                    <div>{{ (teamDetail.instructor && teamDetail.instructor.nip != null) ? teamDetail.instructor.nip : '-' }}</div>
                                </div>
                                <div>
                                    <div class="font-weight-bold mt-3">No. Telepon</div>
                                    <div>{{ (teamDetail.instructor && teamDetail.instructor.no_telp != null) ? teamDetail.instructor.no_telp : '-' }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="font-weight-bold">Anggota</h4>
                            <div class="mb-2" v-for="anggota in teamDetail.member" :key="anggota.id">
                                <div>
                                    <div class="font-weight-bold">Nama</div>
                                    <div>{{ anggota.name }}</div>
                                </div>
                                <div>
                                    <div class="font-weight-bold mt-3">NISN</div>
                                    <div>{{ anggota.nisn }}</div>
                                </div>
                                <div>
                                    <div class="font-weight-bold mt-3">No. Telepon</div>
                                    <div>{{ anggota.no_telp }}</div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="font-weight-bold">Pas Foto</div>
                                        <div>
                                            <img class="img img-thumbnail" :src="`http://dinamik15.test/pas_foto/${anggota.pas_foto}`" alt="Pas Foto">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="font-weight-bold">KTP</div>
                                        <div>
                                            <img class="img img-thumbnail" :src="`http://dinamik15.test/ktp/${anggota.ktp}`" alt="KTP">
                                        </div>
                                    </div>
                                </div>
                                <hr>
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

                        <div class="skeleton-wrapper mt-4">
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
            title: `Admin | Team - ${process.env.APP_NAME}`
        }
    },
    data() {
        return {
            dataLoading: true,
            teamData: [],
            teamDetail: null,
        }
    },
    methods: {
        async fetchTeamData() {
            try {
                let { data } = await this.$axios.get(Constants.ADMIN_ENDPOINT.TEAM.INDEX);
                this.teamData = data.team;

                this.dataLoading = false;
            } catch(e) {

            }
        },

        async viewDetail(id) {
            $('#detailModal').modal('show');
            
            try {
                let { data } = await this.$axios.get(Constants.ADMIN_ENDPOINT.TEAM.GET + id);
                this.teamDetail = data.team;
            } catch(e) {
                
            }
        },

        modalHideEvent() {
            $('#detailModal').on('hidden.bs.modal', () => {
                this.teamDetail = null;
            });
        }
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