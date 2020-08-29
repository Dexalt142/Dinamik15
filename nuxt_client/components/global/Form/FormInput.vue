<template>
    <div class="form-group">
        <label for="">{{ name }}</label>
        <input :type="type" :class="{'is-invalid' : error}" class="form-control" ref="inputRef" :name="name" :value="value" :autocomplete="autocomplete" @input="updateValue()">
        <FormError v-if="error" :message="error"></FormError>
    </div>
</template>

<script>
import FormError from './FormError';
export default {
    name: 'FormInput',
    props: {
        name: {
            type: String
        },
        type: {
            type: String,
            required: true,
            default: 'text'
        },
        error: {
            type: String
        },
        autocomplete: {
            type: Boolean
        },
        value: {}
    },
    components: {
        FormError
    },
    methods: {
        updateValue() {
            this.$emit('input', this.$refs.inputRef.value);
        }
    }
}
</script>