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
                    <li class="nav-item">
                        <router-link :to="{name: 'login'}" class="nav-link">Login</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link :to="{name: 'register'}" class="nav-link">Register</router-link>
                    </li>
                </ul>
            </div>
            
        </div>
    </nav>
</template>

<script>
export default {
    mounted() {
        
    }
}
</script>
