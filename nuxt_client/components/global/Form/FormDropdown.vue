<template>
    <div class="form-group">
        <label v-if="label">{{ label }}</label>
        <input :type="type" :class="{'is-invalid' : error}" class="form-control" ref="inputRef" :name="name" :value="value" :autocomplete="autocomplete ? 'on' : 'off'" @input="updateValue()">
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
        label: {
            type: String
        },
        type: {
            type: String,
            required: true,
            default: 'text'
        },
        error: {
            type: Array
        },
        autocomplete: {
            type: Boolean,
            default: false
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