<template>
    <div class="container dashboard-container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div v-if="pageLoading" class="skeleton-wrapper">
                            <div class="skeleton title"></div>
                            <div class="skeleton content"></div>
                            <div class="skeleton content-50"></div>
                        </div>

                        <div v-if="!pageLoading && statistic">
                            <h5 class="font-weight-bold">User Terverifikasi</h5>
                            <h1 class="font-weight-light">{{ statistic.user_verified }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div v-if="pageLoading" class="skeleton-wrapper">
                            <div class="skeleton title"></div>
                            <div class="skeleton content"></div>
                            <div class="skeleton content-50"></div>
                        </div>

                        <div v-if="!pageLoading && statistic">
                            <h5 class="font-weight-bold">Tim Terdaftar</h5>
                            <h1 class="font-weight-light">{{ statistic.teams }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div v-if="pageLoading" class="skeleton-wrapper">
                            <div class="skeleton title"></div>
                            <div class="skeleton content"></div>
                            <div class="skeleton content-50"></div>
                        </div>

                        <div v-if="!pageLoading && statistic">
                            <h5 class="font-weight-bold">Peserta Terdaftar</h5>
                            <h1 class="font-weight-light">{{ statistic.participants }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div v-if="pageLoading" class="skeleton-wrapper">
                            <div class="skeleton title"></div>
                            <div class="skeleton content"></div>
                            <div class="skeleton content-50"></div>
                        </div>

                        <div v-if="!pageLoading && statistic">
                            <h5 class="font-weight-bold">Pembimbing Terdaftar</h5>
                            <h1 class="font-weight-light">{{ statistic.instructors }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div v-if="pageLoading" class="skeleton-wrapper">
                            <div class="skeleton title"></div>
                            <div class="skeleton content"></div>
                            <div class="skeleton content-50"></div>
                        </div>

                        <div v-if="!pageLoading && statistic">
                            <h5 class="font-weight-bold">Pembayaran Terverifikasi</h5>
                            <h1 class="font-weight-light">{{ statistic.payment_verified }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div v-if="pageLoading" class="skeleton-wrapper">
                            <div class="skeleton title"></div>
                            <div class="skeleton content"></div>
                            <div class="skeleton content-50"></div>
                        </div>

                        <div v-if="!pageLoading && statistic">
                            <h5 class="font-weight-bold">Jumlah Tim per Kompetisi</h5>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" :style="`width: ${percentage.animation}%`" :aria-valuenow="`${percentage.animation}`" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-success" role="progressbar" :style="`width: ${percentage.web}%`" :aria-valuenow="`${percentage.web}`" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-warning" role="progressbar" :style="`width: ${percentage.poster}%`" :aria-valuenow="`${percentage.poster}`" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-danger" role="progressbar" :style="`width: ${percentage.iwc}%`" :aria-valuenow="`${percentage.iwc}`" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="mt-4">
                                <div class="font-weight-bold">Keterangan: </div>
                                <div class="text-primary font-weight-bold">Animation Contest {{ `(${this.statistic.competition.animation_contest} Tim)` }}</div>
                                <div class="text-success font-weight-bold">Web Development {{ `(${this.statistic.competition.web_development} Tim)` }}</div>
                                <div class="text-warning font-weight-bold">Poster Design {{ `(${this.statistic.competition.poster_design} Tim)` }}</div>
                                <div class="text-danger font-weight-bold">Innovation Writing Contest {{ `(${this.statistic.competition.innovation_writing_contest} Tim)` }}</div>
                            </div>
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
            title: `Admin | Dashboard - ${process.env.APP_NAME}`
        }
    },
    data() {
        return {
            pageLoading: true,
            statistic: {},
            percentage: {
                animation: 0,
                web: 0,
                poster: 0,
                iwc: 0
            }
        }
    },
    methods: {
        async fetchStatistics() {
            try {
                let response = await this.$axios.get(Constants.ADMIN_ENDPOINT.STATISTIC);
                this.statistic = response.data.statistic;

                if(this.statistic.teams > 0) {
                    this.percentage.animation = this.statistic.competition.animation_contest / this.statistic.teams * 100;
                    this.percentage.web = this.statistic.competition.web_development / this.statistic.teams * 100;
                    this.percentage.poster = this.statistic.competition.poster_design / this.statistic.teams * 100;
                    this.percentage.iwc = this.statistic.competition.innovation_writing_contest / this.statistic.teams * 100;
                }

                this.pageLoading = false;
            } catch (e) {

            }
        }
    },
    mounted() {
        this.fetchStatistics();
    }
}
</script>

<style lang="scss" scoped>
.dashboard-container {
    margin-top: 4rem;
}
</style>