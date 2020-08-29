<template>
    <div class="invalid-feedback">
        <div v-for="m in message" :key="m">{{ m }}</div>
    </div>
</template>

<script>
export default {
    name: 'FormError',
    props: {
        message: {
            type: Array
        }
    }
}
</script>