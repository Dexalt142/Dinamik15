<template>
    <div class="container main-container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <Card color="white" title="Login" :loading="loading" loading_title="Mengotentikasi">
                    <form>
                        <FormInput v-model="authCredential.email" name="email" type="email" :autocomplete="true"></FormInput>
                        <FormInput v-model="authCredential.password" name="password" type="password" :autocomplete="true"></FormInput>

                        <div class="form-group">
                            <button class="btn btn-primary" @click="submitLogin">Login</button>
                        </div>
                    </form>
                </Card>
            </div>
        </div>
    </div>
</template>

<script>
import Card from '~/components/global/Card';
import FormInput from '~/components/global/Form/FormInput';

export default {
    head() {
        return {
            title: 'Dinamik 15 - Login'
        }
    },
    components: {
        Card, FormInput
    },
    data() {
        return {
            authCredential: {
                email: '',
                password: ''
            },
            loading: false
        }
    },
    methods: {
        submitLogin() {
            this.loading = true;
        }
    },
    mounted() {

    }
}
</script>