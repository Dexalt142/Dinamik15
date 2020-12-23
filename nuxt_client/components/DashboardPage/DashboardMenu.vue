<template>
    <div class="dashboard-menu">
        <ul>
            <li><router-link :to="{name: 'dashboard'}" class="dashboard-menu-link">Profil</router-link></li>
            <li><router-link :to="{name: 'dashboard.payment'}" class="dashboard-menu-link">Pembayaran</router-link></li>
            <li><router-link :to="{name: 'dashboard.creation'}" class="dashboard-menu-link">Karya</router-link></li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'DashboardMenu'
}
</script>