<template>
    <div class="invalid-feedback">
        {{ message }}
    </div>
</template>

<script>
export default {
    name: 'FormError',
    props: {
        message: {
            type: String
        }
    }
}
</script>