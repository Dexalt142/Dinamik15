<template>
    <div class="loading">
        <div class="spinner"></div>
        <div class="title" v-if="title">{{ title }}</div>
    </div>
</template>

<script>
export default {
    name: 'LoadingSpinner',
    props: {
        title: {
            type: String
        }
    }
}
</script>