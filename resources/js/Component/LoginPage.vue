<template>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form v-on:submit.prevent="authenticate">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" v-bind:class="{'form-control':true, 'is-invalid':errors.email}" v-model="authCredentials.email">
                                <span class="invalid-feedback" v-if="errors.email">
                                    <strong>{{ errors.email[0] }}</strong>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" v-bind:class="{'form-control':true, 'is-invalid':errors.password}" v-model="authCredentials.password">
                                <span class="invalid-feedback" v-if="errors.password">
                                    <strong>{{ errors.password[0] }}</strong>
                                </span>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" :disabled="buttonState">Login</button>
                            </div>
                        </form>
                    </div>

                    <div class="loading" v-if="loading">
                        <div class="spinner"></div>
                        <h4 class="mt-4">Authenticating</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                authCredentials: {
                    email: '',
                    password: ''
                },
                loading: false,
                errors: []
            };
        },
        methods: {
            authenticate() {
                this.loading = true;
                axios.post('/auth/login', this.authCredentials)
                .then(response => {
                    console.log(response);
                    if(response.data.status == 200) {
                        if(response.data.user) {
                            window.location.href = response.data.redirect;
                        }
                    } else {
                        this.errors = response.data.errors;
                        this.loading = false;
                    }
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.loading = false;
                });
            }
        },
        computed: {
            buttonState() {
                return !(this.authCredentials.email && this.authCredentials.password);
            }
        }
    }
</script>