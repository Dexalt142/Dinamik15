<template>
  <div class="container error-page-container">
    <h1 v-if="error.statusCode === 404">Halaman Tidak Dapat Ditemukan</h1>
    <h1 v-else>An error occurred</h1>
    <nuxt-link to="/">Kembali ke halaman awal</nuxt-link>
  </div>
</template>

<script>
  export default {
    props: ['error'],
    head() {
        return {
            title: `${process.env.APP_NAME}`
        }
    },
  }
</script>

<style>
.error-page-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
</style>