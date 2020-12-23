<template>
  <div>
      <AdminNavbar v-if="showNavbar"/>
    <Nuxt />
  </div>
</template>

<script>
import AdminNavbar from '~/components/Admin/AdminNavbar';

export default {
    computed: {
        showNavbar() {
            if(this.$route.name === 'admin.login') {
                return false;
            }

            return true;
        }
    }
}
</script>