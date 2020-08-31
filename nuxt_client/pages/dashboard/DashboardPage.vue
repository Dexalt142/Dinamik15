<template>
    <div class="container main-container">
        Hello!
    </div>
</template>

<script>
export default {
    middleware: ['authenticated', 'verified'],
    head() {
        return {
            title: `Dashboard - ${process.env.APP_NAME}`
        }
    }
}
</script>