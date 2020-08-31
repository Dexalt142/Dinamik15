<template>
    <div class="alert" :class="{'alert-dismissible fade show':dismiss, 'alert-success':color==='success', 'alert-primary':color==='primary', 'alert-info':color==='info', 'alert-danger':color==='danger', 'alert-warning':color==='warning'}">
        {{ message }}
        <button v-if="dismiss" type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
export default {
    name: 'Alert',
    props: {
        message: {
            type: String
        },
        dismiss: {
            type: Boolean
        },
        color: {
            type: String
        }
    }
}
</script>