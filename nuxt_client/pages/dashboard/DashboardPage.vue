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
                            <div>
                                <div class="content-title">Info Kelompok</div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-title">Nama</div>
                                            <div class="info-value">{{ teamData.name }}</div>
                                        </div>    
                                    </div>

                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-title">Asal Sekolah</div>
                                            <div class="info-value">{{ teamData.asal_sekolah }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-title">Kompetisi</div>
                                            <div class="info-value">{{ teamData.competition.name }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-title">Satus Pembayaran</div>
                                            <div v-if="teamData.payment" class="info-value">
                                                <span v-if="teamData.payment.status_verifikasi == '0'" class="text-warning">Menunggu verifikasi</span>
                                                <span v-if="teamData.payment.status_verifikasi == '1'" class="text-danger">Verifikasi gagal</span>
                                                <span v-if="teamData.payment.status_verifikasi == '2'" class="text-success">Pembayaran selesai</span>
                                            </div>
                                            <div v-else class="info-value">
                                                <span class="text-danger">Belum bayar</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="content-title">Info Pembimbing</div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-title">Nama</div>
                                            <div class="info-value">{{ (teamData.instructor && teamData.instructor.name) ? teamData.instructor.name : '-' }}</div>
                                        </div>         
                                    </div>

                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-title">NIP</div>
                                            <div class="info-value">{{ (teamData.instructor && teamData.instructor.nip ) ? teamData.instructor.nip : '-' }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-title">No. Telepon</div>
                                            <div class="info-value">{{ (teamData.instructor && teamData.instructor.no_telp) ? teamData.instructor.no_telp : '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="content-title">Anggota Tim</div>
                                <div class="row mb-2" v-for="(anggota, index) in teamData.members" :key="anggota.id">
                                    <div class="col-md-12">
                                        <h4>Anggota {{ index+1 }}</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-title">Nama</div>
                                            <div class="info-value">{{ anggota.name }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-title">NISN</div>
                                            <div class="info-value">{{ anggota.nisn }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-title">No. Telepon</div>
                                            <div class="info-value">{{ anggota.no_telp }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info-box">
                                            <div class="info-title">Pas Foto</div>
                                            <div class="info-value"><img class="w-50 d-block mx-auto img img-thumbnail" :src="`http://dinamik15.test/pas_foto/${anggota.pas_foto}`" alt="Pas Foto"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info-box">
                                            <div class="info-title">KTP / Kartu Pelajar</div>
                                            <div class="info-value"><img class="d-block mx-auto img img-thumbnail" :src="`http://dinamik15.test/ktp/${anggota.ktp}`" alt="KTP"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else-if="!teamData && !pageLoading">
                        <div v-if="new Date() >= new Date('2020-11-01 23:59:59')">
                            <h3 class="text-center">Masa Pendaftaran Telah Selesai</h3>
                        </div>

                        <form v-else @submit.prevent="submitRegistration">
                            <FormInput v-model="registration.form_data.nama_kelompok" :error="registration.errors.nama_kelompok" name="nama_kelompok" label="Nama Kelompok" type="text" ></FormInput>
                            <FormInput v-model="registration.form_data.asal_sekolah" :error="registration.errors.asal_sekolah" name="asal_sekolah" label="Asal Sekolah" type="text" ></FormInput>

                            <div class="form-group">
                                <label for="">Kompetisi</label>
                                <select v-model="registration.form_data.kompetisi" name="kompetisi" class="form-control" :class="registration.errors.kompetisi ? 'is-invalid' : ''">
                                    <option v-for="comp in competitions" :value="comp.id" :key="comp.id">{{ comp.name }}</option>
                                </select>
                                <div class="invalid-feedback">
                                    <div v-for="m in registration.errors.kompetisi" :key="m">{{ m }}</div>
                                </div>
                            </div>

                            <hr>
                            <FormInput v-model="registration.form_data.nama_pembimbing" :error="registration.errors.nama_pembimbing" name="nama_pembimbing" label="Nama Pembimbing" type="text" ></FormInput>
                            <FormInput v-model="registration.form_data.nip_pembimbing" :error="registration.errors.nip_pembimbing" name="nip_pembimbing" label="NIP Pembimbing" type="text" ></FormInput>
                            <FormInput v-model="registration.form_data.no_telp_pembimbing" :error="registration.errors.no_telp_pembimbing" name="no_telp_pembimbing" label="No. Telepon Pembimbing" type="text" ></FormInput>

                            <div v-if="registration.form_data.kompetisi">
                                <div v-for="i in (competitions[registration.form_data.kompetisi-1].type == 'Kelompok' ? 3 : 1)" :key="i">
                                    <hr>
                                    <FormInput :error="registration.errors[`anggota.${i-1}.nama`]" v-model="registration.form_data.anggota[i-1].nama" :label="`Nama Anggota ${i}`" type="text" ></FormInput>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <FormInput :error="registration.errors[`anggota.${i-1}.nisn`]" v-model="registration.form_data.anggota[i-1].nisn" :label="`NISN Anggota ${i}`" type="number" ></FormInput>
                                        </div>
                                        <div class="col-md-6">
                                            <FormInput :error="registration.errors[`anggota.${i-1}.no_telp`]" v-model="registration.form_data.anggota[i-1].no_telp" :label="`No. Telepon Anggota ${i}`" type="text" ></FormInput>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Pas Foto</label>
                                                <input v-if="!registration.form_data.anggota[i-1].pas_foto" @change="previewPasFoto($event, i-1)" type="file" class="form-control-file" accept="image/x-png,image/jpeg">
                                                <div v-else class="pas-foto-wrapper">
                                                    <img :src="registration.imagePreview[i-1].pas_foto" class="pas-foto" :alt="`Pas foto ${i}`">
                                                    <button v-if="!registration.loading" class="remove-button" @click="removePasFoto(i-1)" type="button">Hapus</button>
                                                </div>
                                                <div class="image-error mt-2" v-if="registration.errors[`anggota.${i-1}.pas_foto`]">
                                                    <div class="text-danger" v-for="err in registration.errors[`anggota.${i-1}.pas_foto`]" :key="err"><strong>{{ err }}</strong></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">KTP / Kartu Pelajar</label>
                                                <input v-if="!registration.form_data.anggota[i-1].ktp" @change="previewKTP($event, i-1)" type="file" class="form-control-file" accept="image/x-png,image/jpeg">
                                                <div v-else class="ktp-wrapper">
                                                    <img :src="registration.imagePreview[i-1].ktp" class="ktp" :alt="`KTP ${i}`">
                                                    <button v-if="!registration.loading" class="remove-button" @click="removeKTP(i-1)" type="button">Hapus</button>
                                                </div>
                                                <div class="image-error mt-2" v-if="registration.errors[`anggota.${i-1}.ktp`]">
                                                    <div class="text-danger" v-for="err in registration.errors[`anggota.${i-1}.ktp`]" :key="err"><strong>{{ err }}</strong></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" :disabled="registration.loading">Selesai Daftar</button>
                            </div>
                        </form>
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
            title: `Dashboard - ${process.env.APP_NAME}`
        }
    },
    components: {
        DashboardMenu, Card, FormInput
    },
    data() {
        return {
            pageLoading: true,
            teamData: null,
            competitions: [],
            registration: {
                loading: false,
                errors: {},
                imagePreview: [
                    {
                        pas_foto: null,
                        ktp: null
                    },
                    {
                        pas_foto: null,
                        ktp: null
                    },
                    {
                        pas_foto: null,
                        ktp: null
                    },
                ],
                form_data: {
                    nama_kelompok: null,
                    asal_sekolah: null,
                    nama_pembimbing: null,
                    nip_pembimbing: null,
                    no_telp_pembimbing: null,
                    kompetisi: null,
                    anggota: [
                        {
                            nama: null,
                            nisn: null,
                            no_telp: null,
                            pas_foto: null,
                            ktp: null
                        },
                        {
                            nama: null,
                            nisn: null,
                            no_telp: null,
                            pas_foto: null,
                            ktp: null
                        },
                        {
                            nama: null,
                            nisn: null,
                            no_telp: null,
                            pas_foto: null,
                            ktp: null
                        },
                    ]
                },
            }
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
        async fetchCompetitions() {
            try {
                let res = await this.$axios.get(Constants.API_ENDPOINT.COMPETITION, {loading: false});
                this.competitions = res.data.competition;
                this.registration.form_data.kompetisi = 0;
            } catch(e) {

            }
        },
        previewPasFoto(event, id) {
            var inputField = event.target;
            if(inputField.files && inputField.files[0]) {
                var fileReader = new FileReader();
                this.registration.form_data.anggota[id].pas_foto = inputField.files[0];
                
                fileReader.onload = (e) => {
                    this.registration.imagePreview[id].pas_foto = e.target.result;
                };

                fileReader.readAsDataURL(inputField.files[0]);
            }
        },

        previewKTP(event, id) {
            var inputField = event.target;
            if(inputField.files && inputField.files[0]) {
                var fileReader = new FileReader();
                this.registration.form_data.anggota[id].ktp = inputField.files[0];
                
                fileReader.onload = (e) => {
                    this.registration.imagePreview[id].ktp = e.target.result;
                };

                fileReader.readAsDataURL(inputField.files[0]);
            }
        },

        removePasFoto(id) {
            this.registration.form_data.anggota[id].pas_foto = null;
            this.registration.imagePreview[id].pas_foto = null;
        },

        removeKTP(id) {
            this.registration.form_data.anggota[id].ktp = null;
            this.registration.imagePreview[id].ktp = null;
        },

        async submitRegistration() {
            this.registration.errors = {};
            this.registration.loading = true;

            var formData = new FormData();
            for(var x in this.registration.form_data) {
                if(this.registration.form_data[x]) {
                    if(x === 'anggota') {
                        for(var y in this.registration.form_data.anggota) {
                            for(var z in this.registration.form_data.anggota[y]) {
                                if(this.registration.form_data.anggota[y][z]) {
                                    formData.append(`anggota[${y}][${z}]`, this.registration.form_data.anggota[y][z]);
                                }
                            }
                        }
                    } else {
                        formData.append(x, this.registration.form_data[x]);
                    }
                }
            }

            try {
                let response = await this.$axios.post(Constants.API_ENDPOINT.TEAM.REGISTER, formData);
                console.log(response);
                
                await this.$store.dispatch('team/fetchTeamData');
                this.fetchTeamData();

                this.registration.loading = false;
            } catch (e) {
                if(e.response) {
                    if(e.response.status == 422) {
                        this.registration.errors = e.response.data.error;
                    } else {
                        console.log(e.response);
                    }

                }

                this.registration.loading = false;
                return;
            }

        }
    },
    mounted() {
        this.fetchTeamData();
        if(!this.teamData) {
            this.fetchCompetitions();
        }
    }
}
</script>

<style>
.image-error div {
    font-size: .75rem;
}
</style>