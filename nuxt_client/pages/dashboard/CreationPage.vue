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
                            <div v-if="teamData.payment && teamData.payment.status_verifikasi == 2">
                                <div v-if="new Date() < new Date(teamData.competition.awal_karya)">
                                    <h4>
                                        Masa pengumpulan karya belum dimulai
                                    </h4>
                                </div>
                                <div v-else-if="(new Date() >= new Date(teamData.competition.awal_karya)) && (new Date() <= new Date(teamData.competition.batas_karya))">
                                    <div v-if="teamData.competition.awal_berkas && teamData.competition.batas_berkas">
                                        <div v-if="(teamData.creation && teamData.creation.berkas)" class="creation">
                                            <div class="creation-title">Proposal / Story Board</div>
                                            <div class="creation-content">
                                                <div v-if="editBerkas">
                                                    <FormInput v-model="berkas" name="berkas" label="Link Proposal / Story Board" type="text" :error="formErrors.berkas"></FormInput>
                                                    <button class="btn btn-primary" @click="submitBerkas">Kirim</button>
                                                    <button class="btn btn-link" @click="editBerkasToggle">Batal</button>
                                                </div>
                                                <div v-else>
                                                    <a target="_blank" :href="teamData.creation.berkas">{{ teamData.creation.berkas }}</a>
                                                    <button class="btn btn-sm btn-primary ml-2" @click="editBerkasToggle">Edit</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div v-else>
                                            <div v-if="teamData.competition.awal_berkas && teamData.competition.batas_berkas" class="mb-4">
                                                <FormInput v-model="berkas" name="berkas" label="Link Proposal / Story Board" type="text" :error="formErrors.berkas"></FormInput>
                                                <button class="btn btn-primary" @click="submitBerkas">Kirim</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div v-if="(teamData.creation && teamData.creation.karya)" class="creation">
                                        <div class="creation-title">Karya</div>
                                        <div class="creation-content">
                                            <div v-if="editKarya">
                                                <div v-if="teamData.competition.name=='Poster Design'" class="mb-4">
                                                    Link yang dikumpulkan berupa link google drive yang berisi:<br>
                                                    1. Lembar pernyataan orisinalitas karya<br>
                                                    2. Link Instagram poster dalam bentuk file txt
                                                </div>  
                                                <FormInput v-model="karya" name="Karya" label="Link Karya" type="text" :error="formErrors.karya"></FormInput>
                                                <button class="btn btn-primary" @click="submitKarya">Kirim</button>
                                                <button class="btn btn-link" @click="editKaryaToggle">Batal</button>
                                            </div>
                                            <div v-else>
                                                <a target="_blank" :href="teamData.creation.karya">{{ teamData.creation.karya }}</a>
                                                <button class="btn btn-sm btn-primary ml-2" @click="editKaryaToggle">Edit</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div v-else>
                                        <div>
                                            <div v-if="teamData.competition.name=='Poster Design'" class="mb-4">
                                                Link yang dikumpulkan berupa link google drive yang berisi:<br>
                                                1. Lembar pernyataan orisinalitas karya<br>
                                                2. Link Instagram poster dalam bentuk file txt
                                            </div>
                                            <FormInput v-model="karya" name="Karya" label="Link Karya" type="text" :error="formErrors.karya"></FormInput>
                                            <button class="btn btn-primary" @click="submitKarya">Kirim</button>
                                        </div>
                                    </div>
                                </div>

                                <div v-else>
                                    <h4 class="text-danger">
                                        Masa pengumpulan karya telah berakhir
                                    </h4>
                                    <div v-if="teamData.creation">
                                        <div v-if="teamData.creation.berkas" class="creation">
                                            <div class="creation-title">Proposal / Story Board</div>
                                            <div class="creation-content">
                                                <a target="_blank" :href="teamData.creation.berkas">{{ teamData.creation.berkas }}</a>
                                            </div>
                                        </div>

                                        <div v-if="teamData.creation.karya" class="creation">
                                            <div class="creation-title">Karya</div>
                                            <div class="creation-content">
                                                <a target="_blank" :href="teamData.creation.karya">{{ teamData.creation.karya }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-else>
                                <h4>Silahkan melakukan pembayaran terlebih dahulu</h4>
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
            title: `Dashboard | Creation - ${process.env.APP_NAME}`
        }
    },
    components: {
        DashboardMenu, Card, FormInput
    },
    data() {
        return {
            pageLoading: true,
            teamData: null,
            berkas: null,
            karya: null,
            formErrors: [],
            editBerkas: false,
            editKarya: false,
        }
    },
    methods: {
        async fetchTeamData() {
            await this.$store.dispatch('team/fetchTeamData');

            if(this.$store.getters['team/getTeamData']) {
                this.teamData = await this.$store.getters['team/getTeamData'];
            }

            this.pageLoading = false;
        },

        async submitBerkas() {
            const formData = {
                berkas: this.berkas
            };


            try {
                let response = await this.$axios.post(Constants.API_ENDPOINT.CREATION.DOCUMENT, formData);
                console.log(response);

                await this.$store.dispatch('team/fetchTeamData');
                this.teamData = this.$store.getters['team/getTeamData'];
            } catch(e) {
                console.log(e);
                if(e.response && e.response.status === 422) {
                    this.formErrors = e.response.data.error;
                }
            }

            this.editBerkas = false;
        },

        async submitKarya() {
            const formData = {
                karya: this.karya
            };

            try {
                let response = await this.$axios.post(Constants.API_ENDPOINT.CREATION.RESULT, formData);

                await this.$store.dispatch('team/fetchTeamData');
                this.teamData = this.$store.getters['team/getTeamData'];
            } catch(e) {
                if(e.response && e.response.status === 422) {
                    this.formErrors = e.response.data.error;
                }
            }

            this.editKarya = false;
        },

        editBerkasToggle() {
            this.editBerkas = !this.editBerkas;
        },

        editKaryaToggle() {
            this.editKarya = !this.editKarya;
        },
    },
    mounted() {
        this.fetchTeamData();
    }
}
</script>