<template>
    <nav class="navbar dinamik-navbar navbar-expand-lg fixed-top">
        <div class="container">
            <router-link :to="{name: 'welcome'}" class="navbar-brand">
                <img src="~/assets/image/logo.png" alt="Dinamik 15">
            </router-link>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" v-if="isWelcomePage">
                        <a href="#competition" class="nav-link">Competition</a>
                    </li>

                    <li class="nav-item" v-if="isWelcomePage">
                        <a href="#seminar" class="nav-link">Seminar</a>
                    </li>

                    <li class="nav-item" v-if="!getAuthStatus">
                        <router-link :to="{name: 'login'}" class="nav-link">Login</router-link>
                    </li>

                    <li class="nav-item" v-if="!getAuthStatus">
                        <router-link :to="{name: 'register'}" class="nav-link">Register</router-link>
                    </li>

                    <li class="nav-item" v-if="getAuthStatus">
                        <router-link :to="{name: 'dashboard'}" class="nav-link">Dashboard</router-link>
                    </li>

                    <li class="nav-item dropdown" v-if="getAuthStatus">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ getUserData().name }}</a>
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
    methods: {
        getUserData() {
            return this.$store.getters['auth/getUserData'];
        },
        submitLogout() {
            try {
                this.$store.dispatch('auth/logout');
                this.$router.push({name:'welcome'});
            } catch (e) {

            }
        }
    },
    computed: {
        getAuthStatus() {
            return this.$store.getters['auth/getAuthStatus'];
        },
        isWelcomePage() {
            return (this.$route.name === 'welcome');
        }
    }
}
</script>
