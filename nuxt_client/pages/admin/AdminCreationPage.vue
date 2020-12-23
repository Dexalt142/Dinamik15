<template>
    <div class="container dashboard-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Karya</h4>
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
                                        <th>Asal Sekolah</th>
                                        <th>Kompetisi</th>
                                        <th>Karya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr v-for="(team, index) in teamData" :key="team.id">
                                       <td>{{ index+1 }}</td>
                                       <td>{{ team.name }}</td>
                                       <td>{{ team.asal_sekolah }}</td>
                                       <td>{{ team.competition.name }}</td>
                                       <td>
                                           <a class="mr-2" target="_blank" v-if="(team.creation && team.creation.berkas)" :href="team.creation.berkas">Berkas</a>
                                           <a target="_blank" v-if="(team.creation && team.creation.karya)" :href="team.creation.karya">Karya</a>
                                           <p v-if="!team.creation">Tidak Mengumpulkan Karya</p>
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
    </div>
</template>

<script>
import Constants from '~/constants.js';

export default {
    layout: 'admin',
    middleware: ['admin-authenticated', 'admin-check-token'],
    head() {
        return {
            title: `Admin | Creation - ${process.env.APP_NAME}`
        }
    },
    data() {
        return {
            dataLoading: true,
            teamData: [],
        }
    },
    methods: {
        async fetchTeamData() {
            try {
                let { data } = await this.$axios.get(Constants.ADMIN_ENDPOINT.CREATION.INDEX);
                this.teamData = data.creation;

                this.dataLoading = false;
            } catch(e) {

            }
        },
    },
    mounted() {
        this.fetchTeamData();
    }
}
</script>

<style lang="scss" scoped>
.dashboard-container {
    margin-top: 4rem;
}
</style>