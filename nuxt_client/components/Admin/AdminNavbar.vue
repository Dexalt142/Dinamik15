<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <router-link class="navbar-brand" :to="{name: 'admin.dashboard'}">Dinamik Admin</router-link>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link :to="{name:'admin.team'}" class="nav-link">Tim</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'admin.payment'}" class="nav-link">Pembayaran</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'admin.creation'}" class="nav-link">Karya</router-link>
                    </li>
                    <li class="nav-item dropdown" v-if="adminData">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ adminData.name }}</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <button class="dropdown-item" @click="submitLogout">Logout</button>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</template>

<script>
export default {
    name: 'AdminNavbar',
    data() {
        return {
            adminData: null,
        }
    },
    methods: {
        async fetchAdminData() {
            this.adminData = await this.$store.getters['auth-admin/getAdminData'];
        },

        async submitLogout() {
            try {
                await this.$store.dispatch('auth-admin/logout');
                this.$router.push({name:'admin.login'});
            } catch (e) {

            }
        }
    },
    mounted() {
        this.fetchAdminData();
    }
}
</script>

<style lang="scss" scoped>
.navbar-toggler {
    padding-top: 0;
    padding-bottom: 0;
    border: 0;

    &:focus {
        outline: 0;
    }

    .bar {
        position: relative;
        width: 35px;
        background-color: #FFF;
        height: 2px;
        border-radius: 1rem;
        display: block;
        margin: .5rem 0;
    }
}
</style>